<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productid = $_POST["productid"];

    include_once("connectDBadmin.php");

    // Xoá sản phẩm từ database
    $sql = "DELETE FROM product WHERE product_id = '$productid'";
    $result = mysqli_query($Connect, $sql);

    // Đóng kết nối đến database
    mysqli_close($Connect);

    // Trả về kết quả cho client
    if ($result) {
      echo "Product deleted successfully";
      echo '<meta http-equiv="refresh" content="2;"';
    } else {
      echo "Error deleting product";
    }
  }
?>
