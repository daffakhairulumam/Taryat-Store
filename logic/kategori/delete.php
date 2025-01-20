<?php

include_once '../../config/database.php';

$conn = connection();

$id = $_GET['id'];

$sql = "DELETE FROM kategori WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: ../../index.php?page=kategori&alert=berhasil hapus");
} else {
    header("Location:../../index.php?page=kategori&alert=gagal hapus");
}
