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
    <link rel="stylesheet" href="./css/styles1.css">
    <link rel="stylesheet" href="./css/profile.css" />
    <link rel="stylesheet" href="./css/icons/all.css">
    	<!-- Link to jQuery library -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Link to SweetAlert library -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <?php
    session_start();
    include_once("connectDB.php");
    ?>
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
                    if ($page == "cart") {
                        include_once('cart.php');
                    }
                    if ($page == "logout") {
                        include_once('logout.php');
                    }
                } else {
                    include_once("content.php");
                }
                
                ?>
            </main>
    <!-- Optional JavaScript -->
    <script src="js/icons/all.js"></script>
    <script>
        function toggleMenu() {
            var dropdown = document.querySelector('.dropdown');
            dropdown.classList.toggle('active');
        }
    </script>
</body>

</html>