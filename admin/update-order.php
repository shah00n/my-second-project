<?php
require('../config/constants.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q = "SELECT * FROM order_food where id = $id";
    $res = mysqli_query($conn, $q);

    if ($res && $res->num_rows == 1) {
        $order_food = mysqli_fetch_row($res);
        $Food = $order_food[1];
        $Price = $order_food[2];
        $Qty = $order_food[3];
        $Status_order = $order_food[6];
        $Customer_name = $order_food[7];
        $Contact = $order_food[8];
        $Email = $order_food[9];
        $Address = $order_food[10];
    } else {
        header("location:manage-order.php");
        exit(); // إضافة هذا السطر لمنع استمرار تنفيذ الكود في حالة التحويل
    }
} else {
    header("location:manage-order.php");
    exit(); // إضافة هذا السطر لمنع استمرار تنفيذ الكود في حالة التحويل
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
            <h1>Update Order</h1>
            <br><br>


            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Food Name</td>
                        <td><input type="text" name="title" value="<?php echo $Food ?>"></td>
                    </tr>

                    <tr>
                        <td>Price</td>
                        <td><input type="text" name="price" value="<?php echo $Price ?>"></td>
                    </tr>

                    <tr>
                        <td>Qty</td>
                        <td><input type="number" name="qty" value="<?php echo $Qty ?>"></td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="status">
                            <?php
 $q1="SELECT * from food ";
 $res=mysqli_query($conn,$q1);
 if($res){
    $food=mysqli_fetch_all($res,MYSQLI_ASSOC);
    foreach($food as $cat){
        $id=$cat['id'];
        $cat_titele=$cat['titele'];
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
                        <td>Customer Name:</td>
                        <td><input type="text" name="customer_name" value="<?php echo $Customer_name ?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Contact:</td>
                        <td><input type="text" name="customer_contact" value="<?php echo $Contact ?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Email:</td>
                        <td><input type="text" name="customer_email" value="<?php echo $Email ?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Address:</td>
                        <td><textarea name="customer_address" cols="30" rows="5"><?php echo $Address ?></textarea></td>
                    </tr>

                    <tr>
                        <td clospan="2">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <div class="footer">
        <div class="wrapper">
            <p class="text-center">2021 All rights reserved, Order House</p>
        </div>
    </div>
    <!-- Footer Section Ends -->
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $Food_new = $_POST['title'];
    $Price_new = $_POST['price'];
    $Qty_new = $_POST['qty'];
    $Status_order_new = $_POST['status'];
    $Customer_name_new = $_POST['customer_name'];
    $Contact_new = $_POST['customer_contact'];
    $Email_new = $_POST['customer_email'];
    $Address_new = $_POST['customer_address'];
    $Total = $Price_new * $Qty_new;

    $q = "UPDATE order_food SET Food='$Food_new', Price='$Price_new', Qty='$Qty_new', Total='$Total', Status_order='$Status_order_new', Customer_name='$Customer_name_new', Contact='$Contact_new', Email='$Email_new', Address='$Address_new' WHERE id='$id'";
    $res = mysqli_query($conn, $q);

    if ($res) {
        $_SESSION['order_food'] = "<h4 class='success'>Order updated successfully.</h4>";
        header("location:manage-order.php");
        exit();
    } else {
        $_SESSION['order_food'] = "<h4 class='error'>Failed to update order. Please try again.</h4>";
        header("location:manage-order.php");
        exit();
    }
}
?>