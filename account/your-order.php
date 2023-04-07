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
</head>

<?php
$username = $_SESSION["us"];
$sql = "SELECT DISTINCT DATE(date_buy) AS date_buy FROM orders WHERE username = '$username'";
$result = mysqli_query($Connect, $sql);

while ($row = mysqli_fetch_array($result)) {
    $order_date = $row['date_buy'];
?>
    <div class="form">
        <h3 style="color: aliceblue;"><?php echo $order_date ?></h3>
        <hr>
        <div class="order-inner">
            <?php
            $sql = "SELECT o.*, p.name, p.image
            FROM orders o 
            JOIN product p 
            ON o.product_id = p.product_id
            WHERE o.username = '$username' AND DATE(o.date_buy) = '$order_date'";
            $result2 = mysqli_query($Connect, $sql);
            $total_price = 0;
            while ($row2 = mysqli_fetch_array($result2)) {
                $total_price += $row2['price'] * $row2['quantity'];
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
            $total_price_with_tax = $total_price * 1.05;
            ?>
        </div>
        <hr>
        <div class="checkout">
            <div class="checkout-detail" id="total">
                <h3>Total amount including tax</h3>
                <h3>$<?php echo $total_price_with_tax ?></h3>
            </div>
        </div>
    </div>
<?php
}
?>