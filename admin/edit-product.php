<head>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
</head>

<body onload="time()" class="app sidebar-mini rtl">
    <main class="app-content">
        <div class="row">
            <div class="col-md-12">
                <div class="app-title">
                    <ul class="app-breadcrumb breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Update Product</a></li>
                    </ul>
                    <div id="clock"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Update product</h3>
                    <div class="tile-body">
                        <?php
                        include_once("connectDBadmin.php"); // Kết nối đến cơ sở dữ liệu
                        function bind_Category_List($Connect, $selectedValue)
                        {
                            $sqlstring = "SELECT * from category";
                            $result = mysqli_query($Connect, $sqlstring);
                            while ($row = mysqli_fetch_array($result)) {
                                if ($row['category_id'] == $selectedValue) {
                                    echo "<option value ='" . $row['category_id'] . "' selected>" . $row['category_name'] . "</option>";
                                } else {
                                    echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                                }
                            }
                        }
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $sqlString = "SELECT * from product where product_id='$id'";

                            $result = mysqli_query($Connect, $sqlString);
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        ?>

                            <form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="row" role="form">
                                <div class="form-group col-md-3">
                                    <label for="product-id" class="control-label">Product ID </label>
                                    <input class="form-control" id="product-id" name="product_id" readonly value='<?php echo $id ?>'>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="product-name" class="control-label">Product Name</label>
                                    <input class="form-control" id="product-name" name="name" type="text" value='<?php echo $row["name"] ?>'>
                                </div>
                                <div class="form-group col-md-3 ">
                                    <label for="product-status" class="control-label">Status</label>
                                    <select class="form-control" name='status' id="product-status">
                                        <?php
                                        if ($row['status'] == 1) {
                                        ?>
                                            <option value="1" selected>Stocking</option>
                                            <option value="0">Out of stock</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="1">Stocking</option>
                                            <option value="0" selected>Out of stock</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="product-category" class="control-label">Category</label>
                                    <select class='form-control' name='category' id=''>
                                        <?php
                                        bind_Category_List($Connect, $row['category_id'])
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="product-price" class="control-label">Price</label>
                                    <input class="form-control" id="product-price" name="price" value='<?php echo $row["price"] ?>'>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Image Product</label>
                                    <div id="myfileupload">
                                        <input type="file" id="" name="image" onchange="readURL(this);" />
                                    </div>
                                    <div id="thumbbox">
                                        <img src='img/<?php echo $row["image"] ?>' height="450" width="400" alt="Thumb image" id="thumbimage" />
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="product-description" class="control-label">Product Description</label>
                                    <textarea class="form-control" name="description" id="product-description"><?php echo $row["description"] ?></textarea>
                                    <script>
                                        CKEDITOR.replace('Description');
                                    </script>
                                </div>
                    </div>
                    <button type="submit" class="btn btn-save" name="btnUpdate" onclick="window.location.href ='?page=edit&&id=<?php echo $row['product_id'] ?>'">Update</button>
                    <a class="btn btn-cancel" href="?page=tdproduct">Cancel</a>
                </div>
    </main>
<?php
                            if (isset($_POST['btnUpdate'])) {
                                $id  = $_POST['product_id'];
                                $name = $_POST['name'];
                                $price = $_POST['price'];
                                $status = $_POST['status'];
                                $category = $_POST['category'];
                                $description = $_POST['description'];
                                $err = "";
                                if (trim($name) == "") {
                                    $err .= "Enter product name, please <br>";
                                    echo "<script>$(document).ready(function() { 
                                            swal('Error!', 'Enter product name, please', 'error'); 
                                            });</script>";
                                }
                                if (trim($price) <= 0) {
                                    $err .= "Enter product name, please <br>";
                                    echo "<script>$(document).ready(function() { 
                                            swal('Error!', 'Price cannot be negative and cannot be 0', 'error'); 
                                            });</script>";
                                } 
                                if (!is_numeric($price)) {
                                    $err .= "Product price must be number <br>";
                                    echo "<script>$(document).ready(function() { 
                                            swal('Error!', 'Product price must be number', 'error'); 
                                            });</script>";
                                }
                                if ($err != "") {
                                    echo "<ul>$err</ul>";
                                } else {
                                    if (isset($_FILES['image'])) { // Kiểm tra xem có tệp hình ảnh được tải lên hay không
                                        $file = $_FILES['image'];
                                        $file_name = $file['name'];
                                        if ($file_name != "") {
                                            if ($file['type'] == 'image/jpeg' || $file['type'] == 'imgae/jpg' || $file['type'] == 'image/png') { // Kiểm tra định dạng tệp hình ảnh
                                                move_uploaded_file($file['tmp_name'], 'img/' . $file_name); // Lưu trữ tệp hình ảnh trong thư mục "img/"
                                                $sqlstring = "UPDATE product SET 
                                            name='$name',
                                            status = '$status',
                                            price='$price',
                                            image='$file_name',
                                            description = '$description',
                                            category_id = '$category'
                                            where product_id ='$id'";
                                                if (mysqli_query($Connect, $sqlstring)) { // Thực hiện truy vấn SQL để thêm sản phẩm mới vào cơ sở dữ liệu
                                                    echo "<script>
                                                        $(document).ready(function() { 
                                                        swal({
                                                            title: 'Success!',
                                                            text: 'Update successfully!',
                                                            icon: 'success',
                                                            button: 'OK',
                                                        }).then(function() {
                                                            window.location.href = '?page=tdproduct';
                                                        });
                                                        });
                                                    </script>";
                                                }
                                            } else {
                                                echo "<script>$(document).ready(function() { 
                                                    swal('Error!', 'You have left the picture blank or the picture you added does not match the format', 'error'); 
                                                    });</script>";
                                            }
                                        } else {
                                            $sqlstring = "UPDATE product SET 
                                            name='$name',
                                            status = '$status',
                                            price='$price', 
                                            description = '$description',
                                            category_id = '$category'
                                            where product_id ='$id'";
                                            if (mysqli_query($Connect, $sqlstring)) { // Thực hiện truy vấn SQL để thêm sản phẩm mới vào cơ sở dữ liệu
                                                echo "<script>
                                                        $(document).ready(function() { 
                                                        swal({
                                                            title: 'Success!',
                                                            text: 'Update successfully!',
                                                            icon: 'success',
                                                            button: 'OK',
                                                        }).then(function() {
                                                            window.location.href = '?page=tdproduct';
                                                        });
                                                        });
                                                    </script>";  
                                            }
                                        }
                                    }
                                }
                            }
                        }
?>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/plugins/pace.min.js"></script>
<script src="js/time.js"></script>
<script>
    const inpFile = document.getElementById("inpFile");
    const loadFile = document.getElementById("loadFile");
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = previewContainer.querySelector(".image-preview__image");
    const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");
    inpFile.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            previewDefaultText.style.display = "none";
            previewImage.style.display = "block";
            reader.addEventListener("load", function() {
                previewImage.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        }
    });
</script>
</body>

</html>
