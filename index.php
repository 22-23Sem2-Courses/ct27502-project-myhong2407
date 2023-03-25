<?php
     include "view/header.php";
     
     if(isset($_GET["pg"])){
          $pg=$_GET["pg"];

     switch ($pg) {
          case 'gioithieu':
            include "view/gioithieu.php";
             break;
          case 'tintuc':
            include "view/tintuc.php";
          break;
          case 'lienhe':
            include "view/lienhe.php";
          break;
          case 'sanpham':
            include "view/sanpham.php";
          break;
        default:
            include "view/home.php";
            break;
    }  
}else{
     include "view/home.php";

}
          
     include "view/footer.php";
?>