<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="view/css/style.css">
    <link rel="stylesheet" href="view/css/trangchu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="view/img/logo.png" rel="shortcut icon" type="images/vnd.microsoft.icon">
</head>

<body class="container">
    <header>
        <a href="#" class="gb-title"><img src="view/img/logo.png" class="logo" alt="">PINKY CAT - More than just a gift</a>
        <form class="btn-nav float-end" action="timkiem.html" method="get" name="search" onsubmit="return sendForm()">
            <input class="text-search ip" id="txt-search" name="fname" type="text" onkeypress="keypress()" placeholder="Nhập nội dung tìm kiếm">
            <button class="button-search btn" id="btn-search" onclick="clickSearch()"><i class="fa fa-search"></i></button>
            <button class="button-shopping btn" onclick="openCart()"><i class="fa fa-shopping-cart"></i></button> 
        </form>
        
        <nav >
            <a href="index.php" class="col-sm-1 text-white">Trang chủ</a>
            <a href="index.php?pg=gioithieu" class="col-sm-1 text-white">Giới thiệu</a>
            <a href="index.php?pg=sanpham" class="col-sm-1 text-white">Sản phẩm</a>
            <a href="index.php?pg=tintuc" class="col-sm-1 text-white">Tin tức</a>
            <a href="index.php?pg=lienhe" class="col-sm-1 text-white">Liên hệ</a>

            <a class="col-sm-5"></a>

            <a href="./DK-DN-Admin/dangky.html" class="col-sm-1 text-white">Đăng ký</a>
            <a href="./DK-DN-Admin/dangnhap.html" class="col-sm-1 text-white">Đăng nhập</a>
            <div class="animation start-trangchu"></div>
            
        </nav>

    </header>