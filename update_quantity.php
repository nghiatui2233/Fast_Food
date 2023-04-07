<?php
include_once("connectDB.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

   $sql="UPDATE cart SET quantity = $quantity WHERE cart_id = $id" ;
   $result = mysqli_query($Connect, $query) or die(mysqli_error($Connect));


    echo 'Quantity updated successfully';
} else {
    http_response_code(404);
}
