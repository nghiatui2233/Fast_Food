<?php
include_once("connectDBadmin.php");

// kiểm tra xem người dùng đã gửi biểu mẫu bộ lọc hay chưa
if (isset($_POST['submit'])) {
  $date_from = $_POST['date_from'];
  $date_to = $_POST['date_to'];
  // truy vấn đơn hàng trong khoảng thời gian đã chọn
  $query = "SELECT * FROM orders WHERE date_buy BETWEEN '$date_from' AND '$date_to'";
} else {
  // truy vấn tất cả các đơn hàng
  $query = "SELECT * FROM orders";
}

$result = mysqli_query($Connect, $query);

$chart_data = '';
while ($row = mysqli_fetch_array($result)) {
  $chart_data .= "{ date_buy:'" . $row["date_buy"] . "', total_price:" . $row["total_price"] . ", quantity:" . $row["quantity"] . "}, ";
}
$chart_data = substr($chart_data, 0, -2);
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body>
  <br /><br />
  <div class="card-header">
    Order Statistics Chart
    <form method="POST">
      From: <input type="date" name="date_from">
      To: <input type="date" name="date_to">
      <input type="submit" name="submit" value="Filter">
    </form>
    <div id="chart"></div>
  </div>
</body>

</html>

<script>
  Morris.Area({
    element: 'chart',
    data: [<?php echo $chart_data; ?>],
    xkey: 'date_buy',
    ykeys: ['total_price', 'quantity', ],
    labels: ['Total Price', 'Quantity', ],
    hideHover: 'auto',
    stacked: true
  });
</script>