<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="../css/product_list.css">
</head>
<body>
    <div class="navbar">
        <div class="logo">WIBS</div>
        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#orderstatus">Order Status</a>
            <a href="#mycart">My Cart</a>
        </div>
        <div class="profile-name"><strong>AJ Alejandro</strong></div>
    </div>

    <div class="product-details-container">
        <h1 class="product-details-title">Product Details</h1>
        <div class="product-details-content">
            <div class="product-details-image">
                <img src="" alt="" id="product-image">
            </div>
            <div class="product-details-info">
                <h2 id="product-name"></h2>
                <p id="product-price"></p>
                <p id="product-description"></p>
                <div class="color-selector">
                    <span>Select Color:</span>
                    <div class="color-options" id="color-options"></div>
                </div>
                <div class="quantity-selector">
                    <span>Select Quantity:</span>
                    <input type="number" id="product-quantity" name="quantity" min="1" value="1" readonly>
                </div>
                <button class="add-to-cart" id="add-to-cart-button">Add to Cart</button>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <p>&copy; 2023 WIBS. All rights reserved.</p>
    </footer>

    <script src="../js/product_details.js"></script>
</body>
</html>
