<?php
require('../config/constants.php');
 $q="SELECT * from category ";
 $res=mysqli_query($conn,$q);
 if($res){
    $category=mysqli_fetch_all($res,MYSQLI_ASSOC);
}else{
    $_SESSION['category']="<h4 class='error'>no data </h4>";

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
        <h1>Manage Category</h1>
        <?php
        if(isset($_SESSION['category'])){
            echo $_SESSION['category'];
            unset($_SESSION['category']);
        }
        
        
        ?>

        <br>
        <!-- Button to Add Admin -->
        <a href="add-category.php" class="btn-primary">Add Category</a>


        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
<?php
$i = 1;
foreach($category as $cat):
$id=$cat['id'];
?>

            <tr>
                <td> <?php echo $i;?></td>
                <td> <?php echo $cat['title'] ?></td>

                <td>
                    <img src= <?php echo $cat['Image'] ?> width="50px">


                </td>

                <td>  <?php echo $cat['Featured'] ?></td>
                <td>  <?php echo $cat['Active'] ?></td>
                <td>
                    <a href="update-category.php?id=<?php echo $id ?>" class="btn-secondary">Update Category</a>
                    <a href="delete-category.php?id=<?php echo $id ?>" class="btn-danger">Delete Category</a>
                </td>
            </tr>

<?php
$i++;
endforeach;
 ?>


        </table>
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