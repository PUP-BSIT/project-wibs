<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php"); // Adjust the path as necessary
    exit;
}

// Accessing the username from the session variable
$username = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Status</title>
  <link rel="stylesheet" href="../css/order_status.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
</head>

<body>
  <div class="navbar">
        <div class="logo">WIBS</div>
        <div class="nav-links">
            <a href="homepage.php">Home</a>
            <a href="order_status.php">Order Status</a>
            <a href="cart.php">My Cart</a>
        </div>
        <div class="profile-name"><strong>AJ Alejandro</strong></div>
    </div>

    <div class="status-text">
      <h1>Your Current Delivery Status</h1>
    </div>

  <div class="timeline">
    <div class="container-left">
      <div class="content">
        <h2>Order Placed</h2>
        <p>Your order has been placed successfully.</p>
      </div>
    </div>

    <div class="container-right">
      <div class="content">
        <h2>Order Confirmed</h2>
        <p>We are preparing your items to be shipped.</p>
      </div>
    </div>

    <div class="container-left">
      <div class="content">
        <h2>Shipped</h2>
        <p>Your order is on the way.</p>
      </div>
    </div>

    <div class="container-right">
      <div class="content">
        <h2>Out for Delivery</h2>
        <p>Your order is out for delivery.</p>
      </div>
    </div>
    
    <div class="container-left">
      <div class="content">
        <h2>Delivered</h2>
        <p>Your order has been delivered. Enjoy!</p>
      </div>
    </div>
  </div>
  
  <footer class="site-footer">
        <p>&copy; 2023 WIBS. All rights reserved.</p>
  </footer>
</body>
</html>