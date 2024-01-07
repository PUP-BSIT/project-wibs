<?php

// This line ensures we only handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST parameters
    $po_id = isset($_POST['po_id']) ? $_POST['po_id'] : null;
    $delivery_reference_number = isset($_POST['delivery_reference_number']) ? $_POST['delivery_reference_number'] : null;
    
    // Perform input validation, for example:
    if (is_null($po_id) || is_null($delivery_reference_number)) {
        // Missing parameters, so we return a 400 Bad Request
        http_response_code(400);
        echo json_encode(['error' => 'Missing parameters.']);
        exit;
    }

    // Database configuration
    $conn = mysqli_connect('127.0.0.1:3306','u733671518_wibs','|4Kh/3XYD','u733671518_project');

    // Check connection
    if ($mysqli->connect_error) {
        http_response_code(500);
        echo json_encode(['result' => 'error', 'message' => 'Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error]);
        exit;
    }

    // Prepare SQL statement to update the delivery status
    $stmt = $mysqli->prepare("UPDATE purchase_orders SET status = '2' WHERE po_id = ?");
    
    // Check for errors in preparing the statement
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(['result' => 'error', 'message' => 'Prepare Error: ' . $mysqli->error]);
        $mysqli->close();
        exit;
    }
    
    // Bind the parameters
    $stmt->bind_param('i', $po_id);

    // Execute the statement
    if ($stmt->execute()) {
        // If everything is fine, return a success message
        http_response_code(200);
        echo json_encode(['result' => 'success', 'message' => 'Delivery status updated successfully.']);
    } else {
        // If there was an error, return a 500 Internal Server Error
        http_response_code(500);
        echo json_encode(['result' => 'error', 'message' => 'Execute Error: ' . $stmt->error]);
    }
    
    // Close statement and connection
    $stmt->close();
    $mysqli->close();
} else {
    // If the request is not a POST, return a 405 Method Not Allowed
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed.']);
}

?>
