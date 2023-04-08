<head>
    <style>
        .order1 {
            width: 35.5%;
            padding-right: 3.5rem;
            display: block;
            margin: 0 auto;
            /* căn giữa theo chiều ngang */
            text-align: center;
            /* căn giữa nội dung bên trong */
        }
    </style>
</head>
<div class="container">
    <div class="main-body">
        <?php
        include 'header.php';
        ?>
        <div class="order1">
            <div class="order-list">
                <h3>Order of <?php echo $_SESSION["us"] ?></h3>
                <hr>
                <div class="order-inner">
                    <?php
                    $total = 0;
                    if (isset($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $key => $value) :
                            $item_price = $value['price'] * $value['quantity'];
                            $total += $item_price;
                    ?>
                            <div class="order-item">
                                <div class="details"><img src="<?php echo $value['img'] ?>">
                                    <div class="detail-item">
                                        <h5 style="margin-bottom:10px"><?php echo $value['name'] ?></h5><small> <?php echo $value['quantity'] ?></small>
                                    </div>
                                </div>
                                <h2 class="price" style="color: aliceblue;"> $<?php echo $item_price ?></h2>

                            </div>
                    <?php
                        endforeach;
                    }
                    ?>
                </div>
                <hr>
                <div class="checkout">
                    <div class="checkout-detail" id="qty">
                        <h5><?php echo count($_SESSION['cart']); ?> item(s)</h5>
                        <h5>qty: <span><?php echo array_sum(array_column($_SESSION['cart'], 'quantity')); ?></span></h5>
                    </div>
                    <div class="checkout-detail" id="subtotal">
                        <h5>Subtotal</h5>
                        <h4>$<?php echo $total; ?></h4>
                    </div>
                    <div class="checkout-detail" id="tax" data-tax="5">
                        <h5>Tax</h5>
                        <h4>5%</h4>
                    </div>
                    <div class="checkout-detail" id="total">
                        <h3>Total</h3>
                        <h3>$<?php echo $total * 1.05; ?></h3>
                    </div>
                </div>
                <div class="checkout-detail">
                    <form action="payment.php" method="POST">
                        <input type="hidden" name="amount" value="<?php echo $gtotal = $total * 1.05; ?>">
                        <button class="btn-md fill" name="redirect" id="redirect">Payment</button>
                    </form>
                    <form method="POST" action="">
                        <input type="hidden" name="username" value="<?php echo $_SESSION["us"] ?>">
                        <button type="submit" name="removeOrder" class="btn-md fill">Back</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['removeOrder'])) {
    $username = $_POST['username'];
    $delete_sql = "DELETE FROM orders WHERE username = '$username'";
    $delete_sql1 = "DELETE FROM order_details WHERE username = '$username'";
    mysqli_query($Connect, $delete_sql);
    mysqli_query($Connect, $delete_sql1);
    echo '<meta http-equiv="refresh" content="0;URL =?page=content"';
    unset($_SESSION['cart']);
}
?>