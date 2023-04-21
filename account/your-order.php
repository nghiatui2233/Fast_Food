<head>
    <style>
        .form {
            position: relative;
            top: 30%;
            left: 80%;
            width: 750px;
            padding: 40px;
            margin: 13px;
            transform: translate(-50%, -50%);
            background: #2c2f34;
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
            border-radius: 10px;
            overflow-y: scroll;
        }
    </style>
    <!-- Link to jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Link to SweetAlert library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<?php
$username = $_SESSION["us"];
$sql = "SELECT DISTINCT DATE(od.date_buy) AS order_date, od.order_id, o.total_price, o.status  
FROM order_details od
JOIN orders o ON od.order_id = o.order_id
WHERE od.username = '$username'";
$result = mysqli_query($Connect, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $order_date = $row['order_date'];
        $order_id = $row['order_id'];
        $status = $row['status'];
?>
        <div class="form">
            <div class="checkout-detail" id="total">
                <?php
                if ($status != 2) {
                ?>
                    <h3 style="color: aliceblue;"><?php echo $order_date ?></h3>
                    <button type='button' class="btn-md fill cancellation-order" data-orderid1='<?php echo $row["order_id"]; ?>'> Order Cancellation</button>
                <?php
                } else {
                ?>
                    <h3 style="color: aliceblue;"><?php echo $order_date ?></h3>
                <?php
                }
                ?>
            </div>
            <hr>
            <div class="order-inner">
                <?php
                $sql = "SELECT od.quantity, od.price, p.name, p.image, o.total_price
                        FROM order_details od
                        JOIN product p 
                        ON od.product_id = p.product_id
                        JOIN orders o 
                        ON od.order_id = o.order_id
                        WHERE od.username = '$username' AND DATE(od.date_buy) = '$order_date' AND od.order_id = '$order_id'";
                $result2 = mysqli_query($Connect, $sql);
                while ($row2 = mysqli_fetch_array($result2)) {
                ?>
                    <div class="order-item">
                        <div class="details"><img src="../admin/img/<?php echo $row2['image'] ?>">
                            <div class="detail-item">
                                <h5 style="margin-bottom:10px"><?php echo $row2['name'] ?></h5><small> <?php echo $row2['quantity'] ?></small>
                            </div>
                        </div>
                        <h2 class="price" style="color: aliceblue;"> $<?php echo $row2['price'] ?></h2>
                    </div>
                <?php
                }
                ?>
            </div>
            <hr>
            <div class="checkout">
                <div class="checkout-detail" id="total">
                    <h3>Total amount including tax</h3>
                    <h3>$<?php echo $row['total_price'] ?></h3>
                </div>
                <div class="checkout-detail" id="total">
                    <?php
                    if ($status == 1) {
                    ?>
                        <button type='button' class="btn-md fill confirm-order" data-orderid='<?php echo $row["order_id"]; ?>'> Item received</button>
                    <?php
                    } elseif ($status == 2) {
                    ?>
                        <h3 style="color: aquamarine;">Order completed</h3>
                    <?php
                    }
                    ?>
                    <h3>Code orders: <?php echo $row["order_id"]; ?></h3>
                </div>
            </div>
        </div>
    <?php
    }
} else {
    ?>
    <div class="form">
        <h3 style="color: aliceblue;"></h3>
        <hr>
        <div class="order-inner" style="text-align: center;">
            <h1 style="color: aliceblue;">You don't have any orders yet</h1>
            <br>
            <br>
            <br>
            <a style="color: aliceblue;" href="../index.php?page=content">Let's make an order</a>
        </div>
        <hr>
        <div class="checkout">
            <div class="checkout-detail" id="total">
                <h3>Total amount including tax</h3>
                <h3>$</h3>
            </div>
        </div>
    </div>
<?php
}
?>
<script>
    $(document).ready(function() {
        $('.confirm-order').on('click', function() {
            var orderId = $(this).data('orderid');
            swal({
                title: "Confirmation",
                text: "Are you sure to confirm this order?",
                icon: "warning",
                buttons: ["Cancel", "Confirm"],
                dangerMode: true,
            }).then((willConfirm) => {
                if (willConfirm) {
                    $.ajax({
                        url: 'confirm_received.php',
                        method: 'POST',
                        data: {
                            order_id: orderId
                        },
                        success: function(data) {
                            swal({
                                title: "Success!",
                                text: data,
                                icon: "success",
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.cancellation-order').on('click', function() {
            var orderId = $(this).data('orderid');
            swal({
                title: "Confirmation",
                text: "Are you sure to confirm this order?",
                icon: "warning",
                buttons: ["Cancel", "Confirm"],
                dangerMode: true,
            }).then((willConfirm) => {
                if (willConfirm) {
                    $.ajax({
                        url: 'cancellation.php',
                        method: 'POST',
                        data: {
                            order_id: orderId1
                        },
                        success: function(data) {
                            swal({
                                title: "Success!",
                                text: data,
                                icon: "success",
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    });
</script>
