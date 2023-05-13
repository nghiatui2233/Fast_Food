<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<?php include_once("connectDBadmin.php"); ?>
<main class="app-content">
  <div class="row">
    <div class="col-md-12">
      <div class="app-title">
        <div id="clock"></div>
      </div>
    </div>
  </div>
  <div class="row">
    <!--Left-->
    <div class="col-md-12 col-lg-6">
      <div class="row">
        <!-- col-6 -->
        <?php
        $sql = "SELECT COUNT(*) AS total_customers FROM customer";
        $res = mysqli_query($Connect, $sql);
        $row = mysqli_fetch_assoc($res);
        $total_customers = $row['total_customers'];
        ?>

        <div class="col-md-6">
          <div class="widget-small primary coloured-icon"><i class='icon bx bxs-user-account fa-3x'></i>
            <div class="info">
              <h4>Total customers</h4>
              <p><b><?php echo $total_customers ?> customers</b></p>
              <p class="info-tong">Total number of clients managed.</p>
            </div>
          </div>
        </div>
        <!-- col-6 -->
        <?php
        $order = "SELECT COUNT(*) AS total_order FROM orders";
        $total = mysqli_query($Connect, $order);
        $row = mysqli_fetch_assoc($total);
        $total_order = $row['total_order'];
        ?>
        <div class="col-md-6">
          <div class="widget-small warning coloured-icon"><i class='icon bx bxs-shopping-bags fa-3x'></i>
            <div class="info">
              <h4>Total Orders</h4>
              <p><b><?php echo $total_order ?> Orders</b></p>
              <p class="info-tong">Total sales invoices for the month.</p>
            </div>
          </div>
        </div>
        <!-- col-12 -->
        <?php
        $status = "SELECT o.*, c.CustomerName
        FROM orders o
        JOIN customer c ON o.username = c.username
        ORDER BY o.date_buy DESC
        LIMIT 5
        ";
        $order = mysqli_query($Connect, $status);
        ?>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Order status</h3>
            <div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Total</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row = mysqli_fetch_assoc($order)) {
                  ?>
                    <tr>
                      <td><?php echo $row['order_id']; ?></td>
                      <td><?php echo $row['CustomerName']; ?></td>
                      <td>
                        <?php echo $row['total_price']; ?>
                      </td>
                      <td> <?php if ($row['status'] == 0) { ?>
                          <span class='badge bg-info'>Waiting for progressing</span>
                        <?php } elseif ($row['status'] == 1) { ?>
                          <span class='badge bg-warning'>Being transported</span>
                        <?php } elseif ($row['status'] == 2) { ?>
                          <span class='badge bg-success'>Accomplished</span>
                        <?php } else { ?>
                          <span class='badge bg-danger'>Cancelled</span>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- / div trống-->
          </div>
        </div>
      </div>
    </div>
    <!--END left-->
    <?php

    if (isset($_POST['loc'])) {
      $date_from = $_POST['from'];
      $date_to = $_POST['to'];
      $total = "SELECT ROUND(SUM(total_price), 3) as price, date_buy, status
      FROM orders Where status != 3 AND date_buy BETWEEN '$date_from' AND '$date_to'";
    } else {
      $total = "SELECT ROUND(SUM(total_price), 3) as price
      FROM orders Where status != 3 ";
    }

    $result1 = mysqli_query($Connect, $total);
    $row1 = mysqli_fetch_array($result1);
    $sum = $row1['price'];
    if (is_null($sum)) {
      $sum = 0;
    }
    ?>
    <!--Right-->

    <div class="col-lg-6">
      <div class="row">
        <div class="col-md-12">
          <div class="widget-small primary coloured-icon"><i class='icon bx bxs-user-account fa-3x'></i>
            <div class="info">
              <h4>Total Price</h4>
              <form method="POST">
                From: <input type="date" name="from">
                To: <input type="date" name="to">
                <input type="submit" name="loc" value="Filter">
              </form>
              <p><b>$ <?php echo $sum ?></b></p>
              <p class="info-tong">Total revenue managed.</p>
            </div>
          </div>
        </div>
        <?php
        $cus = "SELECT * FROM customer
        ORDER BY date_created DESC
        LIMIT 5
        ";
        $customer = mysqli_query($Connect, $cus);
        ?>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">New Customer</h3>
            <div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Customer Name </th>
                    <th>Birthday</th>
                    <th>Number Phone</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row = mysqli_fetch_assoc($customer)) {
                  ?>
                    <tr>
                      <td><?php echo $row['CustomerName']; ?></td>
                      <td><?php echo $row["Day"]; ?>/<?php echo $row["Month"]; ?>/<?php echo $row["Year"]; ?></td>
                      <td><span class="tag tag-success"><?php echo $row["Phone"] ?></span></td>
                    </tr>
                    <tr>
                    <?php
                  }
                    ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!--END right-->
    <?php
    if (isset($_POST['submit'])) {
      $date_from = $_POST['date_from'];
      $date_to = $_POST['date_to'];
      $query = "SELECT SUM(od.quantity) as quantity,od.date_buy, o.status 
          FROM order_details od, orders o 
          WHERE od.date_buy BETWEEN '$date_from' AND '$date_to' 
          AND od.order_id= o.order_id 
          AND o.status != 3 
          GROUP BY o.order_id";
    } else {
      $query = "SELECT SUM(od.quantity) as quantity, od.date_buy, o.status, o.total_price 
          FROM order_details od, orders o 
          Where o.status != 3 
          AND od.order_id= o.order_id 
          GROUP BY o.order_id";
    }

    $result = mysqli_query($Connect, $query);
    $chart_data = '';
    while ($row = mysqli_fetch_array($result)) {
      $chart_data .= "{ date_buy:'" . $row["date_buy"] . "', total_price:" . $row["total_price"] . ", quantity:" . $row["quantity"] . "}, ";
    }
    $chart_data = substr($chart_data, 0, -2);
    ?>
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Order Statistics Chart</h3>
        <form method="POST">
          From: <input type="date" name="date_from">
          To: <input type="date" name="date_to">
          <input type="submit" name="submit" value="Filter">
        </form>
        <div id="chart"></div>
      </div>
    </div>
  </div>
</main>

<script>
  Morris.Area({
    element: 'chart',
    data: [<?php echo $chart_data; ?>],
    xkey: 'date_buy',
    ykeys: ['total_price', 'quantity', ],
    labels: ['total_price', 'quantity', ],
    hideHover: 'auto',
    stacked: true
  });
</script>
