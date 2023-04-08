<?php
include_once("../connectDB.php");

if(isset($_POST['order_id'])) {
  $order_id = $_POST['order_id'];

  // Update the order status to "Confirmed" (status code 2)
  $sql = "UPDATE orders SET status = 2 WHERE order_id = '$order_id'";
  $result = mysqli_query($Connect, $sql);

  if($result) {
    echo "Order #$order_id has been confirmed.";
  } else {
    echo "There was an error confirming the order.";
  }
} else {
  echo "No order ID specified.";
}

