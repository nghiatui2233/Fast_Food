<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="./css/custome.css">
    <script src="js/login.js"></script>
    <style>
        .input {
            display: inline-block;
            color: white;

            width: 100px;
            height: 50px;

            padding: 0 20px;
            background: #17181c;
            border-radius: 5px;

            outline: none;
            border: none;

            cursor: pointer;
            text-align: center;
            transition: all 0.2s linear;

            margin: 7% auto;
            letter-spacing: 0.05em;
        }
    </style>
    <script>
        function updateNotice() {
            if (confirm("You have update successfully")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <?php
        include_once("ConnectDB.php");
    if (isset($_SESSION['us'])) {
        $account = $_SESSION['us'];
        $result = mysqli_query($Connect, "SELECT * from customer where UserName='$account' ");
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
                <h2>Member Update Profile</h2>
                <form id="form1" name="form1" method="post" action="" role="form">
                    <div >
					<input type="text" name="txtUsername" id="txtID" required="" value="<?php echo $account; ?>" readonly>
					<label style="color:aliceblue">Username</label>
				</div>

                    <div class="user-box">
                        <label for="" style="color:aliceblue">Password(*): </label>
                        <div class="user-box">
                            <input type="password" name="txtPassword" id="txtPassword"  value="" />
                        </div>
                    </div>
                    <div class="user-box">
                        <label for="" style="color:aliceblue">Password Confirm(*): </label>
                        <div class="user-box">
                            <input type="password" name="txtPasswordC" id="txtPasswordC"  value="" />
                        </div>
                    </div>
                    <div class="user-box">
                        <label for="lblFullName" style="color:aliceblue">Full name(*): </label>
                        <div class="user-box">
                            <input type="text" name="txtCustName" id="txtCustName"  value="<?php echo $Cusname; ?>" />
                        </div>
                    </div>

                    <div class="user-box">
                        <label for="lblEmail" style="color:aliceblue">Email(*): </label>
                        <div class="user-box">
                            <input type="text" name="txtEmail" id="txtEmail"  value="<?php echo $email; ?>" readonly />
                        </div>
                    </div>

                    <div class="user-box">
                        <label for="lblDiaChi" style="color:aliceblue">Address(*): </label>
                        <div class="user-box">
                            <input type="text" name="txtAddress" id="txtAddress"  value="<?php echo $Address; ?>" />
                        </div>
                    </div>

                    <div class="user-box">
                        <label for="lbltelephone" style="color:aliceblue">Telephone(*): </label>
                        <div class="user-box">
                            <input type="text" name="txttelephone" id="txttelephone"  value="<?php echo $telephone; ?>" />
                        </div>
                    </div>

                    <div class="user-box">
                        <label for="lblGioiTinh" style="color:aliceblue">Gender(*): </label>
                        <div class="user-box">
                            <label class="radio-inline"><input type="radio" name="txtgender" value="0" id="grpRender" checked />
                                Male</label>

                            <label class="radio-inline"><input type="radio" name="txtgender" value="1" id="grpRender" />

                                Female</label>

                        </div>
                    </div>

                    <div class="user-box">
                        <label for="lblNgaySinh" style="color:aliceblue">Date of Birth(*): </label>
                        <div class="user-box input-group">
                            <span class="input-group-btn">
                                <select name="slDate" id="slDate" >
                                    <option value="<?php echo $CusDate; ?> "><?php echo $CusDate; ?></option>
                                    <?php
                                    for ($i = 1; $i <= 31; $i++) {
                                        echo "<option value='" . $i . "'>" . $i . "</option>";
                                    }
                                    ?>
                                </select>
                            </span>
                            <span class="input-group-btn">
                                <select name="slMonth" id="slMonth" >
                                    <option value="<?php echo $CusMonth; ?>"><?php echo $CusMonth; ?></option>
                                    <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                        echo "<option value='" . $i . "'>" . $i . "</option>";
                                    }

                                    ?>
                                </select>
                            </span>
                            <span class="input-group-btn">
                                <select name="slYear" id="slYear" >
                                    <option value="<?php echo $CusYear; ?>"><?php echo $CusYear; ?></option>
                                    <?php
                                    for ($i = 1970; $i <= 2020; $i--) {
                                        echo "<option value='" . $i . "'>" . $i . "</option>";
                                    }
                                    ?>
                                </select>
                            </span>
                        </div>

                    </div>
                    <div class="user-box">
                        <div class="col-sm-offset-2 user-box">
                            <input type="submit" class="site-btn" name="btnUpdate" id="btnUpdate" value="Update" onclick="return updateNotice()" />
                            <input type=" button" class="site-btn" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='?page=index'" />

                        </div>

                    </div>
                </form>
            </div>
        </div>

    <?php
        if (isset($_POST['btnUpdate'])) {

            $Username = $_POST['txtUsername'];
            $Password = $_POST['txtPassword'];
            $Cusname = $_POST['txtCustName'];
            $Gender = $_POST['txtgender'];
            $Address = $_POST['txtAddress'];
            $telephone = $_POST['txttelephone'];
            $email = $_POST['txtEmail'];
            $CusDate = $_POST['slDate'];
            $CusMonth = $_POST['slMonth'];
            $CusYear = $_POST['slYear'];
            $PasswordC = $_POST['txtPasswordC'];

            $err = "";

            if (strlen($Password) <= 5) {
                $err .= "<li>Password must be greater than 5 chars</li>";
            }
            if ($Password != $PasswordC) {
                $err .= "<li>Password and confirm password are the same</li>";
            }
            if ($err != "") {
                $err .= "Enter Your Password</br>";
            }
            if ($Password == "") {
                $Password = md5($Password);
                $sqlString = "UPDATE customer set username ='$Username',  custname ='$Cusname', 
                gender ='$Gender', address='$Address', telephone='$telephone', 
                email='$email', cusdate='$CusDate', cusmonth='$CusMonth', cusyear='$CusYear' where username ='$account'";
                mysqli_query($Connect, $sqlString);
                echo '<meta http-equiv="refresh" content="0;URL =?page=upa"';
            } else {
                $Password = md5($Password);
                $sqlString = "UPDATE customer set username ='$Username', password = '$Password', custname ='$Cusname', gender ='$Gender', address='$Address', telephone='$telephone', 
                email='$email', cusdate='$CusDate', cusmonth='$CusMonth', cusyear='$CusYear' where UserName ='$account'";
                mysqli_query($Connect, $sqlString);

                echo '<meta http-equiv="refresh" content="0;URL =?page=up"';
            }
        }
    }

    ?>