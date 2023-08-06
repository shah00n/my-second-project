<?php
require('../config/constants.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $q="SELECT * from category where id=$id";
    $res=mysqli_query($conn,$q);
    if($res && $res->num_rows==1){
       $category=mysqli_fetch_row($res);
    //    print_r($category);
       $title=$category[1];
       $old_image_name=$category[2];
       $Featured=$category[3];
       $Active=$category[4];


   }else{
    header("location:manage-category.php");
   
   }
}else{
    header("location:manage-category.php");
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
        <h1>Update Category</h1>

        <br><br>


        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                    <img src= <?php echo $old_image_name ?> width="50px">

                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                    <?php
                            if ($Featured == 'Yes') {
                                echo "<input type=\"radio\" name=\"featured\" value=\"Yes\" checked> Yes";
                            } else {
                                echo "<input type=\"radio\" name=\"featured\" value=\"Yes\"> Yes";
                            }
                            ?>

                            <?php
                            if ($Featured == 'No') {
                                echo "<input type=\"radio\" name=\"featured\" value=\"No\" checked> No";
                            } else {
                                echo "<input type=\"radio\" name=\"featured\" value=\"No\"> No";
                            }
                            ?>

                        

                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                    <?php
                            if ($Active == 'Yes') {
                                echo "<input type=\"radio\" name=\"active\" value=\"Yes\" checked> Yes";
                            } else {
                                echo "<input type=\"radio\" name=\"active\" value=\"Yes\"> Yes";
                            }
                            ?>
                            <?php
                            if ($Active == 'No') {
                                echo "<input type=\"radio\" name=\"active\" value=\"No\" checked> No";
                            } else {
                                echo "<input type=\"radio\" name=\"active\" value=\"No\"> No";
                            }
                            ?>

                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="">
                        <input type="hidden" name="id" value="">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
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
if (isset($_POST['submit'])) {
    $title_new = $_POST['title'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    // التحقق من وجود صورة جديدة تم تحميلها
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];

        // حدد المسار الجديد للصورة
        $target_directory = "../images/category/";
        $target_file = $target_directory . basename($image);
        $image_extension = pathinfo($target_file, PATHINFO_EXTENSION);

        // حفظ الصورة الجديدة
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // تحديث مسار الصورة في قاعدة البيانات
            $image_name = "../images/category/" . $image;
        } else {
            $_SESSION['category'] = "<h4 class='error'>Failed to upload image. Please try again.</h4>";
            header("location: manage-category.php");
            exit();
        }
    }else{
        $image_name=$old_image_name;
    }

$q="UPDATE category set title= '$title_new', Image='$image_name', Featured='$featured', Active='$active' where id='$id'";
$res=mysqli_query($conn,$q);
if($res){
    $_SESSION['category'] ="<h4 class='success'>category updated <h4>";
    header("location:manage-category.php");
    exit();
 }else{
    $_SESSION['category'] = "<h4 class='errar'>category not updated<h4>";
    header("location:manage-category.php");
    exit();
}



}



?>
