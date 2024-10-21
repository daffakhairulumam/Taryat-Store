<?php

session_start();
include('../../config/database.php');

if (isset($_POST['submit'])) {
    $conn = connection();

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) == 1) {

        if ($data['password'] == $password) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['hak'] = $data['hak'];

            header("location: ../../index.php");
        } else {
            echo "<script>alert('Password tidak sesuai')</script>";
            header("location: ../../pages/auth/login.php?error=Password tidak sesuai");
        }
    } else {
        echo "<script>alert('Akun tidak ditemukan')</script>";
        header("location: ../../pages/auth/login.php?error=Akun tidak ditemukan");
    }
}
