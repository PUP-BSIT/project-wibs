<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once('http://wibs.tech/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform password hashing for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true, 'message' => 'User registered successfully');
    } else {
        $response = array('success' => false, 'message' => 'Error registering user: ' . $conn->error);
    }

    echo json_encode($response);
}

$conn->close();
?>
