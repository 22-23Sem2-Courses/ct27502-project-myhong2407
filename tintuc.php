<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tin tức</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/trangchu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="public/img/logo.png" rel="shortcut icon" type="images/vnd.microsoft.icon">

</head>
<body>
    <!-- Header Start -->
    <?php include 'header.php'; ?>
    <!-- Header End -->
    <main style="background-color:#f9e5ef; border-radius: 10px; margin-top: 10px;">
        <div class="container tintuc">
            <div class="row">
                <div id="demo" class="carousel slide" data-bs-ride="carousel">
                    <!-- Indicators/dots -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                    </div>
                    <!-- The slideshow/carousel -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="public/img/banner_8-3.png"  class="d-block" style="width:100%">
                        </div>
                        <div class="carousel-item">
                            <img src="public/img/banner_valentine.png"  class="d-block" style="width:100%">
                        </div>
                        <div class="carousel-item">
                            <img src="public/img/banner_20-10.png"  class="d-block" style="width:100%">
                        </div>
                    </div>
                    
                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                    </div>
                    
            </div>
            <div class="row">
                <img src="public/img/tintuc1.png" alt="">
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 banner_cate">
                    <a href="">
                        <img src="public/img/tintuc2.png" alt="">
                    </a>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 banner_cate">
                    <a href="">
                        <img src="public/img/tintuc3.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 banner_cate">
                    <a href="">
                        <img src="public/img/tintuc4.jpg" width="100%" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 banner_cate">
                    <a href="">
                        <img src="public/img/tintuc5.png" alt="">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 banner_cate">
                    <a href="">
                        <img src="public/img/tintuc6.png" width="100%" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 banner_cate">
                    <a href="">
                        <img src="public/img/tintuc7.png" alt="">
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 banner_cate">
                    <a href="">
                        <img src="public/img/tintuc8.png" alt="">
                    </a>
                </div>
            </div>
            <div class="row">
                
            </div>
        </div>
    </main>

    <!-- Footer Start -->
    <?php include 'footer.php'; ?>
    <!-- Footer End -->
</body>
</html>
