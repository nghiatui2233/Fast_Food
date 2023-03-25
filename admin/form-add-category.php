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
            <li class="breadcrumb-item"><a href="#">Add Category</a></li>
          </ul>
          <div id="clock"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Create a new category</h3>
          <div class="tile-body">
            <?php
            include_once("connectDBadmin.php"); // Kết nối đến cơ sở dữ liệu

            if (isset($_POST["btnSave"])) { // Kiểm tra xem form đã được submit hay chưa
              $id = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2) . rand(1000, 9999);
              $name = $_POST["name"];
              $icon = $_POST["icon"];
              $err = "";

              $sq = "SELECT * from category where category_id='$id'"; // Kiểm tra xem sản phẩm đã tồn tại trong cơ sở dữ liệu chưa
              $result = mysqli_query($Connect, $sq);

              if (mysqli_num_rows($result) > 0) { // Nếu sản phẩm đã tồn tại, thông báo lỗi
                $err = "Duplicate Category ID or Name <br>";
                echo "<script>$(document).ready(function() { 
      swal('Error!', '', 'error'); 
    });</script>";
              }
              if (trim($name) == "") {
                $err .= "Enter Category name, please <br>";
                echo "<script>$(document).ready(function() { 
                      swal('Error!', '', 'error'); 
                    });</script>";
              }
              if (trim($id) == "") {
                $err .= "Enter Category ID, please <br>";
                echo "<script>$(document).ready(function() { 
                      swal('Error!', '', 'error'); 
                    });</script>";
              }
              if ($err != "") {
                echo "<ul>$err</ul>";
              } else {
                $sqlstring = "INSERT INTO category(category_id, category_name,icon)
                                      VALUES('$id','$name','$icon')";
                if (mysqli_query($Connect, $sqlstring)) { // Thực hiện truy vấn SQL để thêm sản phẩm mới vào cơ sở dữ liệu
                  echo "<script>
                  $(document).ready(function() { 
                    swal({
                      title: 'Success!',
                      text: 'Add successfully!',
                      icon: 'success',
                      button: 'OK',
                    }).then(function() {
                      window.location.href = '?page=tdcat';
                    });
                  });
                </script>";
                }
              }
            }
            ?>

            <form id="frmcategory" name="frmcategory" method="post" enctype="multipart/form-data" action="" class="row" role="form">
              <div class="form-group col-md-3">
                <label for="category-name" class="control-label">Category Name</label>
                <input class="form-control" id="category-name" name="name" type="text">
              </div>
              <div class="form-group col-md-3">
                <label for="category-name" class="control-label">Icon</label>
                <input class="form-control" id="category-name" name="icon" type="text"><br>
                <button class="btn btn-save" type="button" onclick="window.open('https://fontawesome.com/icons', '_blank')">List of icons</button>
              </div>
          </div>
          <button class="btn btn-save" type="submit" name="btnSave">Add</button>
          <a class="btn btn-cancel" href="?page=tdcat">Cancel</a>
          </form>
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