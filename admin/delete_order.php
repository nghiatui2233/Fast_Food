<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderid = $_POST["orderid"];

    include_once("connectDBadmin.php");

    // Xoá sản phẩm từ database
    $sql = "DELETE FROM orders WHERE order_id = '$orderid'";
    $result = mysqli_query($Connect, $sql);

    // Đóng kết nối đến database
    mysqli_close($Connect);

    // Trả về kết quả cho client
    if ($result) {
      echo "Deleted successfully";
    } else {
      echo "Error deleting ";
    }
  }
?>
