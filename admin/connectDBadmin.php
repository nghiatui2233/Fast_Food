<?php
	$Connect = mysqli_connect("localhost", "root", "", "fast_food");
if (!$Connect) {
    die("Connection failed: " . mysqli_connect_error());
}
    ?>