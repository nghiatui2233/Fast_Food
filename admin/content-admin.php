<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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
        <div class="col-md-6">
          <div class="widget-small primary coloured-icon"><i class='icon bx bxs-user-account fa-3x'></i>
            <div class="info">
              <h4>Tổng khách hàng</h4>
              <p><b>56 khách hàng</b></p>
              <p class="info-tong">Tổng số khách hàng được quản lý.</p>
            </div>
          </div>
        </div>
        <!-- col-6 -->
        <div class="col-md-6">
          <div class="widget-small warning coloured-icon"><i class='icon bx bxs-shopping-bags fa-3x'></i>
            <div class="info">
              <h4>Tổng đơn hàng</h4>
              <p><b>247 đơn hàng</b></p>
              <p class="info-tong">Tổng số hóa đơn bán hàng trong tháng.</p>
            </div>
          </div>
        </div>
        <!-- col-12 -->
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Tình trạng đơn hàng</h3>
            <div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>AL3947</td>
                    <td>Phạm Thị Ngọc</td>
                    <td>
                      19.770.000 đ
                    </td>
                    <td><span class="badge bg-info">Chờ xử lý</span></td>
                  </tr>
                  <tr>
                    <td>ER3835</td>
                    <td>Nguyễn Thị Mỹ Yến</td>
                    <td>
                      16.770.000 đ
                    </td>
                    <td><span class="badge bg-warning">Đang vận chuyển</span></td>
                  </tr>
                  <tr>
                    <td>MD0837</td>
                    <td>Triệu Thanh Phú</td>
                    <td>
                      9.400.000 đ
                    </td>
                    <td><span class="badge bg-success">Đã hoàn thành</span></td>
                  </tr>
                  <tr>
                    <td>MT9835</td>
                    <td>Đặng Hoàng Phúc </td>
                    <td>
                      40.650.000 đ
                    </td>
                    <td><span class="badge bg-danger">Đã hủy </span></td>
                  </tr>
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
    include_once("connectDBadmin.php");

    // kiểm tra xem người dùng đã gửi biểu mẫu bộ lọc hay chưa
    if (isset($_POST['submit'])) {
      $date_from = $_POST['date_from'];
      $date_to = $_POST['date_to'];
      // truy vấn đơn hàng trong khoảng thời gian đã chọn
      $query = "SELECT od.*, o.status FROM order_details od, orders o WHERE od.date_buy BETWEEN '$date_from' AND '$date_to' AND od.order_id= o.order_id AND o.status != 3";
    } else {
      // truy vấn tất cả các đơn hàng
      $query = "SELECT od.*, o.status FROM order_details od, orders o Where o.status != 3 AND od.order_id= o.order_id";
    }

    $result = mysqli_query($Connect, $query);

    $chart_data = '';
    while ($row = mysqli_fetch_array($result)) {
      $chart_data .= "{ date_buy:'" . $row["date_buy"] . "', total_price:" . $row["total_price"] . ", quantity:" . $row["quantity"] . "}, ";
    }
    $chart_data = substr($chart_data, 0, -2);
    ?>
    <!--Right-->
    <div class="col-md-12 col-lg-6">
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Khách hàng mới</h3>
            <div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày sinh</th>
                    <th>Số điện thoại</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>#183</td>
                    <td>Hột vịt muối</td>
                    <td>21/7/1992</td>
                    <td><span class="tag tag-success">0921387221</span></td>
                  </tr>
                  <tr>
                    <td>#219</td>
                    <td>Bánh tráng trộn</td>
                    <td>30/4/1975</td>
                    <td><span class="tag tag-warning">0912376352</span></td>
                  </tr>
                  <tr>
                    <td>#627</td>
                    <td>Cút rang bơ</td>
                    <td>12/3/1999</td>
                    <td><span class="tag tag-primary">01287326654</span></td>
                  </tr>
                  <tr>
                    <td>#175</td>
                    <td>Hủ tiếu nam vang</td>
                    <td>4/12/20000</td>
                    <td><span class="tag tag-danger">0912376763</span></td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!--END right-->
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