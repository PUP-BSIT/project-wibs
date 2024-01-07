<?php

// Ensure handling of POST requests only
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve POST parameters
    $order_id = isset($_POST['order_id']) ? $_POST['order_id'] : null;
    $new_status = isset($_POST['new_status']) ? $_POST['new_status'] : null;

    // Input validation
    if (is_null($order_id) || is_null($new_status)) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing parameters.']);
        exit;
    }

    // Database update logic here (mocked as successful for this example)
    
    // Assuming the update was successful
    http_response_code(200);
    echo json_encode(['result' => 'success', 'message' => 'Delivery status updated successfully.']);

    // Error handling (if update fails) would go here
} else {
    // Handling non-POST requests
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed.']);
}

?>
