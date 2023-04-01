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
        <?php
        if (isset($_GET["function"]) == "del") {
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                if (isset($_SESSION['cart'])) {
                    unset($_SESSION['cart'][$id]);
                }

                echo '<meta http-equiv="refresh" content="0; URL=?page=cart"/>';
            }
        }
        ?>
        <?php if (isset($_GET["function1"]) == "delc") {
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                if (isset($_SESSION['cart'])) {
                    unset($_SESSION['cart']);
                }

                echo '<meta http-equiv="refresh" content="0; URL=?page=cart"/>';
            }
        } ?>
        <div class="order1">
            <div class="order-list">
                <h3>Order Summary</h3>
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
                                        <h5 style="margin-bottom:10px"><?php echo $value['name'] ?></h5><a class="btn-sm min" href="javascript:void(0)" onclick="btnMinusOrder(event)"></a><small> <?php echo $value['quantity'] ?></small><a class="btn-sm max" href="javascript:void(0)" onclick="btnPlusOrder(event)"></a><a class="remove" href="?page=cart&&function=del&&id=<?php echo $key; ?>">delete</a>
                                    </div>
                                </div>
                                <h2 class="price"> $<?php echo $item_price ?></h2>

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
                        <input type="hidden" name="amount" value="<?php echo $gtotal = $total * 1.05; ?>"></input>
                        <button class="btn-md fill" name="redirect" id="redirect">Checkout</button>
                    </form>
                    <button type="button" onclick="window.location='?page=content'" class="btn-md fill">Back</button>
                </div>
            </div>
        </div>
    </div>