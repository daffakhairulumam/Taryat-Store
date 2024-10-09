<?php

include('../../config/database.php');

$conn = connection();

$id = $_GET['id'];

$sql = "DELETE FROM barang WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: ../../index.php?page=barang&alert=berhasil_hapus");
} else {
    header("location: ../../index.php?page=barang&alert=gagal_hapus");
}
