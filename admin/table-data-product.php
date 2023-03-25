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

                                <a class="btn btn-add btn-sm" href="?page=addproduct" title="Add"><i class="fas fa-plus"></i>Create New Product</a>
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
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th width="10"><input type="checkbox" id="all"></th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th width="400">Description</th>
                                    <th class="text-center">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM product p, category c WHERE p.category_id = c.category_id ORDER BY product_id DESC";

                                $result = mysqli_query($Connect, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td width='10'><input type='checkbox' name='check1' value='1'></td>
                                        <td>#<?php echo $row["product_id"] ?></td>
                                        <td><?php echo $row["name"] ?></td>
                                        <td>
                                            <?php if ($row['status'] == 1) { ?>
                                                <span class='badge bg-success'>Stocking</span>
                                            <?php } else { ?>
                                                <span class='badge bg-danger'>Out of stock</span>
                                            <?php } ?>
                                        </td>

                                        <td><?php echo $row["category_name"] ?></td>
                                        <td>$ <?php echo $row["price"] ?></td>
                                        <td><img src='img/<?php echo $row["image"] ?>' alt='' width='100px;' height='60px'>
                                        </td>
                                        <td><?php echo $row["description"] ?></td>
                                        <td class="text-center">
                                            <button class='btn btn-primary btn-sm trash' onclick='deleteProduct( "<?php echo urlencode($row["product_id"]); ?>" )' type='button' title='Delete'><i class='fas fa-trash-alt'></i></button>
                                            <button class='btn btn-primary editbtn btn-sm edit' type='button' title='Edit' onclick="window.location='?page=editpro&&id=<?php echo $row['product_id'] ?>'"><i class='fas fa-edit'></i></button>
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
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script src="js/time.js"></script>
    <script>
        $('#sampleTable').DataTable();

        function deleteProduct(id) {
            swal({
                    title: "Warning",
                    text: "Are you sure you want to delete this product?",
                    buttons: ["Cancel", "OK"],
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Gửi yêu cầu xoá sản phẩm đến server
                        jQuery.ajax({
                            url: "delete_product.php",
                            method: "POST",
                            data: {
                                productid: encodeURIComponent(id)
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