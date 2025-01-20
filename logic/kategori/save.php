<?php

include_once('../../config/database.php');

$conn = connection();

$id = $_POST['id'];
$kodeKategori = $_POST['kode_kategori'];
$nama_kategori = $_POST['nama_kategori'];

$sql = "INSERT INTO kategori (id, kode_kategori, nama_kategori) VALUES ('$id', '$kodeKategori', '$nama_kategori')";

$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: ../../index.php?page=kategori&alert=berhasil");
} else {
    header("Location: ../../index.php?page=kategori&alert=gagal");
}
