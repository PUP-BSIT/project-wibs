<?php
session_start();
$conn = mysqli_connect('127.0.0.1:3306','u733671518_wibs','|4Kh/3XYD','u733671518_project');
#$conn = mysqli_connect('localhost', 'root', '', 'u733671518_project'); // Replace with your database details

if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['user_name'];
$userid = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['final_confirm'])) {
    // Perform transaction logic here (e.g., save transaction details to database)
    // ...

    // Clear the cart after transaction confirmation
    $sql_clear_cart = "DELETE FROM cart WHERE user_id = '$userid'";
    $conn->query($sql_clear_cart);

    // Redirect to order status page
    header("Location: order_status.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaction Page</title>
    <link rel="stylesheet" href="../css/transaction_styles.css">
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

    <div class="transaction-text">
        <h1>Complete your Transaction</h1>
    </div>

    <div class="main-container">
        <div class="transaction-container">
            <div class="form-and-notes-container">
                <form id="transactionForm" class="transaction-form" method="POST" action="">

                    <div class="form-section billing-info">
                        <h3>Billing Information</h3>
                        <input type="text" name="billingName" placeholder="Full Name" required>
                        <input type="text" name="billingAddress" placeholder="Billing Address" required>
                    </div>

                    <div class="form-section shipping-info">
                        <h3>Shipping Information</h3>
                        <input type="text" name="shippingName" placeholder="Full Name" required>
                        <input type="text" name="shippingAddress" placeholder="Shipping Address" required>
                    </div>

                    <div class="form-section payment-method">
                        <h3>Payment Method</h3>
                        <input type="text" name="cardNumber" placeholder="Card Number" required>
                        <input type="text" name="expiryDate" placeholder="Expiry Date" required>

                        <div class="payment-mode-selection">
                            <p>Select Payment Mode:</p>
                            <label for="paymentModeCash">
                                <input type="radio" id="paymentModeCash" name="paymentMode" value="cash" required>
                                Cash on Delivery
                            </label>
                            <label for="paymentModeBank">
                                <input type="radio" id="paymentModeBank" name="paymentMode" value="bank" required>
                                Through Bank
                            </label>
                        </div>
                    </div>

                    <div class="form-section order-notes">
                        <h3>Order Notes (optional)</h3>
                        <textarea name="orderNotes" placeholder="Add any special instructions or messages..."></textarea>
                    </div>

                    <button type="submit" name="final_confirm" class="place-order-btn">Place Order</button>
                </form>
            </div>

            <div class="order-summary-container">
                <div class="order-summary">
                    <h2>Your Order</h2>
                </div>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <p>&copy; 2023 WIBS. All rights reserved.</p>
    </footer>

    <script src="../js/transaction_script.js"></script>
</body>
</html>
