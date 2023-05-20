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
            <li class="breadcrumb-item">List Of Products</li>
            <li class="breadcrumb-item"><a href="#">Add Product</a></li>
          </ul>
          <div id="clock"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Create a new product</h3>
          <div class="tile-body">
            <?php
            include_once("connectDBadmin.php"); // Kết nối đến cơ sở dữ liệu

            if (isset($_POST["name"])) { // Kiểm tra xem form đã được submit hay chưa
              // Tạo id ngẫu nhiên bao gồm 8 ký tự, trong đó 3 ký tự đầu là chữ, các ký tự sau là số
              $id = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3) . rand(10000, 99999);
              $name = $_POST["name"];
              $status = $_POST['StatusList'];
              $category = $_POST['CategoryList'];
              $price = $_POST['txtPrice'];
              $description = $_POST['txtDescription'];
              $err = "";

              $sq = "SELECT * from product where product_id='$id'or name='$name'"; // Kiểm tra xem sản phẩm đã tồn tại trong cơ sở dữ liệu chưa
              $result = mysqli_query($Connect, $sq);

              if (mysqli_num_rows($result) > 0) { // Nếu sản phẩm đã tồn tại, thông báo lỗi
                $err = "Duplicate product ID or Name <br>";
                echo "<script>$(document).ready(function() { 
      swal('Error!', '', 'error'); 
    });</script>";
              }
              if (trim($name) == "") {
                $err .= "Enter product name, please <br>";
                echo "<script>$(document).ready(function() { 
      swal('Error!', '', 'error'); 
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
      swal('Error!', '', 'error'); 
    });</script>";
              }
              if ($err != "") {
                echo "<ul>$err</ul>";
              } else {
                if (isset($_FILES['image'])) { // Kiểm tra xem có tệp hình ảnh được tải lên hay không
                  $file = $_FILES['image'];
                  $file_name = $file['name'];
                  if ($file['type'] == 'image/jpeg' || $file['type'] == 'imgae/jpg' || $file['type'] == 'image/png') { // Kiểm tra định dạng tệp hình ảnh
                    move_uploaded_file($file['tmp_name'], 'img/' . $file_name); // Lưu trữ tệp hình ảnh trong thư mục "img/"
                    $sqlstring = "INSERT INTO product(product_id, name, price, description, image, category_id, status)
                                      VALUES('$id','$name', $price,'$description','$file_name','$category','$status')";
                    if (mysqli_query($Connect, $sqlstring)) { // Thực hiện truy vấn SQL để thêm sản phẩm mới vào cơ sở dữ liệu
                      echo "<script>
                      $(document).ready(function() { 
                      swal({
                          title: 'Success!',
                          text: 'Add successfully!',
                          icon: 'success',
                          button: 'OK',
                      }).then(function() {
                          window.location.href = '?page=addproduct';
                      });
                      });
                  </script>";
                    }
                  } else {
                    echo "<script>$(document).ready(function() { 
          swal('Error!', 'You have left the picture blank or the picture you added does not match the format', 'error'); 
        });</script>";
                  }
                }
              }
            }
            ?>

            <form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="row" role="form">
              <div class="form-group col-md-3">
                <label for="product-name" class="control-label">Product Name</label>
                <input class="form-control" id="product-name" name="name" type="text" required>
              </div>
              <div class="form-group col-md-3 ">
                <label for="product-status" class="control-label">Status</label>
                <select class="form-control" name='StatusList' id="product-status">
                  <option>-- Choose Status --</option>
                  <option value="1">Stocking</option>
                  <option value="0">Out of stock</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="product-category" class="control-label">Category</label>
                <select class='form-control' name='CategoryList'>
                  <option>-- Choose Category --</option>
                  <?php
                  $sqlstring = "SELECT * from category";
                  $result = mysqli_query($Connect, $sqlstring);
                  while ($row = mysqli_fetch_array($result)) {
                  ?>
                    <option value="<?php echo $row["category_id"]; ?>">
                      <?php echo $row["category_name"]; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="product-price" class="control-label">Price</label>
                <input class="form-control" id="product-price" name="txtPrice" type="text">
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Image Product</label>
                <div id="myfileupload">
                  <input type="file" id="" name="image" onchange="readURL(this);" />
                </div>
                <div id="thumbbox">
                  <img height="450" width="400" alt="Thumb image" id="thumbimage" style="display: none" />
                </div>
              </div>
              <div class="form-group col-md-12">
                <label for="product-description" class="control-label">Product Description</label>
                <textarea class="form-control" name="txtDescription" id="product-description"></textarea>
                <script>
                  CKEDITOR.replace('Description');
                </script>
              </div>
          </div>
          <button class="btn btn-save" id="add-product">Add</button>
          <a class="btn btn-cancel" href="?page=tdproduct">Cancel</a>
        </div>
  </main>
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
