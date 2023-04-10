<?php

@include '../config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location: ../dangnhap.php');
};

if(isset($_POST['add_product'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $details = $_POST['details'];
 
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;
 
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_products->execute([$name]);
 
    if($select_products->rowCount() > 0){
       echo '<script>alert("Sản phẩm đã tồn tại!");</script>';
    }else{
 
        $insert_products = $conn->prepare("INSERT INTO `products`(name, category, details, price, image) VALUES(?,?,?,?,?)");
        $insert_products->execute([$name, $category, $details, $price, $image]);
        echo '<script>alert("Thêm sản phẩm thành công");</script>';
        if($insert_products){
            if($image_size > 2000000){
                $message[] = 'Kích thước ảnh quá lớn!';
            }else{
                move_uploaded_file($image_tmp_name, $image_folder);
                //  $message[] = 'new product added!';
            }
       }
    }
 };
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
    <h1 class="align_center">THÊM SẢN PHẨM</h1>
        <div id="content-wrapper" class="d-flex flex-column">
            <div class="container-fluid">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                    <form  method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputText" style="font-weight: bold;">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control" id="inputText4" placeholder="Nhập tên sản phẩm">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputNumber4" style=" font-weight: bold;">Giá</label>
                                <input type="number" min="0" name="price" class="form-control" id="inputNumber4">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputText4" style=" font-weight: bold;">Loại sản phẩm</label> <br>
                                <select name="category" class="form-control box" required>
                                    <option value="" selected disabled>Chọn loại</option>
                                    <option value="giangsinh"> Quà tặng giáng sinh</option>
                                    <option value="tet">Quà tặng dịp tết</option>
                                    <option value="valentine">Quà tặng valentine</option>
                                    <option value="thayco">Quà tặng 20/11</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputNumber4" style=" font-weight: bold;">Ảnh sản phẩm</label> 
                                <input type="file" name="image" class="form-control border-0" id="inputNumber4" accept="image/jpg, image/jpeg, image/png">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" style=" font-weight: bold;">Mô tả</label>
                            <textarea class="form-control" name="details" id="inputAddress" cols="10" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" value="Reset" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <input type="submit" class="btn btn-success" value="Thêm" name="add_product">
                        </div>
                    </form>

                </div>

                </div>
            </div>
            </div>

       
        </div> 


</div>

</main>

</body>
</html>