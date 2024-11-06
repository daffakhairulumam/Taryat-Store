<?php

include_once('../../config/database.php');

$conn = connection();

$id = $_POST['id'];
$nama = $_POST['nama'];
$user = $_POST['username'];
$pass = md5($_POST['password']);
$hak = $_POST['hak'];

$sql = "UPDATE users SET nama = '$nama', username = '$user', password = '$pass',  hak = '$hak' WHERE id = '$id'";

if (mysqli_query($conn, $sql)) {
    header("location: ../../index.php?page=users&alert=berhasil_update");
} else {
    header("location: ../../index.php?page=users/edit&id=$id&alert=gagal");
}
