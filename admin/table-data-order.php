<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách đơn hàng | Quản trị Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- or -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>

<body onload="time()" class="app sidebar-mini rtl">
  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item active"><a href="#"><b>List Of Order</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th width="10"><input type="checkbox" id="all"></th>
                  <th>Order ID</th>
                  <th>Customer</th>
                  <th>Account</th>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>Total Payment</th>
                  <th>Status</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include_once("connectDBadmin.php");
                $sql = "SELECT o.*, p.name, c.CustomerName, od.* 
                FROM order_details od
                JOIN product p ON od.product_id = p.product_id
                JOIN customer c ON od.username = c.username
                JOIN orders o ON o.order_id = od.order_id
                ORDER BY o.date_buy DESC";
                $result = mysqli_query($Connect, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td width="10"><input type="checkbox" name="check1" value="1"></td>
                    <td><?php echo $row["order_id"]; ?></td>
                    <td><?php echo $row["CustomerName"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["quantity"]; ?></td>
                    <td>$<?php echo $row["total_price"]; ?></td>
                    <td> <?php if ($row['status'] == 0) { ?>
                        <span class='badge bg-info confirm-order' data-orderid='<?php echo $row["order_id"]; ?>'>Waiting for progressing</span>
                      <?php } elseif ($row['status'] == 1) { ?>
                        <span class='badge bg-warning'>Being transported</span>
                      <?php } elseif ($row['status'] == 2) { ?>
                        <span class='badge bg-success'>Accomplished</span>
                      <?php } else { ?>
                        <span class='badge bg-danger'>Cancelled</span>
                      <?php } ?>
                    </td>
                    <td>
                      <button class='btn btn-primary btn-sm trash' onclick='deleteOrder( "<?php echo urlencode($row["order_id"]); ?>" )' type='button' title='Delete'><i class='fas fa-trash-alt'></i></button>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
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
  <script src="js/time.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#sampleTable').DataTable();

    function deleteOrder(id) {
      swal({
          title: "Warning",
          text: "Are you sure you want to delete this product?",
          buttons: ["Cancel", "OK"],
        })
        .then((willDelete) => {
          if (willDelete) {
            // Gửi yêu cầu xoá sản phẩm đến server
            jQuery.ajax({
              url: "delete_order.php",
              method: "POST",
              data: {
                orderid: encodeURIComponent(id)
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
                swal("Deleted successfully!", {

                  })
                  .then(() => {
                    location.reload();
                  });
              },
              error: function(xhr, status, error) {
                console.log(xhr.responseText);

              }
            });
          }
        });
    }
  </script>
  <script>
    $(document).ready(function() {
      $('.confirm-order').on('click', function() {
        var orderId = $(this).data('orderid');
        swal({
          title: "Confirmation",
          text: "Are you sure to confirm this order?",
          icon: "warning",
          buttons: ["Cancel", "Confirm"],
          dangerMode: true,
        }).then((willConfirm) => {
          if (willConfirm) {
            $.ajax({
              url: 'confirm_order.php',
              method: 'POST',
              data: {
                order_id: orderId
              },
              success: function(data) {
                swal({
                  title: "Success!",
                  text: data,
                  icon: "success",
                }).then(() => {
                  location.reload();
                });
              },
              error: function(xhr, status, error) {
                console.log(xhr.responseText);
              }
            });
          }
        });
      });
    });
  </script>


</body>

</html>