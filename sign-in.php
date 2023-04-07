<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="./css/custome.css">
	<link rel="stylesheet" href="./css/styles1.css">
	<link rel="stylesheet" href="./css/login.css">
	<script src="js/login.js"></script>
</head>

<body>
	<?php
	include 'header.php';
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
			$user = mysqli_query($Connect, "SELECT username, password FROM customer WHERE username='$us' AND password='$pas'")
				or die(mysqli_error($Connect));
			$admin = mysqli_query($Connect, "SELECT account, password FROM admin WHERE account='$us' AND password='$pas'")
				or die(mysqli_error($Connect));
			if (mysqli_num_rows($user) == 1) {
				$_SESSION["us"] = $us;
				echo "<script>
				$(document).ready(function() { 
				swal({
					title: 'Success!',
					text: 'Login successfully!',
					icon: 'success',
					button: 'OK',
				}).then(function() {
					window.location.href = '?page=content';
				});
				});
			</script>";
			} elseif (mysqli_num_rows($admin) == 1) {
				$_SESSION["us"] = $us;
				echo "<script>
				$(document).ready(function() { 
				swal({
					title: 'Success!',
					text: 'Welcome back admin!',
					icon: 'success',
					button: 'OK',
				}).then(function() {
					window.location.href = './admin/index.php';
				});
				});
			</script>";
			} else {
				echo "<script>
				$(document).ready(function() { 
				swal({
					title: 'Fail!',
					text: 'Incorrect account or password!',
					icon: 'error',
					button: 'OK',
				})
				});
			</script>";
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
					<input type="password" name="txtPass" required="" id="txtPass" value="">
					<label style="color:aliceblue">Password</label>
					<span id="show-password" class="toggle-password" onclick="togglePassword()">
						<i class="far fa-eye-slash"></i>
					</span>
				</div>
				<button type="submit" name="btnLogin" class="button" id="btnLogin">Sign In</button>
				<button type="button" name="btnCancel" class="button" id="btnCancel" onclick="window.location='?page=sign-up'">Sign Up </button>
			</form>
		</div>
	</div>
	<script>
		function togglePassword() {
			var passwordField = document.getElementById("txtPass");
			var showPasswordButton = document.getElementById("show-password");

			if (passwordField.type === "password") {
				passwordField.type = "text";
				showPasswordButton.innerHTML = '<i class="far fa-eye"></i>';
			} else {
				passwordField.type = "password";
				showPasswordButton.innerHTML = '<i class="far fa-eye-slash"</i>';
			}
		}
	</script>
</body>