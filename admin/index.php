


<?php
require('../config/constants.php');


// جمع عدد الطلبيات
$query = "SELECT COUNT(*) AS id FROM order_food";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_orders = $row['id'];

// جمع عدد الأصناف
$query = "SELECT COUNT(*) AS id FROM category";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_categories = $row['id'];

// جمع عدد الوجبات
$query = "SELECT COUNT(*) AS id FROM food";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_foods = $row['id'];

// حساب مجموع الإيرادات
$query = "SELECT SUM(Total) AS Total FROM order_food";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_revenue = $row['Total'];

// إغلاق اتصال قاعدة البيانات
mysqli_close($conn);
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
                <li><a href="login.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br><br>

            <br><br>

            <div class="col-4 text-center">



                <h1> <?php echo $total_categories ?></h1>
                <br />

                Categories
            </div>

            <div class="col-4 text-center">


                <h1><?php echo $total_foods ?></h1>
                <br />
                Foods
            </div>

            <div class="col-4 text-center">



                <h1><?php echo $total_orders ?></h1>
                <br />
                Total Orders
            </div>

            <div class="col-4 text-center">



                <h1><?php echo $total_revenue ?></h1>
                <br />
                Revenue Generated
            </div>

            <div class="clearfix"></div>

        </div>
    </div>
    <!-- Main Content Setion Ends -->

    <div class="footer">
        <div class="wrapper">
            <p class="text-center">2021 All rights reserved, Food House</p>
        </div>
    </div>
    <!-- Footer Section Ends -->

</body>

</html>