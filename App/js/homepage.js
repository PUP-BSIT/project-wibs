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
            <p>Price: $${item.price}</p>
            <img src="${item.image_url}" alt="${item.item_name}">
        `;
        return itemDiv;
    }

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