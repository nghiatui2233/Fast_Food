
<div class="container">
    <div class="main-body">
        <?php
        include 'header.php';
        ?>

        <div class="order1">
            <div class="order-list">
                <h3>Your order has been successfully paid</h3>
                <hr>
                <div class="order-inner" style="text-align: center;">
                    <h1 style="color: azure;">Thank you so much for trusting us!</h1>
                    <?php
                    include_once("connectDB.php");
                    $sql = "SELECT DATE(MAX(date_buy)) as order_date, total_price, username
                    FROM orders
                    GROUP BY DATE(date_buy) AND username
                     ";

                    $result = mysqli_query($Connect, $sql);
                    $row = mysqli_fetch_array($result)
                    ?>
                    <h1 style="color: azure;">Your total payment is:</h1>
                    <h1 style="color: coral;">$<?php echo $row['total_price'] ?></h1>
                    <h1 style="color: azure;">Your order will be prepared and delivered right away!</h1>
                </div>
                <hr>
                <div style="text-align: center;">
                    <form method="POST">
                        <button type="submit" name="removeOrder" class="btn-md fill">Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['removeOrder'])) {

    echo '<meta http-equiv="refresh" content="0;URL =?page=content"';

    unset($_SESSION['cart']);
}
?>