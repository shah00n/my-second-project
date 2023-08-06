<?php
require('../config/constants.php');
 $q="SELECT * from food ";
 $res=mysqli_query($conn,$q);
 if($res){
    $food=mysqli_fetch_all($res,MYSQLI_ASSOC);
}else{
    $_SESSION['food']="<h4 class='error'>no data </h4>";

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
        <h1>Manage Food</h1>
        <?php
        if(isset($_SESSION['food'])){
            echo $_SESSION['food'];
            unset($_SESSION['food']);
        }
        
        
        ?>
        <br/><br/>

        <!-- Button to Add Admin -->
        <a href="add-food.php" class="btn-primary">Add Food</a>

        <br/><br/><br/>


        <table class="tbl-full">
            <tr>
            <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Category</th>
                    <th>Actions</th>

            </tr>
            <?php
                    foreach ($food as $cat) :
                        $id = $cat['id'];
                    ?>
                        <td>
                            <?php echo $cat['id'] ?>
                        </td>
                        <td> <?php echo $cat['titele'] ?></td>
                        <td><?php echo $cat['Price'] ?></td>
                        <td><img src=<?php echo $cat['Image'] ?> width="50px"></td>
                        <td><?php echo $cat['Featured'] ?></td>
                        <td><?php echo $cat['Active'] ?></td>
                        <td>
                            <?php
                            $categoryId = $cat['cat_id'];
                            $categoryQuery = "SELECT title FROM category WHERE id = $categoryId";
                            $categoryResult = mysqli_query($conn, $categoryQuery);
                            if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
                                $categoryData = mysqli_fetch_assoc($categoryResult);
                                echo $categoryData['title'];
                            } else {
                                echo 'N/A';
                            }
                            ?>
                <td>
                <a href="update-food.php?id=<?php echo $id ?>" class="btn-secondary">Update food</a>
                    <a href="delete-food.php?id=<?php echo $id ?>" class="btn-danger">Delete food</a>
                </td>
            </tr>
            <?php

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