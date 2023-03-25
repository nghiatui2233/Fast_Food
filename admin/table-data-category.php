<body onload="time()" class="app sidebar-mini rtl">
  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item active"><a href="?page=tdcat"><b>Category Management</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">

            <div class="row element-button">
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="?page=addcat" title="Add"><i class="fas fa-plus"></i>Create New Category</a>
              </div>
              <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0" id="sampleTable">
                <thead>
                  <tr>
                    <th width="10"><input type="checkbox" id="all"></th>
                    <th width="100">Category ID</th>
                    <th width="150">Category Name</th>
                    <th width="150">Icon</th>
                    <th width="10" class="text-center">Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT *FROM category";

                  $result = mysqli_query($Connect, $sql);
                  while ($row = mysqli_fetch_array($result)) {
                  ?>
                    <tr>
                      <td width="10"><input type="checkbox" name="check1" value="1"></td>
                      <td>#<?php echo $row["category_id"] ?></td>
                      <td><?php echo $row["category_name"] ?></td>
                      <td style="text-align: center"><i class="fas <?php echo $row["icon"] ?>" style="font-size:48px;margin-bottom:6px;"></i></td>
                      <td class="text-center">
                      <button class='btn btn-primary btn-sm trash' onclick='deleteCategory( "<?php echo urlencode($row["category_id"]); ?>" )' type='button' title='Delete'><i class='fas fa-trash-alt'></i></button>
                        <button class="btn btn-primary btn-sm edit" type="button" onclick="window.location='?page=editcat&&id=<?php echo $row['category_id'] ?>'"><i class="fas fa-edit"></i>
                        </button>
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

  <!--
  MODAL
-->

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
  </script>
  <script>
    function deleteCategory(id) {
      swal({
          title: "Warning",
          text: "Are you sure you want to delete this category?",
          buttons: ["Cancel", "OK"],
        })
        .then((willDelete) => {
          if (willDelete) {
            // Gửi yêu cầu xoá sản phẩm đến server
            jQuery.ajax({
              url: "delete_category.php",
              method: "POST",
              data: {
                categoryid: encodeURIComponent(id)
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
</body>

</html>