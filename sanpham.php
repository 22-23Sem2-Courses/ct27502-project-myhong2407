<!-- SẢN PHẨM start -->

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
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2><span>Sản phẩm</span></h2>
        </div>
        
        <div class="row px-xl-5 pb-3">
            
        <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
        ?>  

            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    
                <form class="card product-item border-0 mb-4" method="POST">
                    <a href="chitietsp.php?pid=<?= $fetch_products['id']; ?>">
                        <div class="btn card-header product-img position-relative overflow-hidden bg-transparent p-0 border rounded-top border-bottom-0 text-center">
                            <img id="img_sp" class="img-fluid w-100" src="./admin/uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                        </div>
                    </a>
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
            echo '<p class="empty">Hiện tại chưa có sản phẩm!</p>';
        }
        ?>            
        </div>
    </div>
</body>
