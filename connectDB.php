<?php
	$Connect = mysqli_connect('us-cdbr-east-06.cleardb.net', 'b980a434a38467', '6d630c6f') or die ('Unable to connect. Check your connection parameters.');
	mysqli_select_db($Connect, 'heroku_6dead27a6a7d6f3' ) or die(mysqli_error($Connect));
    ?>
