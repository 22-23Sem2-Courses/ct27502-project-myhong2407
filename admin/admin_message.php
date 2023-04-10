<?php

@include '../config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location: ../dangnhap.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:admin_message.php');

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
    <h1 class="align_center">QUẢN LÝ TIN NHẮN</h1>
    
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">   
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách tin nhắn</h6>
                    </div>
                    <div class="card-body">
                         <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên người dùng</th>
                                        <th>Email</th>
                                        <th>Tin nhắn</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $select_message = $conn->prepare("SELECT * FROM `message`");
                                        $select_message->execute();
                                        if($select_message->rowCount() > 0){
                                            while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <tr>
                                        <td><?= $fetch_message['user_id']; ?></td>
                                        <td><?= $fetch_message['name']; ?></td>
                                        <td><?= $fetch_message['email']; ?></td>
                                        <td><?= $fetch_message['message']; ?></td>
                                        <td class="flex-btn">
                                            <a href="admin_message.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa tin nhắn này?');" class="delete-btn"
                                            style=" font-weight:700;
                                                    border-radius: 20px;
                                                    color: #e74a3b;
                                                    text-decoration:none;"
                                            >Xóa</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }else{
                                        echo '<p class="empty">Chưa có tin nhắn</p>';
                                    }
                                    ?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    
    </main>

</body>
</html>

