<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or another appropriate page
header("Location: login.php"); // Adjust the path to your login page as necessary
exit;
?>