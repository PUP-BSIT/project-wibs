<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Basic validation
    if (empty($username) || empty($password)) {
        echo "All fields are required.";
    } else {
        // Connect to the database (replace with your database credentials)
        $servername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "user_database";

        $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert user data into the database (replace with prepared statements)
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful! Username: $username";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>