<?php
	$Connect = mysqli_connect('localhost', 'root', '') or die ('Unable to connect. Check your connection parameters.');
	mysqli_select_db($Connect, 'fast_food' ) or die(mysqli_error($Connect));
    ?>