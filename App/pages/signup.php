<?php
$conn = mysqli_connect('127.0.0.1:3306','u733671518_wibs','|4Kh/3XYD','u733671518_project');
#$conn = mysqli_connect('localhost','root','','u733671518_project');
$error = array();

if (isset($_POST['submit'])) {

  $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
  $name = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = md5($_POST['password']);
  $cpass = md5($_POST['confirm_password']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);

  $select = "SELECT * FROM customer WHERE email = '$email'";

  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {
    $error[] = 'User already exists!';
  } else {
    if ($pass != $cpass) {
      $error[] = 'Passwords do not match!';
    } else {
      $insert = "INSERT INTO customer(firstname, lastname, name, email, password, address) VALUES('$firstname', '$lastname', '$name', '$email', '$pass', '$address')";
      mysqli_query($conn, $insert);
      header('location:login.php');
      exit;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/signup_styles.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
  <title>WIBS Sign Up</title>
</head>

<body>
  <header class="header">
    <div class="header-icon"><a href="../landing_page/landing.html">Back</a></div>
    <div class="header-title"><img src="../ASSETS/Company Name.png" alt=""></div>
  </header>

  <div class="content">
    <div class="content-image">
      <img src="../ASSETS/Man presenting business idea on laptop.png" alt="">
    </div>

    <?php
    if (!empty($error)) {
      foreach ($error as $err) {
        echo '<span class="error-msg">' . $err . '</span>';
      }
    }
    ?>

    <div class="content-form">
      <form id="signup-form" method="post">
        <h1>Sign Up</h1>

        <div class="form-group">
          <label for="firstname">First Name</label>
          <input type="text" id="firstname" name="firstname" placeholder="Input First Name" />
        </div>

        <div class="form-group">
          <label for="lastname">Last Name</label>
          <input type="text" id="lastname" name="lastname" placeholder="Input Last Name" />
        </div>

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Input Username" />
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" id="email" name="email" placeholder="Input Email" />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Input Password" />
        </div>

        <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" />
        </div>

        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" id="address" name="address" placeholder="Input Address" />
        </div>

        <div class="form-group">
          <button id="signup" type="submit" name="submit">Sign Up</button>
        </div>
        <div id="signupResult"></div>
        <div class="signup-link">
          Already have an account? <a href="login.php">Sign In</a>.
        </div>
      </form>
    </div>
  </div>
  <footer>
    <img src="../ASSETS/Blue shopping bag in air.png" alt="">
  </footer>
</body>
<script src="script.js"></script>

</html>