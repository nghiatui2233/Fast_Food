<style>
    img {
        width: 350px;
        /* Độ rộng của hình ảnh */
        height: auto;
        display: block;
        margin: 0 auto;
        margin-top: 20px;
    }
</style>
<header class="header">
    <div class="logo">
        <h2><a href="?page=content"><img src="./img/HatchfulExport-All/logo_transparent.png"></a></h2>
    </div>
    <div class="usr-toggle">
        <?php
        if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
        ?>
            <ul class="nav-links header">
                <li><a href="account/menu-profile.php" style="color:#FFF"> Hi, <?php echo $_SESSION['us']; ?></a></li>
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