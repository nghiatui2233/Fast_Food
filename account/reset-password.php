<head>
    <script>
        function updateNotice() {
            if (confirm("You have update successfully")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</head>
<?php
include_once("../connectDB.php");
if (isset($_SESSION['us'])) {
    $query = mysqli_query($Connect, "SELECT * from customer ");
    $row = mysqli_fetch_array($query);
?>
    <div class="container">
        <div class="login-box">
            <form method="post">
                <div class="user-box">
                    <input type="password" id="pwd" name="txtPass1" required="" value="">
                    <label>Password</label>
                </div>
                <div class="user-box">
                    <input type="password" id="pwd" name="txtPass2" required="" value="">
                    <label>Confirm Password</label>
                </div>
                <div class=" user-box">
                    <button type="submit" class="button" name="btnUpdate" id="btnUpdate" onclick="return updateNotice()">Update</button>
                    <button type="button" class="button" name="btnIgnore" id="btnIgnore" onclick="window.location='?page=content'">Ignore</button>
                </div>
            </form>
        </div>
    </div>
<?php
    if (isset($_POST['btnUpdate'])) {
        include_once("ConnectDB.php");
        $Username = $_POST['Username'];
        $Cusname = $_POST['txtCustName'];
        $Gender = $_POST['txtgender'];
        $Address = $_POST['txtAddress'];
        $telephone = $_POST['txttelephone'];
        $email = $_POST['txtEmail'];
        $CusDate = $_POST['slDate'];
        $CusMonth = $_POST['slMonth'];
        $CusYear = $_POST['slYear'];

        $query  = "UPDATE customer SET  customername ='$Cusname', 
                gender ='$Gender', address='$Address', phone='$telephone', 
                email='$email', day='$CusDate', month='$CusMonth', year='$CusYear' where username ='$account'";
        $result = mysqli_query($Connect, $query) or die(mysqli_error($Connect));
        echo '<meta http-equiv="refresh" content="0;URL =?page=profile"';
    }
}
?>