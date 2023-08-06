<?php
require('../config/constants.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q = "SELECT * FROM admin where id ='$id'";
    $res = mysqli_query($conn, $q);

    if ($res && $res->num_rows == 1) {
        $admin = mysqli_fetch_row($res);
        $old_password = $admin[3];
    } else {
        header("location:manage-admin.php");
    }
} else {
    header("location:manage-admin.php");
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
            <h1>Change Password</h1>
            <br><br>


            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <input type="password" name="current_password" placeholder="Current Password">
                        </td>
                    </tr>

                    <tr>
                        <td>New Password:</td>
                        <td>
                            <input type="password" name="new_password" placeholder="New Password">
                        </td>
                    </tr>

                    <tr>
                        <td>Confirm Password:</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
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
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($current_password == $old_password) {
        if ($new_password == $confirm_password) {
            $q = "UPDATE admin set password= '$new_password' where id='$id'";
            $res = mysqli_query($conn, $q);
            if ($res) {
                $_SESSION['admin'] = "<h4 class='success'>password updateed</h4>";
                header("location:manage-admin.php");
            } else {
                $_SESSION['admin'] = "<h4 class='error'>password not updateed</h4>";
                header("location:manage-admin.php");
            }
        } else {
            echo "no match passwords";
        }
    } else {
        echo "no match passwords";
    }
}
?>