<?php
require('../config/constants.php');

$q = "SELECT * FROM order_food";
$res = mysqli_query($conn, $q);

if ($res) {
    $order_food = mysqli_fetch_all($res, MYSQLI_ASSOC);
} else {
    echo mysqli_error($conn); // عرض رسالة الخطأ الفعلية في حالة فشل الاستعلام
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
                <li><a href="login.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Order</h1>
            <?php
            if (isset($_SESSION['order_food'])) {
                echo $_SESSION['order_food'];
                unset($_SESSION['order_food']);
            }
            ?>

            <br /><br /><br />

            <a href="add-order.php" class="btn-primary">Add Order</a>
            <br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

                <?php foreach ($order_food as $cat) :
                    $id = $cat['id'];
                ?>
                    <tr>
                        <td><?php echo $cat['id'] ?></td>
                        <td>                          
                          <?php
                            $foodId = $cat['Status_order'];
                            $foodQuery = "SELECT titele FROM food WHERE id = $foodId";
                            $foodResult = mysqli_query($conn, $foodQuery);
                            if ($foodResult && mysqli_num_rows($foodResult) > 0) {
                                $foodData = mysqli_fetch_assoc($foodResult);
                                echo $foodData['titele'];
                            } else {
                                echo 'N/A';
                            }
                            ?>
                            </td>
                        <td><?php echo $cat['Price'] ?></td>
                        <td><?php echo $cat['Qty'] ?></td>
                        <td><?php echo $cat['Price'] * $cat['Qty']; ?></td>
                        <td><?php echo $cat['Order_date'] ?></td>
                        <td><?php echo $cat['Status_order'] ?></td>
                        <td><?php echo $cat['Customer_name'] ?></td>
                        <td><?php echo $cat['Contact'] ?></td>
                        <td><?php echo $cat['Email'] ?></td>
                        <td><?php echo $cat['Address'] ?></td>
                        <td>
                            <a href="update-order.php?id=<?php echo $id ?>" class="btn-secondary">Update Order</a>
                            <a href="delete-order.php?id=<?php echo $id ?>" class="btn-danger">Delete Order</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
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