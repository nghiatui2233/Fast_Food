<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- or -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>

<body onload="time()" class="app sidebar-mini rtl">
  <?php
  session_start();
  include_once("connectDBadmin.php");
  ?>
  <!-- Navbar-->
  <header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


      <!-- User Menu-->
      <li><a class="app-nav__item" href="../?page=logout"><i class='bx bx-log-out bx-rotate-180'></i> </a>

      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <?php
    if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
    ?>
      <div class="app-sidebar__user">
        <div>
          <p class="app-sidebar__user-name"><b><?php echo $_SESSION['us']; ?></b></p>
          <p class="app-sidebar__user-designation">Welcome back</p>
        </div>
      </div>
    <?php
    }
    ?>
    <hr>
    <ul class="app-menu">
      <li><a class="app-menu__item " href="?page=content"><i class='app-menu__icon bx bx-tachometer'></i><span class="app-menu__label">Dashboard</span></a></li>
      <li><a class="app-menu__item" href="?page=cus"><i class='app-menu__icon bx bx-user-voice'></i><span class="app-menu__label">Customer Management</span></a></li>
      <li><a class="app-menu__item" href="?page=tdproduct"><i class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Product Management</span></a></li>
      <li><a class="app-menu__item" href="?page=tdcat"><i class='app-menu__icon fas fa-solid fa-layer-group'></i><span class="app-menu__label">Category Management</span></a></li>
      <li><a class="app-menu__item" href="?page=order"><i class='app-menu__icon bx bx-task'></i><span class="app-menu__label">Order Management</span></a></li>
      </li>
    </ul>
  </aside>
  <main>
    <?php
      if (isset($_SESSION['us']) && $_SESSION['us'] === true) { 
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
      if ($page == "tdproduct") {
        include_once('table-data-product.php');
      }
      if ($page == "addproduct") {
        include_once('form-add-product.php');
      }
      if ($page == "editpro") {
        include_once('edit-product.php');
      }
      if ($page == "tdcat") {
        include_once('table-data-category.php');
      }
      if ($page == "addcat") {
        include_once('form-add-category.php');
      }
      if ($page == "editcat") {
        include_once('edit-category.php');
      }
      if ($page == "cus") {
        include_once('table-data-customer.php');
      }
      if ($page == "order") {
        include_once('table-data-order.php');
      }
      if ($page == "content") {
        include_once("content-admin.php");
      }      if ($page == "dt") {
        include_once("order_detail.php");
      }
    } else {
      include_once("content-admin.php");
    }
  } else {
    echo '<meta http-equiv="refresh" content="0; URL=../sign-in.php"/>';
  }
    ?>
  </main>
  <script src="js/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="js/popper.min.js"></script>
  <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
  <!--===============================================================================================-->
  <script src="js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="js/main.js"></script>
  <!--===============================================================================================-->
  <script src="js/plugins/pace.min.js"></script>
  <!--===============================================================================================-->
  <script type="text/javascript" src="js/plugins/chart.js"></script>
  <!--===============================================================================================-->
  <script src="js/time.js"></script>
</body>

</html>
