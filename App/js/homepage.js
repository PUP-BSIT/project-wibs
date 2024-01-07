document.addEventListener('DOMContentLoaded', function() {
    const itemsPerPage = 9;
    let currentPage = 1;
    let totalItems = 45;

    function fetchItems(offset, limit) {
        return fetch(`https://thefusionseller.online/api_endpoints/get_item_list.php?offset=${offset}&limit=${limit}`)
            .then(response => response.json());
    }

    function createItemDiv(item) {
        const itemDiv = document.createElement('div');
        itemDiv.className = 'item';
        itemDiv.innerHTML = `
            <h2>${item.item_name}</h2>
            <p>Price: ₱${item.item_price}</p>
            <img src="${item.item_image}" alt="${item.item_name}">
            <div class="item-id" style="display: none;">${item.item_id}</div>
        `;
        itemDiv.addEventListener('click', function() {
            displayItemDetails(item);
        });
        return itemDiv;
    }

    function displayItemDetails(item) {
        document.querySelector('#popup_item_name').innerText = item.item_name;
        document.querySelector('#popup_item_price').innerText = `Price: ₱${item.item_price}`;
        document.querySelector('#popup_item_image').src = item.item_image;
        document.querySelector('#popup_item_description').innerText = item.item_description;
        document.querySelector('.item-id').innerText = item.item_id;
        openPopup();
    }

    function addToCart(item) {
        const quantity = document.querySelector('#quantity').value;
    
        // Extract item details
        const itemName = item.item_name;
        const itemPrice = item.item_price;
        const itemImage = item.item_image;
        const itemId = item.item_id;
    
        // Check if the values are defined
        if (itemName !== undefined && itemPrice !== undefined && itemImage !== undefined) {
            // Create a FormData object to send data to the server
            const formData = new FormData();
            formData.append('item_name', itemName);
            formData.append('quantity', quantity);
            formData.append('item_price', itemPrice);
            formData.append('item_image', itemImage);
            formData.append('item_id', itemId);
    
            // Log FormData contents
            console.log('FormData:', formData);
    
            // Make an AJAX request to addToCart.php
            fetch('cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                showAlert(`Successfully added ${quantity} x ${itemName} to your cart.`);
            })
            .catch(error => console.error('Error:', error));
        }
        
        function showAlert(message) {
            const alertBox = document.getElementById('customAlert');
            const alertMessage = document.getElementById('alertMessage');
        
            alertMessage.innerText = message;
            alertBox.classList.add('show');
        
            // Hide the alert after 3 seconds
            setTimeout(() => {
                alertBox.classList.remove('show');
            }, 3000);
        }
    }
    
    document.querySelector('#add_to_cart_btn').addEventListener('click', function() {
        const selectedItemName = document.querySelector('#popup_item_name').innerText;
        const selectedItemPrice = parseFloat(document.querySelector('#popup_item_price').innerText.replace('Price: ₱', ''));
        const selectedItemImage = document.querySelector('#popup_item_image').src;
        const selectedItemID = document.querySelector('.item-id').innerText; 
    
        const selectedItem = {
            item_name: selectedItemName,
            item_price: selectedItemPrice,
            item_image: selectedItemImage,
            item_id: selectedItemID
        };
    
        addToCart(selectedItem);
    });
    

    function openPopup() {
        document.querySelector('.overlay').classList.add('visible');
        document.querySelector('#item_detail_popup').classList.add('open');
    }
    
    function closePopup() {
        document.querySelector('.overlay').classList.remove('visible');
        document.querySelector('#item_detail_popup').classList.remove('open');
    }

    document.querySelector('.close-btn').addEventListener('click', closePopup);

    function displayInitialItems() {
        fetchItems(0, 5).then(data => {
            const contentWrapper1 = document.querySelector('.content-wrapper-1');
            const contentWrapper2 = document.querySelector('.content-wrapper-2');

            for (let i = 0; i < 2 && i < data.length; i++) {
                contentWrapper1.appendChild(createItemDiv(data[i]));
            }

            for (let i = 2; i < 5 && i < data.length; i++) {
                contentWrapper2.appendChild(createItemDiv(data[i]));
            }
        })
        .catch(error => {
            console.error('Error fetching data: ', error);
        });
    }

    function displayAllDeals(items) {
        const container = document.querySelector('.content-wrapper-3');
        container.innerHTML = ''; 
        items.forEach(item => {
            container.appendChild(createItemDiv(item));
        });
        updatePagination();
    }

    function updatePagination() {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const pagination = document.querySelector('.pagination');
        pagination.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const pageLink = document.createElement('a');
            pageLink.href = '#';
            pageLink.innerText = i;
            if (i === currentPage) {
                pageLink.classList.add('active');
            }
            pageLink.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage = i;
                fetchItems(((currentPage - 1) * itemsPerPage) + 5, itemsPerPage)
                    .then(displayAllDeals)
                    .catch(error => console.error('Error:', error));
            });
            pagination.appendChild(pageLink);
        }
    }

    displayInitialItems();
    fetchItems(5, itemsPerPage).then(displayAllDeals).catch(error => console.error('Error:', error));
});