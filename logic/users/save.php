<?php

include_once('../../config/database.php');

$conn = connection();

$id = $_POST['id'];
$nama = $_POST['nama'];
$user = $_POST['username'];
$pass = md5($_POST['password']);
$hak = $_POST['hak'];

$sql = "INSERT INTO users (id,  nama, username, password, hak) VALUES ('$id', '$nama', '$user', '$pass', '$hak')";


if (mysqli_query($conn, $sql)) {
    header("Location: ../../index.php?page=users&alert=berhasil");
} else {
    header("Location: ../../index.php?page=users/create&alert=gagal");
}
