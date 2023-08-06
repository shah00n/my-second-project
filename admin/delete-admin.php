<?php
require('../config/constants.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $q="DELETE from admin where id=$id";
    $res=mysqli_query($conn,$q);
    if($res && $res){
    $_SESSION['admin'] ="<h4 class='success'>admin deleted <h4>";
    header("location:manage-admin.php");

   }else{
    $_SESSION['admin'] ="<h4 class='error'>admin deleted <h4>";
    header("location:manage-admin.php");
   
   }
}else{
   header("location:manage-admin.php");
}




?>

