<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location: dangnhap.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $address = 'Duong ' . $_POST['duong'] .' '. $_POST['phuong'] .'  '. $_POST['tinh'];
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if($cart_query->rowCount() > 0){
      while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
         $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      };
   };

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
   $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

   if($cart_total == 0){
   }elseif($order_query->rowCount() > 0){
      $message[] = 'order placed already!';
   }else{
        $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
        $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart->execute([$user_id]);
        echo '<script type="text/javascript">alert(`Đặt hàng thành công!`)</script>';
   }

}
?>
 <!-- Topbar Start -->
 <?php include 'header.php'; ?>
<!-- Topbar End -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đơn hàng</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/trangchu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="public/img/logo.png" rel="shortcut icon" type="images/vnd.microsoft.icon">
</head>
<body>
    <!--========== THANH TOÁN ==========-->
    <div class="container-fluid pt-5">

     <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      
    ?> 

        <div class="row px-xl-5">

            <form class="col-lg-7" method="POST">
                <div class="mb-4">
                    <div class="card-header border-1" style="background-color: #acdff1;">
                        <h4 class="font-weight-semi-bold m-0">Thông tin giao hàng</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="m-2">Họ và tên</label>
                            <input name="name" class="form-control" type="text" placeholder="Nguyễn Văn A">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="m-2">Số điện thoại</label>
                            <input name="number" class="form-control" type="text" placeholder="0124681012">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="m-2">Email</label>
                            <input name="email" class="form-control" type="email" placeholder="shopquatang@gmail.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="m-2">Phương thức thanh toán</label>
                            <select name="method" class="form-control" required>
                               <option value="cod">Thanh toán khi nhận hàng</option>
                               <option value="tindung">Thẻ tín dụng</option>
                               <option value="momo">Momo</option>
                            </select>
                         </div>
                        <div class="col-md-6 form-group"><br></div>
                        <div class="col-md-6 form-group">
                            <label class="m-2">Tỉnh/Thành phố</label>
                            <input name="tinh" class="form-control" type="text" placeholder="Cần Thơ">
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <label class="m-2">Phường/Xã</label>
                            <input name="phuong" class="form-control" type="text" placeholder="Xuân Khánh">
                        </div>
                        
                        <div class="col-md-12 form-group">
                            <label class="m-2">Địa chỉ</label>
                            <input name="duong" class="form-control" type="text" placeholder="Đường 3/2">
                        </div>
                        <div class="col-md-12 text-end">
                            <button name="order" class="btn btn-block btn-primary my-3 py-2 border <?php  ($cart_grand_total > 1)?'':'disabled'; ?>" type="submit">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
            
            <div class="col-lg-5">
                <div class="card mb-5">
                    <div class="card-header border-1" style="background-color: #f8d1e5;">
                        <h4 class="font-weight-semi-bold m-0">Thông tin đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Sản phẩm</h5>

                        <?php
                            if($select_cart_items->rowCount() > 0){
                                while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
                                   $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
                                   $cart_grand_total += $cart_total_price;
                        ?>    

                        <div class="d-flex justify-content-between">
                            <p><b><?= $fetch_cart_items['name']; ?></b></p>
                            <p><?=number_format( $fetch_cart_items['price'], 0, ',', '.'). 'đ x ' . $fetch_cart_items['quantity']; ?> </p>
                        </div>
                                    
                        <?php
                            }
                        }else{
                            echo '<p class="font-weight-medium text-danger">Giỏ hàng rỗng</p>';
                        }
                        ?>

                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng tiền</h5>
                            <h5 class="font-weight-bold"><?= number_format($cart_grand_total, 0, ',', '.'); ?> đ</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <?php include 'footer.php'; ?>
    <!-- Footer End -->

</body>
</html>
