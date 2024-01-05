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
        document.getElementById('sidebar-item-name').innerText = item.item_name;
        document.getElementById('sidebar-item-price').innerText = `Price: ₱${item.item_price}`;
        document.getElementById('sidebar-item-image').src = item.item_image;
        document.getElementById('sidebar-item-image').alt = item.item_name;
        document.getElementById('sidebar-item-description').innerText = item.item_description;
        document.getElementById('quantity').value = 1; // Reset quantity to 1

        openSidebar();
    }

    function addToCart(item) {
        const quantity = document.getElementById('quantity').value;
        console.log(`Adding ${quantity} of ${item.item_name} to cart`);
        // Here, add your logic to handle adding the item to the cart
    }

    document.getElementById('add-to-cart-btn').addEventListener('click', function() {
        const selectedItemName = document.getElementById('sidebar-item-name').innerText;
        const selectedItem = { item_name: selectedItemName }; // You might need to adjust this to get the full item details
        addToCart(selectedItem);
    });

    function openSidebar() {
        document.getElementById('item-detail-sidebar').style.width = '250px';
    }

    function closeSidebar() {
        document.getElementById('item-detail-sidebar').style.width = '0';
    }

    document.querySelector('.close-btn').addEventListener('click', closeSidebar);

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