<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location:index.php');
}
if (isset($_SESSION['level'])) {
    $level = $_SESSION['level'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="
background-image: url(images/bg2.jpg);
background-size: cover;
">
<div id="wraper-login">
    <div class="login" style="background-color: rgba(232,232,232,0.9);">
        <img class="logo" src="images/logo.png" alt="logo">
        <h1 style="text-align: center; margin:0 0 5px 0;">PROGRAM<br>TOKO BUKU</h1>
        <hr>
        <form action="proses/proses-login.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <input type="submit" name="submit">
            </div>
        </form>
    </div>
</div>
</body>
</html>