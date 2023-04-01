<?php
session_start();
ob_start();
if(!isset($_SESSION['cart'])) $_SESSION['cart']=array();
if(isset($_POST['btnCart'])&&($_POST['btnCart'])){
    $tensp=$_POST['name'];
    $img=$_POST['img'];
    $gia=$_POST['price'];
    $sl=1; $fg=0;
    // tìm và so sánh sp trong giỏ hàng
    if(isset($_SESSION['cart'])&&(count($_SESSION['cart'])>0)){
      $i=0;
      foreach ($_SESSION['cart'] as $sp) {
        if($sp[0]==$id){
          //cập nhật mới số lượng
          $sl+=$sp[4];
          $fg=1;
          //cập nhật số lượng mới vào giỏ hàng
          $_SESSION['cart'][$i][4]=$sl;
          break;
        }
        $i++;
      }
    }
    //khi số lượng ban đầu không thay đổi thì thêm mới sp vào giỏ hàng
    if($fg==0){
      $sp=array($id,$tensp,$img,$gia,$sl);
      array_push($_SESSION['cart'],$sp);
    }

    //chuyển trang
    echo '<meta http-equiv="refresh" content="0;URL =?page=cart"/>';
}
?>
