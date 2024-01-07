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
    header("Location: login.php"); // Adjust the path as necessary
    exit;
}

// Accessing the username from the session variable
$userid = $_SESSION['user_id'];
$username = $_SESSION['user_name'];

// Check if remove item request is set
if (isset($_POST['remove_item']) && isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];

    // SQL to remove item from cart
    $sql_remove = "DELETE FROM cart WHERE cart_id = '$cart_id'";

    if ($conn->query($sql_remove) === TRUE) {
        echo "Item removed from cart successfully";
    } else {
        echo "Error: " . $sql_remove . "<br>" . $conn->error;
    }
}

// Check if the required POST values are set
if (isset($_POST['item_id'], $_POST['item_name'], $_POST['quantity'], $_POST['item_price'], $_POST['item_image'])) {
    // Get data from the client-side
    $item_id = $_POST['item_id']; // Add this line
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $item_price = $_POST['item_price'];
    $item_image = $_POST['item_image'];

    // Insert data into the database including user_id and item_id
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
    <script>
        function confirmRemove() {
            return confirm('Are you sure you want to remove this item from your cart?');
        }
    </script>
</head>

<body>
    <div class="my-cart">
        <h1>My Cart</h1>
    </div>

    <div class="main">
        <div class="cart-items">
            <?php
            // Fetch cart items from the database for the current user
            $sql = "SELECT * FROM cart WHERE user_id = '$userid'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Display cart items
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
                    echo '</form>';
                }
            } else {
                echo '<p>Your cart is empty.</p>';
            }

            $conn->close();
            ?>
        </div>
        
        <div class="order-summary">
            <div class="order-form">
                <button type="submit">Place Order</button>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <p>&copy; 2023 WIBS. All rights reserved.</p>
    </footer>

    <script src="../js/cart.js"></script>
</body>
</html>