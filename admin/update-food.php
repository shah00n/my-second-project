<?php
require('../config/constants.php');
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $q="SELECT * from food where id=$id";
    $res=mysqli_query($conn,$q);

    if ($res && $res->num_rows == 1) {
        $food = mysqli_fetch_row($res);
        $title = $food[1];
        $Price = $food[2];
        $old_image_name = $food[3];
        $Featured = $food[4];
        $Active = $food[5];


   }else{
    header("location:manage-food.php");
   
   }
}else{
    header("location:manage-food.php");
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
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">

                                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price" value="<?php echo $Price ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <img src=<?php echo $old_image_name ?> width="50px">
                        </td>
                    </tr>

                    <tr>
                        <td>Select New Image:</td>
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
                                echo "<input type=\"radio\" name=\"Active\" value=\"Yes\" checked> Yes";
                            } else {
                                echo "<input type=\"radio\" name=\"Active\" value=\"Yes\"> Yes";
                            }
                            ?>
                            <?php
                            if ($Active == 'No') {
                                echo "<input type=\"radio\" name=\"Active\" value=\"No\" checked> No";
                            } else {
                                echo "<input type=\"radio\" name=\"Active\" value=\"No\"> No";
                            }
                            ?>
                        </td>
                    </tr>
                    <td>
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="current_image" value="">

                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
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
    $price_new = $_POST['price'];
    if ($title != $title_new) {
        $name = $old_image_name;
        $ext = explode('.', $name);
        $ext = end($ext);
        $old_image_name = "..\/images\/category\/$title.$ext";
        rename($old_image_name, $image_name);
        $image_name = $old_image_name;
    };
    $featured = $_POST['featured'];
    $Active = $_POST['Active'];

    // التحقق من وجود صورة جديدة تم تحميلها
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $image = $_FILES['image']['name'];
        // حدد المسار الجديد للصورة
        $target_directory = "../images/foods/";
        $target_file = $target_directory . basename($image);
        $image_extension = pathinfo($target_file, PATHINFO_EXTENSION);
        // حفظ الصورة الجديدة
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // تحديث مسار الصورة في قاعدة البيانات
            $image_name = "../images/foods/" . $image;
        } else {
            $_SESSION['food'] = "<h4 class='error'>Failed to upload image. Please try again.</h4>";
            header("location: manage-food.php");
            exit();
        }
   
    }else{
        $image_name=$old_image_name;
    }

$q="UPDATE food set titele= '$title_new', Image='$image_name', Featured='$featured', Active='$Active', Price='$price_new' where id='$id'";
$res=mysqli_query($conn,$q);
if($res){
    $_SESSION['food'] ="<h4 class='success'>food updated <h4>";
    header("location:manage-food.php");
 }else{
    $_SESSION['food'] = "<h4 class='errar'>food not updated<h4>";
    header("location:manage-food.php");}



}



?>