<div class="container">
    <!-- Left Side Navbar -->
    <nav class="side-nav">
        <ul class="nav-links">
            <?php
            $sql = "SELECT * FROM category";
            $result = $Connect->query($sql);

            // Lấy category ID được chọn từ tham số URL
            $selected_category_id = isset($_GET['id']) ? $_GET['id'] : null;


            // Loop qua các category và tạo HTML tương ứng
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row["category_id"];
                    $name = $row["category_name"];
                    $icon = $row["icon"];

                    // Kiểm tra xem category hiện tại có được chọn không
                    $is_selected = $id == $selected_category_id;

                    // Thêm class "active" cho menu item nếu được chọn
                    $class = $is_selected ? 'active' : '';

                    // Tạo HTML cho menu item
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
                                    <h2 class="price"><?php echo $row["product_id"] ?></h2>
                                    <img src='admin/img/<?php echo $row["image"] ?>' alt=''>
                                    <h2 class="price">$ <?php echo $row["price"] ?></h2>
                                    <div class="desc-item">
                                        <h3><?php echo $row["name"] ?></h3>
                                        <p><?php echo $row["description"] ?></p>
                                    </div>
                                    <form method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row["product_id"] ?>">
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
                // Lấy thông tin sản phẩm từ form POST
                if (isset($_SESSION["us"])) {
                    $username = $_SESSION['us'];
                    $product_id = $_POST['product_id'];
                    $product_img = $_POST['img'];
                    $price = $_POST['price'];
                    $quantity = 1;

                    // Tạo truy vấn để lưu đơn hàng vào cơ sở dữ liệu
                    mysqli_query($Connect, "INSERT INTO cart(product_id,username,quantity, price,image) 
                VALUES ('$product_id','$username','$quantity', '$price','$product_img')");
                    $product = array(
                        'id' => $_POST['product_id'],
                        'img' => $_POST['img'],
                        'name' => $_POST['name'],
                        'price' => $_POST['price'],
                        'quantity' => 1
                    );
                }

                // Kiểm tra xem giỏ hàng đã được khởi tạo hay chưa
                if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
                    $found = false;
                    foreach ($_SESSION['cart'] as &$item) {
                        if ($item['name'] == $product['name']) {
                            // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng lên 1
                            $item['quantity']++;
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
                        $_SESSION['cart'][] = $product;
                    }
                } else {
                    // Nếu giỏ hàng chưa được khởi tạo, thêm sản phẩm vào giỏ hàng
                    $_SESSION['cart'][] = $product;
                }
                // echo "<script> alert(' Add to cart successful ');location.href='?page=cart';</script>";
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
        <?php if (isset($_GET["function1"]) == "delc") {
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                if (isset($_SESSION['cart'])) {
                    unset($_SESSION['cart']);
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

                                        <h5 style="margin-bottom:10px"><?php echo $value['name'] ?></h5><a class="btn-sm min" href="javascript:void(0)" onclick="btnMinusOrder(event)"></a><small> <?php echo $value['quantity'] ?></small><a class="btn-sm max" href="javascript:void(0)" onclick="btnPlusOrder(event)"></a><a class="remove" href="?page=content&&function=del&&id=<?php echo $key; ?>">delete</a>
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
                <input type="hidden" name="quantity" value="<?php echo $value['quantity'] ?>"></input>
                <input type="hidden" name="price" value="<?php echo $item_price; ?>"></input>
                <input type="hidden" name="total_tax" value="<?php echo $gtotal = $total * 1.05; ?>"></input>
                <button type="submit" name="addOrder" class="btn-md fill">Checkout</button>
            </form>
        </div>
        </div>
    </div>
    <!-- End Checkout Detail -->
    <?php
    include_once("connectDB.php");
    if (isset($_POST['addOrder'])) {
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
        } else { // Lấy thông tin giỏ hàng từ cơ sở dữ liệu
            $sql = "SELECT * FROM cart";
            $result = mysqli_query($Connect, $sql);

            // Lưu thông tin giỏ hàng vào bảng orders
            while ($row = mysqli_fetch_assoc($result)) {
                $id = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2) . rand(1000, 9999);
                $product_id = $row['product_id'];
                $username = $row['username'];
                $quantity = $row['quantity'];
                $price = $row['price'];
                $total_price = $gtotal;

                $order_sql = "INSERT INTO orders (order_id,product_id,username ,quantity, price, total_price) VALUES ('$id','$product_id','$username' ,'$quantity', '$price', '$total_price')";

                if (mysqli_query($Connect, $order_sql)) {
                    echo '<meta http-equiv="refresh" content="0;URL =?page=cart"';
                } else {
                    echo "Lỗi: " . $order_sql . "<br>" . mysqli_error($Connect);
                }
            }

            // Xóa thông tin giỏ hàng sau khi lưu vào bảng orders
            $delete_sql = "DELETE FROM cart";
            mysqli_query($Connect, $delete_sql);
        }
    }
    ?>
</div>
</div>