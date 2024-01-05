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

        openPopup();
    }

    function addToCart(item) {
        const quantity = document.getElementById('quantity').value;
        const userId = getUserId();
    
        fetch('cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                item_id: item.id, 
                quantity: quantity,
                user_id: userId,
            }),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Item added to cart:', data);
        })
        .catch(error => {
            console.error('Error adding item to cart:', error);
        });
    }

    document.querySelector('#add_to_cart_btn').addEventListener('click', function() {
        const selectedItemName = document.querySelector('#popup_item_name').innerText;
        const selectedItem = { item_name: selectedItemName };
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