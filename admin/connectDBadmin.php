<?php
	$Connect = mysqli_connect('us-cdbr-east-06.cleardb.net', 'b7744dfc44845d', '6d7ae5f1') or die ('Unable to connect. Check your connection parameters.');
	mysqli_select_db($Connect, 'heroku_11611480e551f18' ) or die(mysqli_error($Connect));
    ?>
