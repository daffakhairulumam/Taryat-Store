<?php

include_once('../../config/database.php');

$conn = connection();

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("location: ../../index.php?page=users&alert=berhasil_hapus");
} else {
    header("location: ../../index.php?page=users/&alert=gagal_hapus");
}
