<?php

include_once('../../config/database.php');

$conn = connection();

$id = $_POST['id'];
$kode_kategori = $_POST['kode_kategori'];
$kode_barang = $_POST['kode_barang'];
$namaBarang = $_POST['nama_barang'];
$harga = $_POST['harga'];
$stock = $_POST['stock'];

//upload gambar 

$rand = rand();
$ekstensi = array('jpg', 'jpeg', 'png');
$filename = $_FILES['image']['name'];
$ukuran = $_FILES['image']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array($ext, $ekstensi)) {
    header("location: ../../index.php?page=barang/edit&id=$id&alert=gagal_ekstensi");
} else {
    if ($ukuran < 1044070) {
        $xx = $rand . '_' . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], '../../public/img/product/' . $xx);

        $sql = "UPDATE barang SET kode_kategori = '$kode_kategori', kode_barang = '$kode_barang', nama_barang = '$namaBarang', stock = '$stock', harga = '$harga', images = '$xx' WHERE id = '$id'";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../../index.php?page=barang&alert=berhasil_update");
        } else {
            header("location: ../../index.php?page=barang/edit&id=$id&alert=gagal");
        }
    } else {
        header("Location: ../../index.php?page=barang/edit&id=$id&alert=gagal_ukuran");
    }
}
