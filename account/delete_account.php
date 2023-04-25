<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];

  include_once("../connectDB.php");

  // Delete all info of account
  mysqli_query($Connect, "DELETE FROM orders WHERE username='$username'");
  mysqli_query($Connect, "DELETE FROM customer WHERE username='$username'");

  // Log out user and redirect to index page
  session_start();
  session_destroy();
  header("Location: ../index.php");
  exit();
}

