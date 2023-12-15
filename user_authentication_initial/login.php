<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once('http://wibs.tech/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $response = array('success' => true, 'message' => 'Login successful');
        } else {
            $response = array('success' => false, 'message' => 'Invalid password');
        }
    } else {
        $response = array('success' => false, 'message' => 'User not found');
    }

    echo json_encode($response);
}

$conn->close();
?>
