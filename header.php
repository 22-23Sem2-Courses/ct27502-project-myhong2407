<!-- <?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:dangnhap.php');
};
?> -->


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/trangchu.css">
    <link rel="stylesheet" href="public/css/header.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="public/img/logo.png" rel="shortcut icon" type="images/vnd.microsoft.icon">
</head>

<body class="container">
    <div class="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <ul class="left-info">
                        <?php
                            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                            $select_profile->execute([$user_id]);
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <li><i class="fas fa-user-circle-o text-white"> <?= $fetch_profile['name']; ?> </i></li>
                        <li><a href="thoat.php" class="col-sm-1 text-white text-decoration-none" style="font-size: 20px;">
                                <i class='fas fa-sign-out-alt' style="font-size: 20px;"></i>Đăng Xuất</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="right-icons">
                        <li><a href="timkiem.php"><i class="fa fa-search"></i></a></li>
                        <li><a href="giohang.php"><i class="fa fa-shopping-cart"></i></a></li>
                        <li></li>
                    </ul>
                     
                </div>
            </div>
            
        </div>
        
    </div>
    <div class="sub-header">
        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                    <ul class="left-info">
                        <li><a href="home.php" class="col-sm-1 text-white text-decoration-none" style="font-size: 20px;">Trang chủ</a></li>
                        <li><a href="shopquatang.php" class="col-sm-1 text-white text-decoration-none" style="font-size: 20px;">Sản phẩm</a></li>
                        <li><a href="gioithieu.php" class="col-sm-1 text-white text-decoration-none" style="font-size: 20px;">Giới thiệu</a></li>
                        <li> <a href="tintuc.php" class="col-sm-1 text-white text-decoration-none" style="font-size: 20px;">Tin tức</a></li>
                        <li><a href="lienhe.php" class="col-sm-1 text-white text-decoration-none" style="font-size: 20px;">Liên hệ</a></li>
                        <li></li>
                    </ul>
            </div>
        </div>
    </div>
           
</body>
    
  
   
      