<?php

    $conn = mysqli_connect("localhost", "root", "", "ecommerce");

    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    header("Access-Control-Allow-Origin: *");  // Allow requests from any origin
    header("Access-Control-Allow-Methods: GET, OPTIONS");  // Allow only GET requests and OPTIONS for pre-flight
    header("Access-Control-Allow-Headers: Content-Type");  // Allow only Content-Type header

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sql = "SELECT * FROM purchase_orders WHERE 1";

        // Check and apply filters if provided
        if(isset($_GET['seller_id'])) {
            $sellerId = $_GET['seller_id'];
            $sql .= " AND seller_id = $sellerId";
        }

        if(isset($_GET['status'])) {
            $status = $_GET['status'];
            $sql .= " AND status = $status";
        }

        if(isset($_GET['offset']) && isset($_GET['limit'])) {
            $offSet = $_GET['offset'];
            $limit = $_GET['limit'];
            $sql .= " LIMIT $limit OFFSET $offSet";
        }

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Query Failed: " . mysqli_error($conn));
        }

        $response = [];

        while($row = mysqli_fetch_assoc($result)) {
            $items = [];
            $itemsData = json_decode($row["items"], true);

            foreach ($itemsData as $item) {
                $items[] = array(
                    'item_id' => $item['item_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'total_price' => $item['total_price']
                );
            }

            $response[] = array(
                'po_id' => $row["po_id"],
                'items' => $items,
                'grand_total' => $row["grand_total"],
                'customer_name' => $row["customer_name"],
                'delivery_address' => $row["delivery_address"]
            );
        }

        echo json_encode($response);
        $conn->close();
    }
?>
