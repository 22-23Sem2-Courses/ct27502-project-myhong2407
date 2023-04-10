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
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Tìm kiếm</title>
        <link rel="stylesheet" href="public/css/style.css">
        <link rel="stylesheet" href="public/css/trangchu.css">
        <link rel="stylesheet" href="public/css/header.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="public/img/logo.png" rel="shortcut icon" type="images/vnd.microsoft.icon">
</head>

<body>
    <?php include 'header.php'; ?>
    
    <!-- Search button -->
    <div class="container-fluid">
        <div class="row py-5 px-xl-5">
            <div class="col-lg-6 col-6 text-left m-auto">
                <form action="" method="POST">
                    <div class="input-group">
                        <input type="text" name="search" class="text-center form-control border-info border-2 me-3" 
                            style="border-radius: 10px;" placeholder="Nhập sản phẩm cần tìm...">
                        <div class="input-group-append">
                            <button class="input-group-text text-light" name="search_btn" 
                                type="submit" style="border-radius: 8px; height: 40px; background-color: #2ECCFA;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Search button-->

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h3 class="section-title px-5"><span style="color: #F781D8; font-family: Arial, Helvetica, sans-serif;">Kết quả tìm kiếm của bạn ở đây</span></h3>
        </div>
        
        <div class="row px-xl-5 pb-3" >

        <?php
            if(isset($_POST['search_btn'])){
                $search = $_POST['search'];
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search}%' OR category LIKE '%{$search}%'");
                $select_products->execute();
                if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
        ?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    
                <form class="card product-item border-0 mb-4" method="POST">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0  border rounded-top border-bottom-0 text-center">
                        <img class="img-fluid w-100" src="./admin/uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h5 class="text-truncate mb-3 font-weight-semi-bold"><?= $fetch_products['name']; ?></h5>
                        <div class="d-flex justify-content-center">
                            <h6><span><?= number_format($fetch_products['price'], 0, ',', '.') ; ?>đ</h6>
                        </div>
                    </div>
                    <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                    <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
                    <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">   
                    <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
                    <input type="hidden" min="1" value="1" name="p_qty" class="qty" style="text-align:center;">
                    <!-- Thêm giỏ hàng -->
                    <div class="text-center">
                            <input type="submit" value="️Thêm giỏ hàng"  class="btn" name="add_to_cart" 
                                style="width: 130px; background-color: #f9e5ef;">
                    </div> 
                    
                </form>
            </div>
        <?php
                }
            }else{
                echo '<p class="empty">Không tìm thấy sản phẩm!</p>';
            }
        };
        ?>            
        </div>
    </div>
    <!-- Products End -->

    <!-- Footer Start -->
    <?php include 'footer.php'; ?>
    <!-- Footer End -->

</body>

</html>