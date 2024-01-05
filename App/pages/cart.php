<?php
session_start();

$conn = mysqli_connect('127.0.0.1:3306','u733671518_wibs','|4Kh/3XYD','u733671518_project');

function getCartItems($userId, $conn) {
    $query = "SELECT cart_items.id, items.item_name, items.item_price, cart_items.quantity
              FROM cart_items
              JOIN items ON cart_items.item_id = items.id
              WHERE cart_items.user_id = :user_id";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$cartItems = getCartItems($userId, $conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cart</title>
    <link rel="stylesheet" href="../css/cart.css">
</head>

<body>
    <div class="my-cart">
        <h1>My Cart</h1>
    </div>

    <div class="main">
        <div class="cart-items">
            <?php foreach ($cartItems as $cartItem): ?>
                <div class="item">
                    <div class="item-image1">
                      
                    </div>
                    <div class="item-info">
                        <h2><?php echo $cartItem['item_name']; ?></h2>
                        <p>Price: ₱<?php echo $cartItem['item_price']; ?></p>
                        <p>Quantity: <?php echo $cartItem['quantity']; ?></p>
                        

                        <div class="remove-button">
                            <button type="button" onclick="removeItem(<?php echo $cartItem['id']; ?>)">Remove</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="order-summary">

            <div class="order-form">
                <button type="submit" onclick="placeOrder()">Place Order</button>
            </div>
        </div>
    </div>

    <footer class="site-footer">
        <p>&copy; 2023 WIBS. All rights reserved.</p>
    </footer>

    <script src="../js/homepage.js">
        function removeItem(itemId) {
            console.log('Removing item with ID:', itemId);
        }

        function placeOrder() {
            console.log('Placing order');
        }
    </script>
</body>
</html>
