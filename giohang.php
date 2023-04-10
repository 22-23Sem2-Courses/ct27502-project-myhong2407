<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:dangnhap.php');
};


if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:giohang.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $p_qty = $_POST['p_qty'];
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$p_qty, $cart_id]);
   echo '<script type="text/javascript">alert(`Đã cập nhật thành công!`)</script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Giỏ hàng</title>
   <link rel="stylesheet" href="public/css/style.css">
   <link rel="stylesheet" href="public/css/trangchu.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link href="public/img/logo.png" rel="shortcut icon" type="images/vnd.microsoft.icon">
   <style>
      @media (min-width: 1025px) {
         .h-custom {
            height: 100vh !important;
         }
      }

      .card-registration .select-input.form-control[readonly]:not([disabled]) {
         font-size: 1rem;
         line-height: 2.15;
         padding-left: .75em;
         padding-right: .75em;
      }

      .card-registration .select-arrow {
         top: 13px;
      }

      .bg-grey {
         background-color: #eae8e8;
      }

      @media (min-width: 992px) {
         .card-registration-2 .bg-grey {
            border-top-right-radius: 16px;
            border-bottom-right-radius: 16px;
         }
      }

      @media (max-width: 991px) {
         .card-registration-2 .bg-grey {
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
         }
      }
   </style>
</head>  
   

<body>
   <!-- Topbar Start -->
   <?php include 'header.php'; ?>
   <!-- Topbar End -->

   <!-- Page Header Start -->
   <section class="h-100 h-custom" style="background-color: #f9e5ef; border-radius: 10px; margin-top: 10px;">
      <div class="container py-5 h-100">
         <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
               <div class="card card-registration card-registration-2" style="border-radius: 20px;">
                  <div class="card-body p-0">
                     <div class="row g-0">
                        <div class="col-lg-9">
                           <div class="p-5">
                              <div class="d-flex justify-content-between align-items-center mb-5">
                                 <h1 class="fw-bold mb-0 text-black">Giỏ hàng</h1>
                              </div>
                                          <!--  -->
                              
                              <form action="" method="post">
                                 <div class="row mb-4 d-flex justify-content-between align-items-center">
                                    <div class="col-md-1 col-lg-1 col-xl-1">
                                       <p><b>Hình ảnh</b></p>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                       <p><b>Tên sản phẩm</b></p>
                                    </div>

                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                       <p><b>Giá</b></p>
                                    </div>
                                    
                                    <div class="col-md-2 col-lg-2 col-xl-1 d-flex flex-btn">
                                       <div class="flex-btn">
                                          <p><b class="text-center">Số lượng</b></p>
                                       </div>
                                    </div>

                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                       <p class="align-middle"><b>Tổng tiền</b></p>
                                    </div>

                                    <div class="col-md-2 col-lg-2 col-xl-2 text-end">
                                       <p><b>Hiệu chỉnh</b></p>
                                    </div>
                                 </div>
                                 <hr class="my-4">
                                 <?php
                                 $grand_total = 0;
                                 $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                                 $select_cart->execute([$user_id]);
                                 if($select_cart->rowCount() > 0){
                                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){ 
                                 ?>   
                                 <div class="row mb-4 d-flex justify-content-between align-items-center">
                                    <div class="col-md-1 col-lg-1 col-xl-1">
                                       <img src="./admin/uploaded_img/<?= $fetch_cart['image']; ?>" alt="" style="width: 50px;"> 
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                       <b> <?= $fetch_cart['name']; ?></b>
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                       <?= number_format($fetch_cart['price'], 0, ',', '.') ; ?> đ
                                       <input class="fw-bold" type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                                       
                                    </div>
                                    <div class="col-md-2 col-lg-2 col-xl-1 d-flex">
                                       <div class="flex-btn">
                                          <input style="width: 50px;" type="number" min="1"
                                              value="<?= $fetch_cart['quantity']; ?>" class="qty" name="p_qty">
                                       </div>
                                    </div>

                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                       <h6 class="align-middle mb-0"> <?php
                                             $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']);
                                          ?><?= number_format($sub_total, 0, ',', '.');  ?> đ</h6>
                                    </div>

                                    <div class="col-md-2 col-lg-2 col-xl-2 text-end">
                                       <input type="submit" value="Cập nhật" name="update_qty" class="option-btn btn-warning border">
                                    </div>
                                 </div>
                                 <?php
                                    $grand_total += $sub_total;
                                    }
                                 }else{
                                    echo '
                                    <div class="card header align-items-center mb-4" style="padding: 15px;">
                                       <h5 class="fw-bold" style="color: #FF69B4;">Giỏ hàng trống</h5>
                                    </div>';
                                 }
                                 ?>

                                 <hr class="my-4">
                              </form>
                           </div>
                        </div>

                        
                        <div class="col-lg-3 bg-grey pt-5" style="background-color: #c3eefa;">
                           <div class="p-5 pt-5">
                              <h3 class="fw-bold mb-0 text-black">Tổng tiền hóa đơn</h3>
                              <hr class="my-4">
                              <div class="d-flex justify-content-between mb-5">
                                 <h5 class="fw-bold ">Tổng tiền:</h5>
                                 <h5><?= number_format($grand_total, 0, ',', '.'); ?> đ </h5>
                              </div>
                              <hr class="my-4">
                              <div class="border-secondary bg-transparent">
                                 <a href="thanhtoan.php" type="button" class="btn btn-block btn-dark py-3 border <?php  ($grand_total > 1)?'':'disabled'; 
                                                                                                                  ?>">Tiến hành thanh toán</a>                                     
                                 <a href="home.php" type="button" class="btn btn-block btn-success my-3 py-3 border">Tiếp tục mua sắm</a>                            

                                 <a href="giohang.php?delete_all" type="button" class="btn btn-block btn-danger my-3 py-3 border <?php  ($grand_total > 1)?'':'disabled'; 
                                                                                                                              ?>">Xóa tất cả</a>
                              </div> 
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- Footer Start -->
   <?php include 'footer.php'; ?>
   <!-- Footer End -->


