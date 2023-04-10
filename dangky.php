<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = md5($_POST['pass']);
   $cpass = md5($_POST['cpass']);

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      echo '<script type="text/javascript">alert(`Email đã tồn tại`)</script>';
   }else{
      if($pass != $cpass){
        echo '<script type="text/javascript">alert(`Mật khẩu nhập lại không đúng!`)</script>';
      }else{
        $insert = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
        $insert->execute([$name, $email, $pass]);
        echo '<script type="text/javascript">alert(`Đăng ký thành công!`)</script>';
        header('location:dangnhap.php');
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Đăng ký</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/trangchu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="public/img/logo.png" rel="shortcut icon" type="images/vnd.microsoft.icon">
</head>
<body>
    <!---------- Phần form đăng ký -------------->
    <main style="background-color:#f9e5ef;border: 1px solid rgb(255, 255, 255);border-radius: 8px;"> 
        <div class="container"> 
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block">
                        <img src="./public/img/bg_dk.jpg" alt="" height="490px" width="420px">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h2">ĐĂNG KÝ</h1>
                            </div>
                            <form id="signupForm" class="user" action="" enctype="multipart/form-data" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Họ tên" name="name">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email" name="email">
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="pass" placeholder="Nhập mật khẩu" name="pass">
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Nhập lại mật khẩu" name="cpass">
                                    </div>
                                </div>
                                <br>
                                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block btn-login" style="width:50%; margin: auto; ">
                                    Đăng ký
                                </button>
                              
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="medium" href="dangnhap.php">Đã có tài khoản? Đăng nhập</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    <script type="text/javascript">
		$(document).ready(function(){
			$("#signupForm").validate({
				rules: {
					name: "required",
                    email: {required: true, email: true},
					pass: {required: true, minlength: 3},
					cpass: {required: true, minlength: 3, equalTo: "#pass"}
				},
				messages: {
                    name: "Bạn chưa nhập vào tên của bạn",
					email: "Hộp thư điện tử không hợp lệ",
					pass: {
						required: "Bạn chưa nhập mật khẩu",
						minlength: "Mật khẩu phải có ít nhất 3 ký tự"
					},
					cpass: {
						required: "Bạn chưa nhập mật khẩu",
						minlength: "Mật khẩu phải có ít nhất 3 ký tự",
						equalTo: "Mật khẩu không khớp"
					}
				},
				errorElement: "div",
				errorPlacement: function(error, element) {
					error.addClass("invalid-feedback");
					error.insertBefore(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("is-invalid").removeClass("is-valid");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("is-valid").removeClass("is-invalid");
				}
			});
		});
	</script>
	
</body>
</html>



