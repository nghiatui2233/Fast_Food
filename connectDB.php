<?php
	$Connect = mysqli_connect('us-cdbr-east-06.cleardb.net', 'be7afbe95a7c92', '7e63e8a1') or die ('Unable to connect. Check your connection parameters.');
	mysqli_select_db($Connect, 'us-cdbr-east-06.cleardb.net' ) or die(mysqli_error($Connect));
    ?>
