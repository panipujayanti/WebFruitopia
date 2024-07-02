<?php
session_start();
require 'koneksi.php';

// Jika sudah login, redirect ke halaman utama
if (isset($_SESSION['log'])) {
    header('location:index.php');
    exit;
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cekdatabase = mysqli_query($koneksi, "SELECT * FROM login WHERE email='$email' AND password='$password'");

    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        $_SESSION['log'] = 'True';
        header('location:index.php');
    } else {
        header('location:login.php');
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <img src="img/login.png.jpg" alt="FRUITOPIA Logo" class="logo">
            <form method="post">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>