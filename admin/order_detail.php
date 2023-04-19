<main class="app-content">
  <div class="row">
    <div class="col-md-12">
      <div class="app-title">
        <div id="clock"></div>
      </div>
    </div>
  </div>
  <?php
  include_once("connectDBadmin.php");
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT o.*, p.name, c.CustomerName, od.* 
    FROM order_details od
    JOIN product p ON od.product_id = p.product_id
    JOIN customer c ON od.username = c.username
    JOIN orders o ON o.order_id = od.order_id
    where od.order_id = '$id'";
  ?>
  <div class="row">
    <!-- col-12 -->
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Order details of order code: <?php echo $id; ?></h3>
        <div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Payment</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $result = mysqli_query($Connect, $sql);
                while ($row = mysqli_fetch_array($result)) {
              ?>
                  <tr>
                    <td><?php echo $row["CustomerName"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["quantity"]; ?></td>
                    <td>$<?php echo $row["total_price"]; ?></td>
                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- / div trống-->
      </div>
    </div>
  </div>
  <!--END left-->