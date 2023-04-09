<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location: dangnhap.php');
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $msg = $_POST['msg'];

   $select_message = $conn->prepare("SELECT * FROM `message` WHERE  email = ? AND message = ?");
   $select_message->execute([$email, $msg]);

   if($select_message->rowCount() > 0){
    echo '<script>alert("Tin nhắn đã tồn tại")</script>';
   } else{

      $insert_message = $conn->prepare("INSERT INTO `message`(user_id, name, email, message) VALUES(?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $msg]);
    echo '<script>alert("Tin nhắn được gửi thành công. Cảm ơn bạn đã liên hệ với chúng tôi <3")</script>';

   }

}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Liên hệ</title>
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

  <main style="background-color:#f9e5ef; border-radius: 10px; margin-top: 10px;">
        <h1 style="text-align: center;">Liên Hệ</h1>
        <div class="container lienhe">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <div class="row me-3">
                <div class="col-md box m-3">
                  <h2>Địa chỉ</h2>
                  <h6>Khu II, Đại học Cần Thơ</h6>
                </div>
                <div class="col-md box m-3">
                  <h2>Điện thoại</h2>
                  <h6>0899681887</h6>
                  </div>
              </div>
              <div class="row me-3">
                <div class="col-md box m-3">
                  <h2>Email</h2>
                  <h6>pinkycat@gmail.com</h6>
                </div>
                <div class="col-md box m-3">
                  <h2>Mở cửa</h2>
                  <h6>7h - 22h</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-md-6 col-sm-12 col-xs-12">
              <div class="row">
                <form name="lienhe" novalidate="novalidate" action="" method="POST">
                    <h2>Góp ý</h2>
                    <div class="forms">
                        <div class="mb-2">
                          <label for="exampleFormControlInput1" ><b>Họ tên</b></label>
                          <input name="name" type="text" class="form-control" placeholder="Tên của bạn"/>
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlInput1" ><b>Email</b></label>
                            <input name="email" required type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                          </div>
                          <div class="mb-2">
                            <label  for="exampleFormControlTextarea1" ><b>Nội dung góp ý</b></label>
                            <textarea name="msg" required class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                          </div>
                          <div class="mb-2"><input name="send" class="btn btn-light" type="submit" value="Gửi"></div>      
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.8415184086434!2d105.76842661397495!3d10.029933692830644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBD4bqnbiBUaMah!5e0!3m2!1svi!2s!4v1669381459729!5m2!1svi!2s" width="allowfullscreen" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
    </main>
 
  <?php include 'footer.php'; ?>

</body>
</html>
