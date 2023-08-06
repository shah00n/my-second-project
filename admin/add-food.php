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
        <h1>Add Food</h1>

        <br><br>



        <form action="" method="post" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
<?php
 $q1="SELECT * from category ";
 $res=mysqli_query($conn,$q1);
 if($res){
    $category=mysqli_fetch_all($res,MYSQLI_ASSOC);
    foreach($category as $cat){
        $id=$cat['id'];
        $cat_titele=$cat['title'];
        echo "<option value=$id> $cat_titele</option>";
    }


}else{
echo "<option value=\"0\">No Category Found</option>";
}
?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
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

    </body>
    </html>
    <?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        $price = $_POST['price'];
        $cat_id = $_POST['category'];
        $description = $_POST['description'];
        if (isset($_FILES['image']) && $_FILES['image']['name']) {
            $name = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            $ext = explode('.', $name);
            $ext = end($ext);
            $image_name = "..\/images\/foods\/$title.$ext";
            echo $image_name;
            move_uploaded_file($tmp, $image_name);

 }else{
     $image_name="..\/images\/logo.png";
 }
 $q="INSERT INTO food (titele,Image,Featured,Active, Price, cat_id,Description)
 VALUES('$title',' $image_name',' $featured','$active','$price','$cat_id','$description');";

 $res=mysqli_query($conn,$q);

 if($res){
    $_SESSION['food'] ="<h4 class='success'>food added <h4>";
    header("location:manage-food.php");
 }else{
    $_SESSION['food'] = "<h4 class='errar'>food not added<h4>";
    header("location:manage-food.php");

 }

}
?>