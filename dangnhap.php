<?php

include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $pass = md5($_POST['pass']);

   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){
      if($row['user_type'] == 'admin'){
        $_SESSION['admin_id'] = $row['id'];
        header('location: ./admin/index.php');  
      }elseif($row['user_type'] == 'user'){
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');
      }else{
        echo '<script type="text/javascript">alert(`Không tìm thấy người dùng!`)</script>';
      }
   }else{
        echo '<script type="text/javascript">alert(`Email hoặc mật khẩu không đúng!`)</script>';
   }

}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/trangchu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="public/img/logo.png" rel="shortcut icon" type="images/vnd.microsoft.icon">
</head>
<body>
    <main style="background-color:#f9e5ef;  border: 1px solid rgb(255, 255, 255);border-radius: 8px; margin-top: 10px;">
     <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img src="./public/img/bg_dn.jpg" alt=""  height="470px" width="420px">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h2">ĐĂNG NHẬP</h1>
                                    </div>
                                    <form id="signInForm"  class="user" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email"
                                                placeholder="Nhập email" name="email">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="pass" placeholder="Nhập mật khẩu" name="pass">
                                        </div>
                                       <br>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck" id="clickButton">Ghi nhớ tôi</label>
                                            </div>
                                        </div> <br>

                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                            Đăng nhập
                                        </button>
                                    </form>
                                    
                                    <hr>
                                
                                    <div class="text-center">
                                        <a class="medium" href="./dangky.php">Chưa có tài khoản? Đăng ký</a>
                                    </div>
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
			$("#signInForm").validate({
				rules: {
                    email: {required: true, email: true},
					pass: {required: true, minlength: 3}
				},
				messages: {
                    email: "Hộp thư điện tử không hợp lệ",
					pass: {
						required: "Bạn chưa nhập mật khẩu",
						minlength: "Mật khẩu phải có ít nhất 3 ký tự"
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
    <script type="text/javascript" >
        $(document).ready(function(){ 
            $('#clickButton').click(); 
        });
    </script>
</body>
</html>


