<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryid = $_POST["categoryid"];

    include_once("connectDBadmin.php");

    // Xoá sản phẩm từ database
    $sql = "DELETE FROM category WHERE category_id = '$categoryid'";
    $result = mysqli_query($Connect, $sql);

    // Đóng kết nối đến database
    mysqli_close($Connect);

    // Trả về kết quả cho client
    if ($result) {
      echo "Product deleted successfully";
    } else {
      echo "Error deleting product";
    }
  }
?>
