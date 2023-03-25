<!-- Main Menu -->
<div class="main-menu">
    <?php
    $sql = "SELECT * FROM category";

    $result = mysqli_query($Connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div class="menu-page show-up" id="<?php echo $row["category_id"] ?>">
            <!-- Category -->
            <div class="category">
                <ul class="nav-links category">
                    <li><a href="javascript:void(0)" id="all-burg" class="nav-item active">All</a></li>
                    <li><a href="javascript:void(0)" id="bacon-burg" class="nav-item">Bacon</a></li>
                    <li><a href="javascript:void(0)" id="beef-burg" class="nav-item">Beef</a></li>
                    <li><a href="javascript:void(0)" id="chesee-burg" class="nav-item">Chesee</a></li>
                    <li><a href="javascript:void(0)" id="chicken-burg" class="nav-item">Chicken</a></li>
                </ul>
            </div>
            <!-- End Category -->
            <!-- Menu items -->
            <div class="menus">
                <?php
                $sql = "SELECT * FROM product";

                $result = mysqli_query($Connect, $sql);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <div class="menu burger" data-menu="beef-burg">
                        <img src='admin/img/<?php echo $row["image"] ?>' alt=''>
                        <h2 class="price">$ <?php echo $row["price"] ?></h2>
                        <div class="desc-item">
                            <h3><?php echo $row["name"] ?></h3>
                            <p><?php echo $row["description"] ?></p>
                        </div>
                        <button type="button">&#43;</button>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- End Menu Items -->
        </div>
    <?php
    }
    ?>
</div>
<!-- End Main Menu -->

<!-- Checkout Detail -->
<div class="order">
    <div class="order-list">
        <h3>Order Summary</h3>
        <hr>
        <div class="order-inner">
            <div class="order-null">
                <i class="fas fa-clipboard-list"></i>
                <p>belum ada pesanan</p>
            </div>
        </div>
        <hr>
        <div class="checkout">
            <div class="checkout-detail" id="qty">
                <h5>0 item(s)</h5>
                <h5>qty: <span>0</span></h5>
            </div>
            <div class="checkout-detail" id="subtotal">
                <h5>Subtotal</h5>
                <h4>$0</h4>
            </div>
            <div class="checkout-detail" id="tax" data-tax="5">
                <h5>Tax</h5>
                <h4>5%</h4>
            </div>
            <div class="checkout-detail" id="total">
                <h3>Total</h3>
                <h3>$0</h3>
            </div>
        </div>
        <div class="checkout-detail">
            <button type="button" class="btn-md outline">hold order</button>
            <button type="button" class="btn-md fill">checkout</button>
        </div>
    </div>
</div>
<!-- End Checkout Detail -->
</div>
</div>