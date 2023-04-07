<?php
include_once("connectDBadmin.php");

if(isset($_POST['id_order'])) {
  $order_id = $_POST['id_order'];

  // Update the order status to "Confirmed" (status code 2)
  $sql = "UPDATE orders SET status = +1 WHERE id_order = '$order_id'";
  $result = mysqli_query($Connect, $sql);

  if($result) {
    echo "Order #$order_id has been confirmed.";
  } else {
    echo "There was an error confirming the order.";
  }
} else {
  echo "No order ID specified.";
}
