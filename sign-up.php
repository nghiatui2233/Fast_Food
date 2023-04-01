<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/custome.css">
	<script src="js/login.js"></script>
</head>

<?php
if (isset($_POST['btnRegister'])) {
  $us = $_POST['txtUsername'];
  $pass1 = $_POST['txtPass1'];
  $pass2 = $_POST['txtPass2'];
  $err = "";

  if (strlen($pass1) <= 5) {
    $err .= "";
    echo "<script>
    $(document).ready(function() { 
    swal({
      title: 'Error!',
      text: 'Password must be greater than 5 chars!',
      icon: 'error',
      button: 'OK',
    }).then(function() {
      window.location.href = '?page=content';
    });
    });
  </script>";
  }
  if ($pass1 != $pass2) {
    $err .= "";
    echo "<script>
    $(document).ready(function() { 
    swal({
      title: 'Error!',
      text: 'Password and confirm password are the same!',
      icon: 'error',
      button: 'OK',
    }).then(function() {
      window.location.href = '?page=content';
    });
    });
  </script>";
  }
  if ($err != "") {
    echo $err;
  } else {
    include("connectDB.php");
    $pass = md5($pass1);
    $sq = "SELECT * FROM customer WHERE UserName='$us'";
    $res = mysqli_query($Connect, $sq);
    if (mysqli_num_rows($res) == 0) {
      mysqli_query($Connect, "INSERT INTO customer (UserName, Password, State)
             VALUES ('$us','$pass',0)") or die(mysqli_error($Connect));
      echo "<script>
      $(document).ready(function() { 
      swal({
        title: 'Success!',
        text: 'Sign Up successfully!',
        icon: 'success',
        button: 'OK',
      }).then(function() {
        window.location.href = '?page=content';
      });
      });
    </script>";
    } else {
      echo "Username already exists";
    }
  }
}
?>
<div class="container">
  <div class="login-box">
    <h2>Sign up</h2>
    <form id="form1" name="form1" method="POST" action="" onsubmit="return process()">
      <div class="user-box">
        <input type="text" name="txtUsername" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" id="pwd" name="txtPass1" required="">
        <label>Password</label>
      </div>
      <div class="user-box">
        <input type="password" id="pwd" name="txtPass2" required="">
        <label>Confirm Password</label>
      </div>
      <button type="submit" name="btnRegister" class="button" id="btnRegister">Sign Up</button>
      <button type="button" name="btnCancel" class="button" id="btnCancel" onclick="window.location='?page=content'">Cancel </button>
  </div>
</div>