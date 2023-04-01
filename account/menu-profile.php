<head>
  <meta charset="UTF-8">
  <title>Account</title>
  <link rel="stylesheet" href="../css/custome.css">
  <link rel="stylesheet" href="../css/styles1.css">
  <link rel="stylesheet" href="../css/profile.css">
  <script src="js/login.js"></script>
</head>
<?php
$current_page = isset($_GET['page']) ? $_GET['page'] : 'pf';
?>
<div class="container">
  <div class="account-left">
    <div class="account-profile">
      <?php
      session_start();
      if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
      ?>
        <h2>Hi, <br /><?php echo $_SESSION['us']; ?>!</h2>
        <p><a href="?page=logout">Logout</a></p>
      <?php
      }
      ?>
    </div>
    <ul>
      <li <?= ($current_page == 'order') ? 'class="active"' : '' ?>><a href="#">Order booked</a></li>
      <li <?= ($current_page == 'address') ? 'class="active"' : '' ?>><a href="#">Your address</a></li>
      <li <?= ($current_page == 'pf') ? 'class="active"' : '' ?>><a href="?page=pf">Account details</a></li>
      <li <?= ($current_page == 'reps') ? 'class="active"' : '' ?>><a href="?page=reps">Reset Password</a></li>
      <li <?= ($current_page == 'delete') ? 'class="active"' : '' ?>><a href="#">Delete account</a></li>
    </ul>
    <div class="back-button-container">
      <button onclick="window.location='../index.php'" class="button"><i class="fa fa-chevron-left"></i>Back</button>
    </div>
  </div>
  <?php
  include_once("../connectDB.php");
  ?>
  <main>
    <?php
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
      if ($page == "pf") {
        include_once('profile.php');
      }
      if ($page == "reps") {
        include_once('reset-password.php');
      }
      if ($page == "logout") {
        include_once('../logout.php');
      }
    } else {
      include_once("profile.php");
    }
    ?>
  </main>
</div>