<head>
    <!-- Main CSS -->
</head>
<div class="body">
    <!-- Header -->
    <header class="header">
        <?php
        include_once("connectDB.php");
        if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
        ?>
            <div class="logo">
                <h2 href="?page=index"> Fast Food</h2>
            </div>
            <div class="search-bar">
                <input type="text" name="menu" placeholder="Search menu..">
                <button type="button"><i class="fas fa-search"></i></button>
            </div>
            <div class="usr-toggle">
                <ul class="nav-links header">
                    <table>
                        <tr>
                            <td>
                                <a href="?page=index" style="color:#FFF"><i class="fa fa-user" style="color:#FFF"></i> Hi,<?php echo $_SESSION['us'] ?></a>
                            </td>
                            <td>
                                <a href="?page=logout" style="color:#FFF"><i class="fa fa-sign-out" style="color:#FFF"></i>| Log Out</a>
                            </td>

                        </tr>
                    </table>
                    <li><a href="#" class="nav-item"><i class="fas fa-list-ul"></i></a></li>
                    <li><a href="?page=profile" class="nav-item"><i class="fas fa-cog"></i></a></li>
                </ul>
            </div>
        <?php
        } else {
        ?>
            <div class="logo">
                <h2 type="submit" href="?page=index"> Fast Food</h2>
            </div>
            <div class="search-bar">
                <input type="text" name="menu" placeholder="Search menu..">
                <button type="button"><i class="fas fa-search"></i></button>
            </div>
            <div class="usr-toggle">
                <ul class="nav-links header">
                    <li><a href="#" class="nav-item"><i class="fas fa-list-ul"></i></a></li>
                    <li><a href="?page=profile" class="nav-item"><i class="fas fa-cog"></i></a></li>
                    <li><a href="?page=sign-in" class="nav-item"><i class="fas fa-user"></i></a></li>
                    <li><a href="?page=sign-up" class="nav-item"><i class="fas fa-user"></i></a></li>
                </ul>
            </div>
        <?php
        }
        ?>
    </header>
</div>