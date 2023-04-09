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
    <title>Trang chủ</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/trangchu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="public/img/logo.png" rel="shortcut icon" type="images/vnd.microsoft.icon">
</head> 
<body>
    <main>
        <?php include 'header.php'; ?>
        <div class="container-fluid mb-5 pt-3">
            <div class="row ">
                <div class="col-lg-3 d-none d-lg-block">
                    <!--======================== Danh mục =======================  -->
                    <a class="btn shadow-none d-flex align-items-center bg-info text-white w-90 border" data-toggle="collapse" href="#navbar-vertical" style="background-color: #0081B4; height: 50px; padding: 0 20px;">
                        <h6 class="m-0 me-3">Danh mục quà tặng</h6>
                        <i class="fa fa-angle-down text-dark"></i>
                    </a>
                
                    <nav class="collapse show navbar p-0 border" id="navbar-vertical">
                        <div class="navbar-nav w-100 overflow-hidden" style="text-align: justify;">
                            <a href="category.php?category=giangsinh" class="nav-link fw-bold" style="color: #FF69B4; text-align: justify; padding: 0px 20px;">
                                Quà tặng giáng sinh</a>
                            <a href="category.php?category=tet" class="nav-link fw-bold" style="color: #FF69B4; text-align: justify; padding: 0px 20px;">
                                Quà tặng dịp tết</a>
                            <a href="category.php?category=valentine" class="nav-link fw-bold" style="color: #FF69B4;text-align: justify; padding: 0px 20px;">
                                Quà tặng valentine</a>
                            <a href="category.php?category=thayco" class="nav-link fw-bold" style="color: #FF69B4;text-align: justify; padding: 0px 20px;">
                                Quà tặng 20/11</a>
                        </div>
                    </nav>
                </div>
                <div class="col-sm-9">
                    <div id="carousel" class="carousel slide" data-bs-ride="carousel">

                        <!-- Nút dưới ảnh -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"></button>
                            <button type="button" data-bs-target="#carousel" data-bs-slide-to="3"></button>
                        </div>

                        <!-- Ảnh -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a href=""><img src="public/img/banner_20-11.jpg" alt="" class="d-block" style="width:100%"></a>
                            </div>
                            <div class="carousel-item">
                                <a href=""><img src="public/img/banner-hop-nhac.jpg" alt="" class="d-block" style="width:100%"></a>
                            </div>
                            <div class="carousel-item">
                                <a href=""><img src="public/img/banner-quatructuyen-luvgift.jpg" alt="" class="d-block"
                                        style="width:100%"></a>
                            </div>
                            <div class="carousel-item">
                                <a href=""><img src="public/img/merrychristmas.png" alt="" class="d-block" style="width:100%"></a>
                            </div>
                        </div>

                        <!-- Nút trái phải -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>

                    <!----------------------------- Sản phẩm hot ------------------------------------>
                    <h1>HOT DEAL</h1>
                    <div class="row hotdeal">
                        <div class="col-sm-4">
                            <a href="">
                                <div class="zoomin">
                                    <a href=""><img src="public/img/tuong-ong-ba-gia-xem-album-1.jpg" alt="" width="100%"></a>
                                </div>
                            </a>
                            <h5>Tượng ông bà già </h5>
                            <h5 class="price">239 000₫</h5>
                        </div>
                        <div class="col-sm-4">
                            <a href="">
                                <div class="zoomin">
                                    <a href=""><img src="public/img/dong-ho-cat-khung-vang-1-300x300.jpg" alt="" width="100%"></a>
                                </div>
                            </a>
                            <h5>Đồng hồ cát khung kim loại</h5>
                            <h5 class="price">499 000₫</h5>
                        </div>
                        <div class="col-sm-4">
                            <a href="">
                                <div class="zoomin">
                                    <a href=""><img src="public/img/den-ngu-led-3D-1-300x300.jpg" alt="" width="100%"></a>
                                </div>
                            </a>
                            <h5>Đèn ngủ</h5>
                            <h5 class="price">199 000₫</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CATEGORY start-->
        <section class="container-fluid">
            <div class="row pb-3">
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
                            <h5 class="font-weight-semi-bold text-center" style="padding-left: 23px; color: black;">Quà tặng valentine</h5>
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
        </section>
        <!-- CATEGORY end -->
        
        <?php include 'sanpham.php'; ?>

        <div class="content">
            <h1>QUÀ TẶNG DỊP ĐẶC BIỆT</h1>
            <div class="row">
                <h2>QUÀ TẾT</h2>
                <div class="col-sm-8">
                    <p>Những ngày Tết đến xuân về là khoảng thời gian duy nhất trong năm cả nhà gác công việc thườngnhật
                        của mình qua
                        một bên để tận hưởng những giây phút sum vầy, hạnh phúc cùng gia đình. Người ta dọn dẹp, trang
                        hoàng nhà cửa,
                        ăn uống và đi chơi cùng nhau vào dịp này với ước mong có một năm mới tràn đầy may mắn, vui vẻ.
                        Tết là văn hoá
                        truyền thống của người Việt, là dịp để gắn kết tình thân gia đình, tết còn là cơ hội để các
                        doanh nghiệp quan
                        tâm, thể hiện tình cảm của mình với đối tác, với nhân viên của mình bằng những món quà tết, giỏ
                        quà tết, hộp quà tết ý nghĩa.
                        Vì đối tác, nhân viên là tài sản vô giá của doanh nghiệp cần gắn kết xây dựng. Tết đến Xuân về,
                        người người
                        được trở về thăm gia đình sau bao tháng ngày bôn ba mưu sinh nơi đất khách quê người. Và đây
                        cũng là dịp để trao
                        nhau những món quà ý nghĩa, những tấm lòng, lời chúc tốt đẹp cho năm mới vẹn tròn hơn. Song,
                        việc chọn được
                        một món quà ý nghĩa lại không phải là điều dễ dàng, nhất là khi thị trường quà biếu ngày càng
                        phong phú như hiện nay.
                    </p>
                </div>
                <div class="col-sm-4 qtdb">
                    <div class="hieu_ung">
                        <a href=""><img src="public/img/qua-tet-2.webp" alt="Hộp quà Tết ý nghĩa" width="100%"></a>
                        <div class="phu_de">
                            <div class="thong_tin">
                                <h2>Hộp quà Tết ý nghĩa</h2>
                                <h5 class="price">999 000₫</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row">
                <h2>QUÀ TẶNG LỄ TỐT NGHIỆP</h2>
                <div class="qtdb col-sm-4">
                    <div class="hieu_ung">
                        <a href=""><img src="public/img/but-kyjpg.jpg" alt="Bút ký" width="100%"></a>
                        <div class="phu_de">
                            <div class="thong_tin">
                                <h2>Bút ký</h2>
                                <h5 class="price">150 000₫</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <p>
                        Lễ tốt nghiệp là một trong những dịp quan trọng của các bạn học sinh, sinh viên, đánh dấu bước
                        tiến lớn trong
                        cuộc đời, phải rời xa mái trường, vào đời, vận dụng những kiến thức đã học để làm việc, cống
                        hiến cho xã hội và
                        chăm lo cho gia đình,... Vào ngày này, những món quà tặng, những bó hoa rực rỡ gửi đến tân cử
                        nhân là điều không
                        thể thiếu. Đó còn là lời chúc mừng, chúc may mắn, truyền tải thông điệp yêu thương. Quà tặng tốt
                        nghiệp là những
                        món quà thay lời chúc mừng đến cử nhân trong ngày lễ tốt nghiệp. Tùy vào mối quan hệ giữa bạn và
                        người nhận mà
                        chúng ta có thể lựa chọn quà tặng tốt nghiệp thật phù hợp. Món quà có thể thiết thực và hữu ích
                        cho công việc,
                        cuộc sống của người được nhận sau khi tốt nghiệp như: sách, bút, phong bao chúc mừng,… Cũng có
                        thể là món quà tinh
                        thần gợi nhắc đến những kỷ niệm đẹp của cả hai như một đoạn clip kỷ niệm, một chiếc album ảnh,…
                        Nó sẽ giúp nhân đôi
                        niềm vui, niềm hạnh phúc khi gặt hái được thành quả lao động của người nhận.
                    </p>
                </div>
            </div>
        </div>

        <div class="content">
            <h1>QUÀ TẶNG THEO ĐỐI TƯỢNG</h1>
            <p>365 ngày trong năm, mỗi ngày là một kỷ niệm ý nghĩa đối với mỗi gia đình. Bạn có thể mua quà tặng bố mẹ,
                gửi gắm những tâm sự tình cảm nhất đến đấng sinh thành. Từng cử chỉ, hành động dù là đơn giản, nhỏ bé
                của bạn cũng khiến bố mẹ thực sự rất xúc động, cảm kích.</p>
            <p>Nếu bạn cảm thấy ngại ngùng, khó nói thành lời với bố mẹ, hãy để những món quà thay bạn trao gửi yêu
                thương. Mỗi năm thường có những dịp lễ đặc biệt như lễ Vu Lan, ngày Quốc Tế Gia Đình, Tết … mà bạn có
                thể nhân ngày này tặng quà cho bố mẹ.</p>
            <p>Đối với một người làm cha, làm mẹ, việc nuôi dạy, dõi theo những thành công trong đời con là việc rất
                hạnh phúc, không gì sánh bằng. Cha mẹ chẳng mong mỏi gì hơn, chỉ mong con cái lớn khôn thành người,
                tu nhân tích đức.</p>
        </div>

        <div class="content">
            <h1>HÒA NHỊP GIÁNG SINH - TRAO GỬI YÊU THƯƠNG</h1>
            <div class="content-vid">
                <video src="public/img/istockphoto-1353877619-640_adpp_is.mp4" controls="controls"></video>
            </div>
            <p>Chìm đắm trong không khí Giáng sinh, khách hàng đến với Kairos với đơn hàng quà tặng giáng sinh bất kỳ
                sẽ được gói quà miễn phí, còn chần chờ gì nữa mà không nhanh chân đến với chúng tôi "rước" những món quà 
                ý nghĩa tặng cho người thân, bạn bè.<p>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>
