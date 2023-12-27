<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = mysqli_connect('localhost','root','','ecommerce');

session_start();

$errors = array();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
 
    $select = "SELECT * FROM user_form WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $select);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['user_name'] = $row['name'];
        header('location: ../homepage/homepage.php');
        exit();
    } else {
        $errors[] = 'Incorrect email or password!';
    }
}
?>	

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="login_styles.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <title>WIBS Login</title>
</head>

<body>
    <header class="header">
        <div class="header-icon"><a href="../landing_page/landing.php">Back</a></div>
        <div class="header-title"><img src="../Documents/ASSETS/Company Name.png" alt="pciture"></div>
    </header>

    <div class="content">   
        <div class="content-image">
            <img src="../ASSETS/Red haired man with raised hand.png" alt="ASDASd">
        </div>
        <div class="content-form">
            <form action="" method="post">
                <h1>Sign In</h1>
                <?php
                if (!empty($errors)) {
                    echo '<div class="error-msg">' . implode('<br>', $errors) . '</div>';
                }
                ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Input Email" required />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Input Password" required />
                </div>
                <div class="form-group">
                    <button id="submit" type="submit" name="submit">Sign In</button>
                </div>
                <div id="loginResult"></div>
                <div class="signup-link">
                    Don't have an account? <a href="../signup/signup.php">Sign Up</a>.
                </div>
            </form>
        </div>
    </div>
    <footer>
        <img src="/Documents/ASSETS/open cardboard box.png" alt="">
    </footer>
</body>
<script src="script.js"></script>

</html>