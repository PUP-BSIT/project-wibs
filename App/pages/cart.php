<?php
// Connect to the database
$conn = mysqli_connect('127.0.0.1:3306','u733671518_wibs','|4Kh/3XYD','u733671518_project');
#$conn = mysqli_connect('localhost','root','','u733671518_project');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}

$userid = $_SESSION['user_id'];
$username = $_SESSION['user_name'];

// Handle remove item request
if (isset($_POST['remove_item']) && isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];
    $sql_remove = "DELETE FROM cart WHERE cart_id = '$cart_id'";
    if ($conn->query($sql_remove) === TRUE) {
        echo "Item removed from cart successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Handle place order request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    $_SESSION['order_placed'] = true;
    header("Location: transaction.php"); // Redirecting to transaction.php instead of order_status.php
    exit;
}

// Alert for order placement
if (isset($_SESSION['order_placed']) && $_SESSION['order_placed']) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var alertDiv = document.getElementById('orderPlacedAlert');
                alertDiv.style.display = 'block';
                setTimeout(function() {
                    alertDiv.style.display = 'none';
                }, 3000); // The alert will disappear after 3 seconds
            });
          </script>";
    unset($_SESSION['order_placed']);
}

// Add item to cart
if (isset($_POST['item_id'], $_POST['item_name'], $_POST['quantity'], $_POST['item_price'], $_POST['item_image'])) {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $item_price = $_POST['item_price'];
    $item_image = $_POST['item_image'];
    $sql = "INSERT INTO cart (user_id, item_id, item_name, quantity, item_price, item_image) VALUES ('$userid', '$item_id', '$item_name', $quantity, $item_price, '$item_image')";
    if ($conn->query($sql) === TRUE) {
        echo "Item added to cart successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cart</title>
    <link rel="stylesheet" href="../css/cart.css">
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
    <div id="orderPlacedAlert" style="display: none;" class="order-placed-alert">
        Order placed successfully
    </div>
    <div class="my-cart">
        <h1>My Cart</h1>
    </div>
    <div class="main">
        <div class="cart-items">
            <?php
            $total_amount = 0;
            $sql = "SELECT * FROM cart WHERE user_id = '$userid'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<form class="item" action="" method="post">';
                    echo '<input type="hidden" name="cart_id" value="' . $row['cart_id'] . '">';
                    echo '<div class="item-info">';
                    echo '<p>Item Name: ' . $row['item_name'] . '</p>';
                    echo '<p>Quantity: ' . $row['quantity'] . '</p>';
                    echo '<p>Price: ₱' . $row['item_price'] . '</p>';
                    echo '<img src="' . $row['item_image'] . '" alt="Item Image">';
                    echo '</div>';
                    echo '<div class="remove-button">';
                    echo '<button type="submit" name="remove_item" onclick="return confirmRemove()">Remove</button>';
                    echo '</div>';
                    $total_amount += $row['item_price'] * $row['quantity'];
                    echo '</form>'; 
                }
            } else {
                echo '<p>Your cart is empty.</p>';
            }
            ?>
        </div>
        <div class="order-summary">
            <div class="order-form">
                <?php if ($result->num_rows > 0): ?>
                    <form method="POST" action="transaction.php">
                        <button type="submit" name="place_order">Place Order</button>
                    </form>
                <?php else: ?>
                    <button disabled style="background-color: grey;">Place Order</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <footer class="site-footer">
        <p>&copy; 2023 WIBS. All rights reserved.</p>
    </footer>
    <script src="../js/cart.js"></script>
</body>
</html>
