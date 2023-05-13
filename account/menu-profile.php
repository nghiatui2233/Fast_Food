<head>
  <meta charset="UTF-8">
  <title>Account</title>
  <link rel="stylesheet" href="../css/custome.css">
  <link rel="stylesheet" href="../css/styles1.css">
  <link rel="stylesheet" href="../css/profile.css">
  <link rel="stylesheet" href="../css/icons/all.css">
  <!-- Link to jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Link to SweetAlert library -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="../js/login.js"></script>
  <style>
    .container-account {
      width: 100%;
      height: 100vh;
      display: flex;
      background-color: #17181c;
      overflow: auto;
    }
  </style>
</head>

<body>
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
        <li <?= ($current_page == 'yor') ? 'class="active"' : '' ?>><a href="?page=yor">Your Order</a></li>
        <li <?= ($current_page == 'pf') ? 'class="active"' : '' ?>><a href="?page=pf">Account details</a></li>
        <li <?= ($current_page == 'reps') ? 'class="active"' : '' ?>><a href="?page=reps">Reset Password</a></li>
        <li <?= ($current_page == 'delete') ? 'class="active"' : '' ?>><a href="?page=delete">Delete account</a></li>
      </ul>
      <div class="back-button-container">
        <button onclick="window.location='../index.php'" class="button">Back</button>
      </div>
    </div>
    <div class="container-account">
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
          if ($page == "yor") {
            include_once('your-order.php');
          }
          if ($page == "logout") {
            include_once('../logout.php');
          }
          if ($page == "delete") {
            include_once('delete-account.php');
          }
        } else {
          include_once("profile.php");
        }
        ?>
      </main>
    </div>
  </div>
</body>
