<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <link rel="stylesheet" href="../css/custome.css">
    <link rel="stylesheet" href="../css/styles1.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/icons/all.css">
    <!-- Link to jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Link to SweetAlert library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/login.js"></script>
</head>
<?php
include_once("../connectDB.php");
if (isset($_SESSION['us'])) {
    $account = $_SESSION['us'];
    $query = mysqli_query($Connect, "SELECT * from customer where username='$account' ");
    $row = mysqli_fetch_array($query);
    $Cusname = $row['CustomerName'];
    $Gender = $row['Gender'];
    $Address = $row['Address'];
    $telephone = $row['Phone'];
    $email = $row['Email'];
    $CusDate = $row['Day'];
    $CusMonth = $row['Month'];
    $CusYear = $row['Year'];
?>
    <div class="container">
        <div class="login-box">
            <form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
                <div class="user-box">
                    <input type="text" name="txtCustName" id="txtCustName" value="<?php echo $Cusname; ?>" />
                    <label for="lblFullName" style="color:aliceblue">Full name(*): </label>
                </div>
                <div class="user-box">
                    <input type="text" name="txtEmail" id="txtEmail" value="<?php echo $email; ?>" />
                    <label for="lblEmail" style="color:aliceblue">Email(*): </label>
                </div>

                <div class="user-box">
                    <input type="text" name="txtAddress" id="txtAddress" value="<?php echo $Address; ?>" />
                    <label for="lblDiaChi" style="color:aliceblue">Address(*): </label>
                </div>

                <div class="user-box">
                    <input type="text" name="txttelephone" id="txttelephone" value="<?php echo $telephone; ?>" />
                    <label for="lbltelephone" style="color:aliceblue">Telephone(*): </label>
                </div>


                <div class="form-check">
                    <label for="lblGioiTinh" style="color:aliceblue">Gender(*): </label><br>
                    <input class="form-check-input" type="radio" name="txtgender" id="grpRender" checked>
                    <label class="form-check-label" for="flexRadioDefault1" style="color:aliceblue">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="txtgender" id="grpRender">
                    <label class="form-check-label" for="flexRadioDefault2" style="color:aliceblue">
                        Female
                    </label>
                </div>
                <div class="use-box">
                    <label for="lblNgaySinh" style="color:aliceblue">Date of Birth(*): </label><br>

                    <span>
                        <select name="slDate" id="slDate" readonly>
                            <option value="<?php echo $CusDate; ?> "><?php echo $CusDate; ?></option>
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                echo "<option value='" . $i . "'>" . $i . "</option>";
                            }
                            ?>
                        </select>
                    </span>
                    <span>
                        <select name="slMonth" id="slMonth" readonly>
                            <option value="<?php echo $CusMonth; ?>"><?php echo $CusMonth; ?></option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                echo "<option value='" . $i . "'>" . $i . "</option>";
                            }

                            ?>
                        </select>
                    </span>
                    <span>
                        <select name="slYear" id="slYear" readonly>
                            <option value="<?php echo $CusYear; ?>"><?php echo $CusYear; ?></option>
                            <?php
                            for ($i = 1970; $i <= 2020; $i++) {
                                echo "<option value='" . $i . "'>" . $i . "</option>";
                            }
                            ?>
                        </select>
                    </span>
                </div>
                <div class=" user-box">
                    <button type="submit" class="button" name="btnUpdate" id="btnUpdate">Update</button>
                </div>
            </form>
        </div>
    </div>
    <?php include '../footer.php'; ?>
<?php
    if (isset($_POST['btnUpdate'])) {
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
        echo "<script>
        $(document).ready(function() { 
        swal({
          title: 'Success!',
          text: 'Update profile success!',
          icon: 'success',
          button: 'OK',
        }).then(function() {
          window.location.href = '?page=pf';
        });
        });
        </script>";
    }
}
?>