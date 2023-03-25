<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <title>Fast food</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="Vinyl Template">
    <meta name="keywords" content="Vinyl, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Main CSS -->
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/icons/all.css">
</head>

<body>
    <?php
    session_start();
    include_once("connectDB.php");
    ?>
    <div class="container">
        <!-- Left Side Navbar -->
        <nav class="side-nav">
            <ul class="nav-links">
                <?php
                $sql = "SELECT * FROM category";
                $result = $Connect->query($sql);

                // Kiểm tra kết quả và hiển thị các danh mục với biểu tượng tương ứng
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["category_id"];
                        $name = $row["category_name"];
                        $icon = $row["icon"];
                ?>
                        <li><a href="index.php?=categorylist&id=<?php echo $row['category_id'] ?>" class="nav-item" data-target="<?php echo $id; ?>"><i class="fas <?php echo $icon; ?>" style="font-size:24px;margin-bottom:3px;"></i><?php echo $name; ?></a></li>
                <?php
                    }
                }

                ?>
            </ul>
        </nav>
        <!-- End Left Side Navbar -->

        <!-- Right Body -->
        <div class="main-body">
            <!-- Header -->
            <header class="header">

                <div class="logo">
                    <h2 type="submit" href="?page=content"> Fast Food</h2>
                </div>
                <div class="usr-toggle">
                    <?php
                    if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
                    ?>
                        <ul class="nav-links header">
                            <li><a href="#" class="nav-item"><i class="fas fa-list-ul"></i></a></li>
                            <div class="dropdown">
                                <li onclick="toggleMenu()"><a class="nav-item"><i class="fas fa-cog"></i></a></li>
                                <div class="dropdown-content">
                                    <a href="?page=profile" class="nav-item active">Update Profile</a>
                                    <a href="#">Change Password</a>
                                    <a href="#">Link 3</a>
                                </div>
                            </div>
                            <li><a href="?page=content" style="color:#FFF"> Hi, <?php echo $_SESSION['us']; ?></a></li>
                            <li><a href="?page=logout" style="color:#FFF">|</a></li>
                            <li><a href="?page=logout" style="color:#FFF">Log Out</a></li>
                        </ul>
                    <?php
                    } else {
                    ?>
                        <ul class="nav-links header">
                            <li><a href="?page=sign-in" class="nav-item"><i class="fas fa-user"></i></a></li>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </header>
            <!-- End Header -->
            <main>
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page == "sign-in") {
                        include_once('sign-in.php');
                    }
                    if ($page == "sign-up") {
                        include_once('sign-up.php');
                    }
                    if ($page == "content") {
                        include_once('content.php');
                    }
                    if ($page == "logout") {
                        include_once('logout.php');
                    }
                    if ($page == "profile") {
                        include_once('profile.php');
                    }
                    if ($page == "up") {
                        include_once('update-profile.php');
                    }
                    if ($page == "admin") {
                        include_once('admin/index.php');
                    }
                } else {
                    include_once("content.php");
                }
                ?>
            </main>
            <!-- Optional JavaScript -->
            <script src="js/icons/all.js"></script>
            <script src="js/main.js"></script>
            <script>
                function toggleMenu() {
                    var dropdown = document.querySelector('.dropdown');
                    dropdown.classList.toggle('active');
                }
            </script>
</body>

</html>