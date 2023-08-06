<?php
require('../config/constants.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q = "DELETE from order_food where id =$id";
    $res = mysqli_query($conn, $q);

    if ($res) {
        $_SESSION['order_food'] = "<h4 class='success'>Order deleted</h4>";
        header("location:manage-order.php");
    } else {
        $_SESSION['order_food'] = "<h4 class='error'>Order not deleted</h4>";
        header("location:manage-order.php");
    }
} else {
    header("location:manage-order.php");
}
