<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="./css/custome.css">
	<link rel="stylesheet" href="./css/styles.css">
	<script src="js/login.js"></script>
</head>
<script>
	function process() {
		n = document.getElementById("txtUsername");
		pass = document.getElementById("txtPass");
		if (us.value == "") {
			alert("Enter Username please");
			return false;
		}
	}
</script>
<body>
	<?php

	if (isset($_POST['btnLogin'])) {
		$us = $_POST['txtUsername'];
		$pass = $_POST['txtPass'];
		$_POST['name'] = 'asdasdsa';
		$err = "";
		if ($us == "") {
			$err .= "Enter Username, please</br>";
		}
		if ($pass == "") {
			$err .= "Enter Password, please</br>";
		}
		if ($err != "") {
			echo $err;
		} else {
			include_once("connectDB.php");
			$pas = md5($pass);
			$res = mysqli_query($Connect, "SELECT username, password FROM customer WHERE username='$us' AND password='$pas'")
				or die(mysqli_error($Connect));
			if (mysqli_num_rows($res) == 0) {
				$_SESSION["admin"]= $row["state"];
				echo '<meta http-equiv="refresh" content="0;URL =./admin/	index.php"/>';
			}elseif(mysqli_num_rows($res) == 1){
				$_SESSION["us"]=$us;
				echo '<meta http-equiv="refresh" content="0;URL =?page=content"/>';
			} else {
				echo '<a style="color:#FF0000;">You loged in fail, please try again</a>';
			}
		}
	}
	if (isset($_POST['btnCancel'])) {
		echo '<meta http-equiv="refresh" content="0;URL =?page=content"/>';
	}
	?>
	<div class="container">
		<div class="login-box">
			<h2>Sign in</h2>
			<form id="form1" name="form1" method="POST" action="" onsubmit="return process()">
				<div class="user-box">
					<input type="text" name="txtUsername" id="txtUsername" required="" value="">
					<label style="color:aliceblue">Username</label>
				</div>
				<div class="user-box">
					<input type="password" name="txtPass" required="" id="txtPass value=">
					<label style="color:aliceblue">Password</label>

				</div>
				<button type="submit" name="btnLogin" class="button" id="btnLogin">Sign In</button>
				<button type="button" name="btnCancel" class="button" id="btnCancel" onclick="window.location='?page=sign-up'">Sign Up </button>
			</form>
		</div>
	</div>
</body>