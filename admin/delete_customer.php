<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];

    include_once("connectDBadmin.php");

    // Xoá sản phẩm từ database
    $sql = "DELETE FROM customer WHERE username = '$username'";
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
