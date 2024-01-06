<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Page</title>
    <link rel="stylesheet" href="../css/transaction_styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
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
                <form id="transactionForm" class="transaction-form">
                    <div class="form-section billing-info">
                        <h3>Billing Information</h3>
                        <input type="text" placeholder="Full Name">
                        <input type="text" placeholder="Billing Address">
                    </div>

                    <div class="form-section shipping-info">
                        <h3>Shipping Information</h3>
                        <input type="text" placeholder="Full Name">
                        <input type="text" placeholder="Shipping Address">
                    </div>

                    <div class="form-section payment-method">
                        <h3>Payment Method</h3>
                        <input type="text" placeholder="Card Number">
                        <input type="text" placeholder="Expiry Date">

                        <div class="payment-mode-selection">
                            <p>Select Payment Mode:</p>
                            <label for="paymentModeCash">
                                <input type="radio" id="paymentModeCash" name="paymentMode" value="cash">
                                Cash on Delivery
                            </label>
                            <label for="paymentModeBank">
                                <input type="radio" id="paymentModeBank" name="paymentMode" value="bank">
                                Through Bank
                            </label>
                        </div>
                    </div>

                    <div class="form-section order-notes">
                        <h3>Order Notes (optional)</h3>
                        <textarea placeholder="Add any special instructions or messages..."></textarea>
                    </div>

                    <button type="submit" class="place-order-btn">Place Order</button>
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
