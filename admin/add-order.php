<?php
require('../config/constants.php');

if (isset($_POST['submit'])) {
    $Food = $_POST['Food'];
    $Price = $_POST['Price'];
    $Qty = $_POST['Qty'];
    $Total = $_POST['Total'];
    $Order_date = $_POST['Order_date'];
    $Status_order = $_POST['Status_order'];
    $Customer_name = $_POST['Customer_name'];
    $Contact = $_POST['Contact'];
    $Email = $_POST['Email'];
    $Address = $_POST['Address'];
    $Total = $Price * $Qty;

    $q = "INSERT INTO order_food (Food, Price, Qty, Total, Order_date, Status_order, Customer_name, Contact, Email, Address)
     VALUES ('$Food', '$Price', '$Qty', '$Total', '$Order_date', '$Status_order', '$Customer_name', '$Contact', '$Email', '$Address')";
    $res = mysqli_query($conn, $q);
    if ($res) {
        $_SESSION['order_food'] = "<h4 class='success'>Order added</h4>";
        header("LOCATION: manage-order.php");
    } else {
        $_SESSION['order_food'] = "<h4 class='error'>Order not added</h4>";
        header("LOCATION: manage-order.php");
    }
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
                        <td>
                        <select name="Status_order">
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
                        <td>Price</td>
                        <td>
                            <input type="text" name="Price" value="">
                        </td>
                    </tr>

                    <tr>
                        <td>Qty</td>
                        <td>
                            <input type="number" name="Qty" value="">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name:</td>
                        <td>
                            <input type="text" name="Customer_name" value="">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Contact:</td>
                        <td>
                            <input type="text" name="Contact" value="">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Email:</td>
                        <td>
                            <input type="text" name="Email" value="">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Address:</td>
                        <td>
                            <textarea name="Address" cols="30" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Order Date:</td>
                        <td>
                            <input type="text" name="Order_date" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                        </td>
                    </tr>


                    <tr>
                        <td clospan="2">
                            <input type="hidden" name="">
                            <input type="hidden" name="Total" value="">

                            <input type="submit" name="submit" value="Update Order" class="btn-secondary">
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