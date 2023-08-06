<?php
require('../config/constants.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $q="SELECT * from admin where id=$id";
    $res=mysqli_query($conn,$q);
    if($res && $res->num_rows==1){
       $admin=mysqli_fetch_row($res);
    //    print_r($admin);
       $username=$admin[2];
       $fullname=$admin[1];

   }else{
    header("location:manage-admin.php");
   
   }
}else{
    header("location:manage-admin.php");
}




?>

<html>
<head>
    <title>Food Order Website - Home Page</title>

    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
<!-- Menu Section Starts -->
<div class="menu text-center">
    <div class="wrapper">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="manage-admin.php">Admin</a></li>
            <li><a href="manage-category.php">Category</a></li>
            <li><a href="manage-food.php">Food</a></li>
            <li><a href="manage-order.php">Order</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $fullname?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>


<div class="footer">
    <div class="wrapper">
        <p class="text-center">2021 All rights reserved, Food House</p>
    </div>
</div>
<!-- Footer Section Ends -->

</body>
</html>
<?php
if(isset($_POST['submit'])){
$username =$_POST['username'];
$full_name =$_POST['full_name'];

$q="UPDATE admin set username= '$username', fullname='$full_name' where id='$id'";
$res=mysqli_query($conn,$q);
if($res){
    $_SESSION['admin'] ="<h4 class='success'>admin updated <h4>";
    header("location:manage-admin.php");
 }else{
    $_SESSION['admin'] = "<h4 class='errar'>admin not updated<h4>";
    header("location:manage-admin.php");}



}



?>

