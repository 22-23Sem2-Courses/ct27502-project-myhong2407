<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:dangnhap.php');
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
        <meta charset="UTF-8">
        <title>Chi tiết sản phẩm</title>
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

     <div class="container-fluid mb-4" style="background-color: #faeaf2;">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 120px">
            <h1 class="font-weight-semi-bold text-uppercase mt-3">Chi tiết sản phẩm</h1>
            
        </div>
    </div>
    <form class="row px-xl-5" method="POST">

        <?php
        $pid = $_GET['pid'];
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_products->execute([$pid]);
        if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
        ?>
        <div class="table-responsive col-lg-12 mb-3 card">
            <div class="row">
                <div class="col-md-4">
                <img class="img-fluid w-100" src="./admin/uploaded_img/<?= $fetch_products['image']; ?>" alt="...">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $fetch_products['name']; ?></h5>
                    <p class="card-text"><?= $fetch_products['details']; ?></p>
                    <h6><?= number_format($fetch_products['price'],0,',','.'); ?> đ</h6>
                </div>
                </div>
            </div>
        </div>

        <div class="border-secondary mb-3 text-end">
            <a href="shopquatang.php" type="button" class="btn btn-block btn-success py-3 border" style="background-color: #0BDA51;">
                    Tiếp tục mua sắm</a>
        </div>
        
        <?php
                }
            }else{
                echo '<p class="empty">Chưa có sản phẩm nào được thêm vào!</p>';
            }
        ?>
    </form>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer -->