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
                    echo "Error: " . $conn->error;
                }
            }

            // Process the place order request
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
                // Retrieve customer name and delivery address from session
                $customer_name = $username;

                $address_query = "SELECT address FROM customer WHERE customer_id = '$userid'";
                $address_result = $conn->query($address_query);
                if ($address_row = $address_result->fetch_assoc()) {
                    $customer_address = $address_row['address'];
                } else {
                    $customer_address = 'Default Address'; // Fallback address
                }
                
                // Fetch cart items
                $sql = "SELECT item_id, quantity, item_price FROM cart WHERE user_id = '$userid'";
                $result = $conn->query($sql);
                $items = [];
                $grand_total = 0;
                while ($row = $result->fetch_assoc()) {
                    $total_price = $row['item_price'] * $row['quantity'];
                    $items[] = array(
                        'item_id' => $row['item_id'],
                        'qty' => $row['quantity'],
                        'price' => $row['item_price'],
                        'total_price' => $total_price
                    );
                    $grand_total += $total_price;
                }
                
                $items_json = json_encode($items);
                
                // Insert into purchase_orders
                $insert_sql = "INSERT INTO purchase_orders (user_id, items, grand_total, customer_name, delivery_address, status) VALUES ('$userid', '$items_json', $grand_total, '$customer_name', '$customer_address', 1)";
                if ($conn->query($insert_sql) === TRUE) {
                    echo "Order placed successfully";
                    // Optionally, clear the cart
                    $conn->query("DELETE FROM cart WHERE user_id = '$userid'");
                } else {
                    echo "Error: " . $conn->error;
                }
            }

            // Check if the required POST values are set for adding to cart
            if (isset($_POST['item_id'], $_POST['item_name'], $_POST['quantity'], $_POST['item_price'], $_POST['item_image'])) {
                // Get data from the client-side
                $item_id = $_POST['item_id'];
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
        </head>
        <body>
            <div class="my-cart">
                <h1>My Cart</h1>
            </div>
            <div class="main">
                <div class="cart-items">
                    <?php
                    $total_amount = 0;
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
                            $total_amount += $row['item_price'] * $row['quantity'];
                            echo '</form>'; 
                        }
                        echo '<div class="total-amount">';
                        echo '<p>Total Amount: ₱' . $total_amount . '</p>';
                        echo '</div>';
                    } else {
                        echo '<p>Your cart is empty.</p>';
                    }
                    ?>
                </div>
                <div class="order-summary">
                    <div class="order-form">
                        <form method="POST" action="">
                            <button type="submit" name="place_order">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
            <footer class="site-footer">
                <p>&copy; 2023 WIBS. All rights reserved.</p>
            </footer>
            <script src="../js/cart.js"></script>
        </body>
        </html>