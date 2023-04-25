<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../css/custome.css">
    <link rel="stylesheet" href="../css/styles1.css">
    <link rel="stylesheet" href="../css/login.css">
      <link rel="stylesheet" href="../css/icons/all.css">
    <script src="../js/login.js"></script>
    <script>
        function togglePassword(passwordFieldID) {
            var passwordField = document.getElementById(passwordFieldID);
            var showPasswordButton = document.getElementById('show-' + passwordFieldID);

            if (passwordField.type === "password") {
                passwordField.type = "text";
                showPasswordButton.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                passwordField.type = "password";
                showPasswordButton.innerHTML = '<i class="fab fa-eye-slash"></i>';
            }
        }
    </script>
</head>
<?php
include_once("../connectDB.php");
if (isset($_SESSION['us'])) {
    $account = $_SESSION['us'];
    $query = mysqli_query($Connect, "SELECT password from customer where username='$account' ");
    $row = mysqli_fetch_array($query);
?>
    <div class="container">
        <div class="login-box">
            <form method="post">
                <div class="user-box">
                    <input type="password" name="txtPass1" required="" id="txtPass" value="">
                    <label style="color:aliceblue">Password</label>
                    <span id="show-password1" class="toggle-password" onclick="togglePassword('txtPass')">
                        <i class="fab fa-eye-slash"></i>
                    </span>
                </div>
                <div class="user-box">
                    <input type="password" name="txtPass2" required="" id="txtPass2" value="">
                    <label style="color:aliceblue">Confirm Password</label>
                    <span id="show-password2" class="toggle-password" onclick="togglePassword('txtPass2')">
                        <i class="fab fa-eye-slash"></i>
                    </span>
                </div>
                <div class="user-box">
                    <button type="submit" class="button" name="btnUpdate" id="btnUpdate">Update</button>
                </div>
            </form>
        </div>
    </div>
<?php
    if (isset($_POST['btnUpdate'])) {
        $pass = $_POST['txtPass1'];
        $pas = md5($pass);

        $query  = "UPDATE customer SET  password ='$pas' where username ='$account'";
        $result = mysqli_query($Connect, $query) or die(mysqli_error($Connect));
        echo "<script>
        $(document).ready(function() { 
        swal({
          title: 'Success!',
          text: 'Update password success!',
          icon: 'success',
          button: 'OK',
        }).then(function() {
          window.location.href = '?page=reps';
        });
        });
        </script>";
    }
}
?>