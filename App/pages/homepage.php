<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php"); // Adjust the path as necessary
    exit;
}

// Accessing the username from the session variable
$userid = $_SESSION['user_id'];
$username = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/homepage_styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
</head>
<body>
    <div class="overlay"></div>
    <div class="navbar">
        <div class="logo">WIBS</div>
        <div class="nav-links">
            <a href="homepage.php">Home</a>
            <a href="order_status.php">Order Status</a>
            <a href="cart.php">My Cart</a>
        </div>
        <div class="profile-name"><strong><?php echo $username
        ?></strong></div>
    </div>
    <div id="item_detail_popup" class="item-detail-popup">
        <div class="popup-image">
            <img id="popup_item_image" src="">
        </div>
        <div class="item-detail-content">
            <span class="close-btn">&times;</span>
            <h2 id="popup_item_name"></h2>
            <p id="popup_item_price"></p>
            <p id="popup_item_description"></p>
            <div class="quantity-selector">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" max="99" value="1">
            </div>
            <button id="add_to_cart_btn">Add to Cart</button> 
        </div>
    </div>
    
    <div class="main-content">
        <div class="first-section">
            <h1>Best for Your Home</h1>
            <div class="content-wrapper-1">
               
            </div>
        </div>
        <div class="second-section">
            <h1>This Week's Top Sellers</h1>
            <div class="content-wrapper-2">

            </div>
        </div>
        <div class="third-section">
            <h1>All Deals</h1>
            <div class="content-wrapper-3">

            </div>
            <div class="pagination">

            </div>
        </div>
    </div>
    
    <div id="customAlert" class="custom-alert">
    <p id="alertMessage"></p>
</div>

    <footer class="site-footer">
        <p>&copy; 2023 WIBS. All rights reserved.</p>
    </footer>
    <script src="../js/homepage.js"></script>
</body>
</html>