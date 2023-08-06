<?php
require('../config/constants.php');
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
        <h1>Add Category</h1>

        <br><br>



        <br><br>

        <!-- Add CAtegory Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" checked> Yes
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" checked> Yes
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add CAtegory Form Ends -->


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
 $title=$_POST['title'];
 $featured=$_POST['featured'];
 $active=$_POST['active'];
 if(isset($_FILES['image'])&& $_FILES['image']['name']){
   $name=$_FILES['image']['name'];
   $tmp=$_FILES['image']['tmp_name'];
   $ext=explode('.',$name);
   $ext=end($ext);
   $image_name="..\/images\/category\/$title.$ext";
   move_uploaded_file($tmp,$image_name);

 }else{
     $image_name="..\/images\/logo.png";
 }
 $q="INSERT INTO category (title,Image,Featured,Active)
 VALUES('$title',' $image_name',' $featured','$active');";

 $res=mysqli_query($conn,$q);

 if($res){
    $_SESSION['category'] ="<h4 class='success'>category added <h4>";
    header("location:manage-category.php");
 }else{
    $_SESSION['category'] = "<h4 class='errar'>category not added<h4>";
    header("location:manage-category.php");

 }

}
?>