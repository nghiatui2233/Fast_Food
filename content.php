<div class="container">
    <!-- Left Side Navbar -->
    <nav class="side-nav">
        <ul class="nav-links">
            <?php
            $sql = "SELECT * FROM category";
            $result = $Connect->query($sql);

            // Lay category ID duoc chon tu tham so URL
            $selected_category_id = isset($_GET['id']) ? $_GET['id'] : null;


            // Loop qua cac category va tao HTML tuong ung
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row["category_id"];
                    $name = $row["category_name"];
                    $icon = $row["icon"];

                    // kiem tra xem category co duoc chon hay khong
                    $is_selected = $id == $selected_category_id;

                    // them class active neu duoc chon
                    $class = $is_selected ? 'active' : '';
                    echo '<li><a href="index.php?=categorylist&id=' . $id . '" class="nav-item ' . $class . '" data-target="' . $id . '"><i class="fas ' . $icon . '" style="font-size:24px;margin-bottom:3px;"></i>' . $name . '</a></li>';
                }
            }
            ?>
        </ul>
    </nav>
    <!-- End Left Side Navbar -->
    <!-- Right Body -->
    <div class="main-body">
        <!-- Header -->
        <?php
        include 'header.php';
        ?>
        <!-- End Header -->
        <!-- Main Menu -->
        <div class="main-menu">
            <?php
            $sql = "SELECT * FROM category";

            $result = mysqli_query($Connect, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="menu-page show-up" id="<?php echo $row["category_id"] ?>">
                    <!-- Menu items -->
                    <div class="menus">
                        <?php
                        $sql = "SELECT * FROM product WHERE category_id = ?";
                        $stmt = mysqli_prepare($Connect, $sql);
                        mysqli_stmt_bind_param($stmt, "s", $_GET["id"]);
                        mysqli_stmt_execute($stmt);
                        $result2 = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row = mysqli_fetch_array($result2)) {
                        ?>
                                <div class="menu " data-menu="beef-burg">
                                    <img src='admin/img/<?php echo $row["image"] ?>' alt=''>
                                    <h2 class="price">$ <?php echo $row["price"] ?></h2>
                                    <div class="desc-item">
                                        <h3><?php echo $row["name"] ?></h3>
                                        <p><?php echo $row["description"] ?></p>
                                    </div>
                                    <form method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $row["product_id"] ?>">
                                        <input type="hidden" name="img" value="admin/img/<?php echo $row["image"] ?>">
                                        <input type="hidden" name="name" value="<?php echo $row["name"] ?>">
                                        <input type="hidden" name="price" value="<?php echo $row["price"] ?>">
                                        <button type="submit" name="btnCart">&#43;</button>
                                    </form>
                                </div>
                            <?php
                            }
                        } else {
                            $sql = "SELECT * FROM product";

                            $result = mysqli_query($Connect, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <div class="menu" data-menu="beef-burg">
                                    <img src='admin/img/<?php echo $row["image"] ?>' alt=''>
                                    <h2 class="price">$ <?php echo $row["price"] ?></h2>
                                    <div class="desc-item">
                                        <h3><?php echo $row["name"] ?></h3>
                                        <p><?php echo $row["description"] ?></p>
                                    </div>
                                    <form method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $row["product_id"] ?>">
                                        <input type="hidden" name="img" value="admin/img/<?php echo $row["image"] ?>">
                                        <input type="hidden" name="name" value="<?php echo $row["name"] ?>">
                                        <input type="hidden" name="price" value="<?php echo $row["price"] ?>">
                                        <button type="submit" name="btnCart">&#43;</button>
                                    </form>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- End Menu Items -->
                </div>
            <?php
            }
            if (isset($_POST['btnCart'])) {
                // lay thong tin san pham tu POTS
                if (!isset($_SESSION["us"])) {
                    echo "<script>
                        $(document).ready(function() { 
                        swal({
                            title: 'Wait!',
                            text: 'You must be logged in to pay!',
                            icon: 'warning',
                            button: 'OK',
                        }).then(function() {
                            window.location.href = '?page=sign-in';
                        });
                        });
                    </script>";
                    exit();
                } else {
                    if (isset($_SESSION["us"])) {
                        $username = $_SESSION['us'];
                        $product_id = $_POST['product_id'];
                        $product_name = $_POST['name'];
                        $product_img = $_POST['img'];
                        $price = $_POST['price'];
                        $quantity = 1;

                        $product = array(
                            'id' => $product_id,
                            'img' => $product_img,
                            'name' => $product_name,
                            'username' => $username,
                            'price' => $price,
                            'quantity' => $quantity
                        );
                    }

                    // kiem tra xem gio hang co duoc tao hay chua
                    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                        // kiem tra xem da co san pham trong gio hang hay chua
                        $found = false;
                        foreach ($_SESSION['cart'] as &$item) {
                            if ($item['name'] == $product['name']) {
                                // neu co + 1
                                $item['quantity']++;
                                $found = true;
                                break;
                            }
                        }
                        if (!$found) {
                            // neu chua them san pham moi vao
                            $_SESSION['cart'][] = $product;
                        }
                    } else {
                        // neu chua co gio hang, tao gio hang
                        $_SESSION['cart'][] = $product;
                    }
                }
            }
            ?>
        </div>

        <!-- End Main Menu -->
        <?php


        if (isset($_GET["function"]) == "del") {
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                if (isset($_SESSION['cart'])) {
                    unset($_SESSION['cart'][$id]);
                }

                echo '<meta http-equiv="refresh" content="0; URL=?page=content"/>';
            }
        }
        ?>
        <?php if (isset($_GET["action"]) == "up") {
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                if (isset($_SESSION['cart'])) {
                    $quantity = $_POST['quantity'];
                }

                echo '<meta http-equiv="refresh" content="0; URL=?page=content"/>';
            }
        } ?>
        <!-- Checkout Detail -->
        <div class="order">
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
                                        <h5 style="margin-bottom:10px"><?php echo $value['name'] ?></h5>
                                        <a class="btn-sm min"></a>
                                        <small id="quantity_<?php echo $key ?>"><?php echo $value['quantity'] ?></small>
                                        <a class="btn-sm max"></a>
                                        <a class="remove" href="?page=content&&function=del&&id=<?php echo $key; ?>">delete</a>
                                    </div>
                                </div>
                                <h2 class="price"> $<?php echo $item_price ?></h2>

                            </div>
                        <?php
                        endforeach;
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
            <?php
                    } else {
            ?>
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
                    <h3>$0 </h3>
                </div>
            </div>
        <?php
                    }
        ?>
        <div class="checkout-detail">
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $value['id'] ?>"></input>
                <input type="hidden" name="name" value="<?php echo $value['name'] ?>"></input>
                <input type="hidden" name="username" value="<?php echo $value['username'] ?>"></input>
                <input type="hidden" name="quantity" value="<?php echo $value['quantity'] ?>"></input>
                <input type="hidden" name="price" value="<?php echo $item_price; ?>"></input>
                <input type="hidden" name="total_tax" value="<?php echo $gtotal = $total * 1.05; ?>"></input>
                <button type="submit" name="addOrder" class="btn-md fill">Checkout</button>
            </form>
        </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</div>
<!-- End Checkout Detail -->
<?php

include_once("connectDB.php");

if (isset($_POST['addOrder'])) {
    $username = $_POST['username'];
    $cartItems = $_SESSION['cart'];
    $totalPrice = $_POST['total_tax'];;
    $id = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2) . rand(1000, 9999);

    // them don hang vao db
    $sql = "INSERT INTO orders (order_id,username, total_price,status, date_buy) VALUES ('$id','$username', '$totalPrice','0', '".date('Y-m-d H:i:s')."')";
    mysqli_query($Connect, $sql);

    // them chi tiet don hang vao db
    foreach ($_SESSION['cart'] as $item) {
        $order_detal_id = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2) . rand(1000, 9999);;
        $product_id = $item['id'];
        $username = $item['username'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $total_item_price = $quantity * $price;

        $sql = "INSERT INTO order_details (order_detail_id,order_id, product_id, quantity, price, total_price,username, date_buy) 
                VALUES ('$order_detal_id','$id', '$product_id', '$quantity', '$price', '$total_item_price','$username','".date('Y-m-d H:i:s')."')";
        mysqli_query($Connect, $sql);
    }
    // chuyen huong ve trang gio hang de xac nhan
    echo '<meta http-equiv="refresh" content="0; URL=?page=cart"/>';
}
?>
