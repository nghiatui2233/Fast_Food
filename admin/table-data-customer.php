<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách nhân viên | Quản trị Admin</title>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
  <!-- or -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />

  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css" />
</head>

<body onload="time()" class="app sidebar-mini rtl">
  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item active"><a href="#"><b>List Of Products</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">
              </div>
              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm upload-file" type="button" title="Post"><i class="fas fa-file-upload"></i> Upload file</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-excel btn-sm" href="" title="Export"><i class="fas fa-file-excel"></i>
                  Export Excel</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm pdf-file" type="button" title="Export"><i class="fas fa-file-pdf"></i> Export PDF</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm" type="button" title="Deleted"><i class="fas fa-trash-alt"></i> Deleted All </a>
              </div>
            </div>
            <table class="table table-hover table-bordered js-copytextarea" id="sampleTable">
              <thead>
                <tr>
                  <th width="10"><input type="checkbox" id="all" /></th>
                  <th width="150">Full Name</th>
                  <th>Account</th>
                  <th>Email</th>
                  <th width="300">Address</th>
                  <th width="120">Date of birth</th>
                  <th>Gender</th>
                  <th>Phone</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <?php
              $sql = "SELECT *FROM customer";

              $result = mysqli_query($Connect, $sql);
              while ($row = mysqli_fetch_array($result)) {
              ?>
                <tbody>
                  <tr>
                    <td width="10">
                      <input type="checkbox" name="check1" value="1" />
                    </td>
                    <td><?php echo $row["CustomerName"] ?></td>
                    <td><?php echo $row["UserName"] ?></td>
                    <td><?php echo $row["Email"] ?></td>
                    <td><?php echo $row["Address"] ?></td>
                    <td><?php echo $row["Day"]; ?>/<?php echo $row["Month"]; ?>/<?php echo $row["Year"]; ?></td>
                    <td><?php echo $row["Gender"] ?></td>
                    <td><?php echo $row["Phone"] ?></td>
                    <td class="table-td-center">
                    <button class='btn btn-primary btn-sm trash' onclick='deleteCustomer( "<?php echo urlencode($row["UserName"]); ?>" )' type='button' title='Delete'><i class='fas fa-trash-alt'></i></button>
                    </td>
                  </tr>
                </tbody>
              <?php
              }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="src/jquery.table2excel.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script src="js/time.js"></script>
  <script>
    $("#sampleTable").DataTable();

    function deleteCustomer(id) {
      swal({
        title: "Warning",
        text: "Are you sure you want to delete this customer?",
        buttons: ["Cancel", "OK"],
      }).then((willDelete) => {
        if (willDelete) {
          // Gửi yêu cầu xoá sản phẩm đến server
          jQuery.ajax({
            url: "delete_customer.php",
            method: "POST",
            data: {
              username: encodeURIComponent(id),
            },
            success: function(result) {
              // Xoá dòng tương ứng trong bảng
              var table = document.getElementById("sampleTable");
              var rows = table.getElementsByTagName("tr");
              for (var i = 0; i < rows.length; i++) {
                var cell = rows[i].getElementsByTagName("td")[0];
                if (cell && cell.innerText == id.toString()) {
                  table.deleteRow(i);
                  break;
                }
              }
              swal("Deleted successfully!", {}).then(() => {
                location.reload();
              });
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
            },
          });
        }
      });
    }
  </script>
</body>

</html>