<?php

include_once('../../config/database.php');

$conn = connection();

$id = $_POST['id'];
$kodeKategori = $_POST['kode_kategori'];
$nama_kategori = $_POST['nama_kategori'];

$sql = "UPDATE kategori SET kode_kategori = '$kodeKategori', nama_kategori = '$nama_kategori' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: ../../index.php?page=kategori&alert=berhasil update");
} else {
    header("Location: ../../index.php?page=kategori/edit&id=$id&alert=gagal");
}
