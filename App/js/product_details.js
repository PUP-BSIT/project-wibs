document.addEventListener('DOMContentLoaded', function() {
    // Get references to the elements in the product details container
    const productImage = document.getElementById('product-image');
    const productName = document.getElementById('product-name');
    const productPrice = document.getElementById('product-price');
    const productDescription = document.getElementById('product-description');
    const colorOptions = document.getElementById('color-options');
    const productQuantity = document.getElementById('product-quantity');
    const addToCartButton = document.getElementById('add-to-cart-button');

    // Function to display product details
    function displayProductDetails(product) {
        if (product) {
            productImage.src = product.image_url;
            productName.textContent = product.item_name;
            productPrice.textContent = `Price: $${product.price}`;
            productDescription.textContent = product.description;

            // You can populate color options here if available in your product data
            // Example: colorOptions.innerHTML = `<input type="radio" ...`;

            // Update the "Add to Cart" button behavior
            addToCartButton.onclick = function() {
                // Add the selected product to the shopping cart (you need to implement this functionality)
                addToCart(product);
            };

            // Show the product details container
            document.querySelector('.product-details-container').style.display = 'block';
        } else {
            // Handle the case where the product is not found or item_id is undefined
            productName.textContent = "Product Not Found";
            productImage.src = "path_to_default_image.jpg"; // Provide a default image
            // You can update other elements as needed for error handling
        }
    }

    // Function to fetch product details based on the item ID in the URL
    function fetchProductDetails() {
        // Get the item_id from the URL query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const itemId = urlParams.get('item_id');

        if (itemId) {
            // Fetch the product details for the selected item
            fetch(`https://thefusionseller.online/get_item_details.php?item_id=${itemId}`)
                .then(response => response.json())
                .then(product => {
                    // Call the function to display product details
                    displayProductDetails(product);
                })
                .catch(error => {
                    console.error('Error fetching product details: ', error);
                    displayProductDetails(null); // Handle error by displaying "Product Not Found"
                });
        } else {
            // Handle the case where item_id is undefined
            displayProductDetails(null); // Display "Product Not Found"
        }
    }

    // Call the function to fetch and display product details
    fetchProductDetails();
});
