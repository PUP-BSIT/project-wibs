<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['user_name'])) {
    header("Location: ../pages/login.php"); // Adjust the path as necessary
    exit;
}

// Accessing the username from the session variable
$username = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Cart and Place Order</title>
    <link rel="stylesheet" href="../css/cart.css" />
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

    <div class="my-cart">
      <h1>My Cart</h1>
    </div>

    <div class="main">
      <div class="cart-items">
        <div class="item">
          <div class="item-image1">
            <img src="wooden_accent_chair.png" />
          </div>
          <div class="item-info">
            <h3>Wooden Accent Chair (Anjing Variant)</h3>
            <p>₱200.00</p>
            <div class="buttons">
              <div class="color-selector">
                <select name="color">
                  <option value="brown">Brown</option>
                  <option value="gray">Gray</option>
                  <option value="white">White</option>
                </select>
              </div>
              <div class="quantity-selector">
                <button class="minus">-</button>
                <input
                  type="number"
                  class="quantity-input"
                  value="1"
                  readonly
                />
                <button class="plus">+</button>
              </div>
              <div class="remove-button">
                <button type="button">Remove</button>
              </div>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="item-image2">
            <img src="drop_it_down_statue.png" />
          </div>
          <div class="item-info">
            <h3>Drop it Down Statue (Anjing Shades)</h3>
            <p>₱730.00</p>
            <div class="buttons">
              <div class="color-selector">
                <select name="color">
                  <option value="black">Black</option>
                  <option value="gold">Gold</option>
                  <option value="silver">Silver</option>
                </select>
              </div>
              <div class="quantity-selector">
                <button class="minus">-</button>
                <input
                  type="number"
                  class="quantity-input"
                  value="1"
                  readonly
                />
                <button class="plus">+</button>
              </div>
              <div class="remove-button">
                <button type="button">Remove</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="order-summary">
        <div class="order-form">
          <h3>Order Summary</h3>
          <p>Subtotal: ₱930.00</p>
          <p>Shipping will be calculated at checkout</p>
          <button type="submit">Place Order</button>
        </div>
      </div>
    </div>

    <footer class="site-footer">
      <p>&copy; 2023 WIBS. All rights reserved.</p>
    </footer>
  </body>
</html>
