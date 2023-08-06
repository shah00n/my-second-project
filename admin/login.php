
<?php
require('../config/constants.php');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // قم بكتابة الاستعلام SQL للتحقق من صحة اسم المستخدم وكلمة المرور والمقارنة بقيم المستخدمين المخزنة في قاعدة البيانات
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $_SESSION['index'] = $username;
        header("Location:index.php");
    } else {
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: login.php");
    }
}
?>
<html>
<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>
        <br><br>
        <!-- Login Form Starts Here -->
        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
        <!-- Login Form Ends Here -->
    </div>
    <div class="footer">
        <div class="wrapper">
            <p class="text-center">2021 All rights reserved, Food House</p>
        </div>
    </div>
    <!-- Footer Section Ends -->
</body>
</html>