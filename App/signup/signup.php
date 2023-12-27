<?php
$conn = mysqli_connect('localhost','root','','ecommerce');

$error = array(); 

if (isset($_POST['submit'])) {

  $name = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']); 
  $pass = md5($_POST['password']);
  $cpass = md5($_POST['confirm_password']); 

  $select = "SELECT * FROM user_form WHERE email = '$email'";

  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) > 0) {
    $error[] = 'User already exists!';
  } else {
    if ($pass != $cpass) {
      $error[] = 'Passwords do not match!';
    } else {
      $insert = "INSERT INTO user_form(name, email, password) VALUES('$name','$email','$pass')";
      mysqli_query($conn, $insert);
      header('location: ../login/login.php');
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
  <link rel="stylesheet" href="signup_styles.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
  <title>WIBS Sign Up</title>
</head>

<body>
  <header class="header">
    <div class="header-icon"><a href="../landing_page/landing.php">Back</a></div>
    <div class="header-title"><img src="./ASSETS/Company Name.png" alt=""></div>
  </header>

  <div class="content">
    <div class="content-image">
      <img src="./ASSETS/Man presenting business idea on laptop.png" alt="">
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
          <button id="signup" type="submit" name="submit">Sign Up</button>
        </div>
        <div id="signupResult"></div>
        <div class="signup-link">
          Already have an account? <a href="../login/login.php">Sign In</a>.
        </div>
      </form>
    </div>
  </div>
  <footer>
    <img src="./ASSETS/Blue shopping bag in air.png" alt="">
  </footer>
</body>
<script src="script.js"></script>

</html>
