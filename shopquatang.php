<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location: dangnhap.php');
};

if(isset($_POST['add_to_cart'])){

    $pid = $_POST['pid'];
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_image = $_POST['p_image'];
    $p_qty = $_POST['p_qty'];
 
    $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
    $check_cart_numbers->execute([$p_name, $user_id]);
 
    if($check_cart_numbers->rowCount() > 0){
     echo '<script type="text/javascript">alert(`Đã có trong giỏ hàng!`)</script>';
    }else{
       $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
       $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
       echo '<script type="text/javascript">alert(`Thêm vào giỏ hàng thành công!`)</script>';
    }
 
 }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
        <meta charset="UTF-8">
        <title>Sản phẩm</title>
        <link rel="stylesheet" href="public/css/style.css">
        <link rel="stylesheet" href="public/css/trangchu.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="public/img/logo.png" rel="shortcut icon" type="images/vnd.microsoft.icon">
</head>  
 <body>
    <?php include 'header.php'; ?>


    <!-- LOẠI QUÀ TẶNG BẮT ĐẦU TỪ ĐÂY -->
    <div class="container-fluid row pt-3">
        <div class="col-lg-3 col-md-6">
            <div class="cat-item d-flex" style="padding: 20px; background-color: #fbdfee;  border-radius:20px;">
                <a href="category.php?category=giangsinh" class="text-decoration-none mb-3 text-center">
                    <h5 class="font-weight-semi-bold text-center" style="padding-left: 12px; color: black;">Quà tặng giáng sinh</h5>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="cat-item d-flex" style="padding: 20px; background-color: #fbdfee;  border-radius:20px;">
                <a href="category.php?category=tet" class="text-decoration-none mb-3 text-center">
                    <h5 class="font-weight-semi-bold text-center" style="padding-left: 33px; color: black;">Quà tặng dịp tết</h5>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="cat-item d-flex" style="padding: 20px; background-color: #fbdfee;  border-radius:20px;">
                <a href="category.php?category=valentine" class="text-decoration-none mb-3 text-center">
                    <h5 class="font-weight-semi-bold text-center" style="padding-left: 20px; color: black;">Quà tặng valentine</h5>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="cat-item d-flex" style="padding: 20px; background-color: #fbdfee;  border-radius:20px;">
                <a href="category.php?category=thayco" class="text-decoration-none mb-3 text-center">
                    <h5 class="font-weight-semi-bold text-center" style="padding-left: 40px; color: black;">Quà tặng 20/11</h5>
                </a>
            </div>
        </div>
    </div>
    <!-- LOẠI QUÀ TẶNG KẾT THÚC -->

    <!-- SẢN PHẨM THEO LOẠI start -->
    <?php include 'sanpham.php'; ?>
    <!-- SẢN PHẨM THEO LOẠI end-->

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer -->

</body>

</html>