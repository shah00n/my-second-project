<?php
require('../config/constants.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q = "DELETE from food where id =$id";
    $res = mysqli_query($conn, $q);

    if ($res) {
        $_SESSION['food'] = "<h4 class='success'>food deleted</h4>";
        header("location:manage-food.php");
    } else {
        $_SESSION['food'] = "<h4 class='error'>food not deleted</h4>";
        header("location:manage-food.php");
    }
} else {
    header("location:manage-food.php");
}
