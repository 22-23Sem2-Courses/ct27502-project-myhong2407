<?php

@include '../config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location: ../dangnhap.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
   $select_delete_image->execute([$delete_id]);
   $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_products->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:admin_quanlysp.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link href="../admin/css/style_admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./../public/img/logo.png" rel="shortcut icon" type="images/vnd.microsoft.icon">
</head>
<body>
    <?php include 'admin_nav.php'; ?>
    <main>
    <h1 class="align_center">QUẢN LÝ SẢN PHẨM</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên SP</th>
                            <th>Loại</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Hiệu chỉnh</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $show_products = $conn->prepare("SELECT * FROM `products`");
                            $show_products->execute();
                            if($show_products->rowCount() > 0){
                                while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
                        ?>
                        <tr>
                            <td><?= $fetch_products['id']; ?></td>
                            <td><?= $fetch_products['name']; ?></td>
                            <td><?= $fetch_products['category']; ?></td>
                            <td><?= $fetch_products['details']; ?></td>
                            <td><?= $fetch_products['price']; ?></td>
                            <td><img style="width: 6rem;" src="./uploaded_img/<?= $fetch_products['image']; ?>" alt=""></td>
                            <td class="flex-btn">
                                <a href="admin_quanlysp.php?update=<?= $fetch_products['id']; ?>" 
                                    style=" margin-left: 7px;
                                        font-weight: 700;
                                        color: #27ae60;
                                        text-decoration:none;">Cập nhật</a>  <br>
                                <a href="admin_quanlysp.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?');" 
                                    style=" margin-left: 7px;
                                        font-weight: 700;
                                        color: #e74a3b;
                                        text-decoration:none;
                                        line-height: 40px;">Xóa</a>
                            </td>
                        </tr>
                        <?php
                                }
                            }else{
                                echo '<p class="empty">Chưa có sản phẩm!</p>';
                            }
                        ?>    
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
    
</main>

</body>
</html>

