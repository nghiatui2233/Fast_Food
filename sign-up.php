<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="./css/custome.css">
  <link rel="stylesheet" href="./css/styles1.css">
  <link rel="stylesheet" href="./css/login.css">
  <script src="js/login.js"></script>
</head>

<?php
include 'header.php';
if (isset($_POST['btnRegister'])) {
  $us = $_POST['txtUsername'];
  $email = $_POST['txtEmail'];
  $phone = $_POST['txtPhone'];
  $pass1 = $_POST['txtPass1'];
  $pass2 = $_POST['txtPass2'];
  $err = "";

  if (empty($us) || empty($pass1) || empty($pass2)) {
    $err .= "";
    echo "<script>
    $(document).ready(function() { 
    swal({
      title: 'Error!',
      text: 'Username and password fields cannot be empty!',
      icon: 'error',
      button: 'OK',
    }).then(function() {
      window.location.href = '?page=sign-up';
    });
    });
    </script>";
  } else if (strlen($pass1) <= 5) {
    $err .= "";
    echo "<script>
    $(document).ready(function() { 
    swal({
      title: 'Error!',
      text: 'Password must be greater than 5 chars!',
      icon: 'error',
      button: 'OK',
    }).then(function() {
      window.location.href = '?page=sign-up';
    });
    });
    </script>";
  } else if ($pass1 != $pass2) {
    $err .= "";
    echo "<script>
    $(document).ready(function() { 
    swal({
      title: 'Error!',
      text: 'Password and confirm password are not the same!',
      icon: 'error',
      button: 'OK',
    }).then(function() {
      window.location.href = '?page=sign-up';
    });
    });
    </script>";
  } else {
    include("connectDB.php");
    $pass = md5($pass1);
    $sq = "SELECT * FROM customer WHERE UserName='$us'";
    $res = mysqli_query($Connect, $sq);
    if (mysqli_num_rows($res) == 0) {
      mysqli_query($Connect, "INSERT INTO customer (UserName, Password, Email, Phone)
             VALUES ('$us','$pass','$email','$phone','".date('Y-m-d H:i:s')."')") or die(mysqli_error($Connect));
      echo "<script>
      $(document).ready(function() { 
      swal({
        title: 'Success!',
        text: 'Sign Up successfully!',
        icon: 'success',
        button: 'OK',
      }).then(function() {
        window.location.href = '?page=sign-in';
      });
      });
    </script>";
    } else {
      echo "<script>
      $(document).ready(function() { 
      swal({
        title: 'Success!',
        text: 'Username already exists!',
        icon: 'success',
        button: 'OK',
      }).then(function() {
        window.location.href = '?page=sign-in';
      });
      });
    </script>";
    }
  }
}
?>
<div class="container">
  <div class="login-box">
    <h2>Sign up</h2>
    <form id="form1" name="form1" method="POST" action="" onsubmit="return process()">
      <div class="user-box">
        <input type="text" name="txtUsername" id="txtUsername" required="" value="">
        <label style="color:aliceblue">Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="txtPass1" required="" id="txtPass" value="">
        <label style="color:aliceblue">Password</label>
        <span id="show-password1" class="toggle-password" onclick="togglePassword('txtPass')">
          <i class="fas fa-eye-slash"></i>
        </span>
      </div>
      <div class="user-box">
        <input type="password" name="txtPass2" required="" id="txtPass2" value="">
        <label style="color:aliceblue">Confirm Password</label>
        <span id="show-password2" class="toggle-password" onclick="togglePassword('txtPass2')">
          <i class="fas fa-eye-slash"></i>
        </span>
      </div>
      <div class="user-box">
        <input type="text" name="txtPhone" id="txtUsername" required="" value="">
        <label style="color:aliceblue">Phone</label>
      </div>
      <div class="user-box">
        <input type="text" name="txtEmail" id="txtUsername" required="" value="">
        <label style="color:aliceblue">Email</label>
      </div>
      <button type="submit" name="btnRegister" class="button" id="btnRegister">Sign Up</button>
      <button type="button" name="btnCancel" class="button" id="btnCancel" onclick="window.location='?page=content'">Cancel </button>
    </form>
  </div>
</div>
<script>
  function togglePassword(passwordFieldID) {
    var passwordField = document.getElementById(passwordFieldID);
    var showPasswordButton = document.getElementById('show-' + passwordFieldID);

    if (passwordField.type === "password") {
      passwordField.type = "text";
      showPasswordButton.innerHTML = '<i class="fas fa-eye"></i>';
    } else {
      passwordField.type = "password";
      showPasswordButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
    }
  }
</script>