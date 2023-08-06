<?php 
session_start();
$conn=mysqli_connect('localhost','root','','order_food');

if(!$conn){
    die("no.connection".mysqli_connect_errno($conn));
}


?>