<?php

include_once('../../config/database.php');

$conn = connection();

$kodeKategori = $_POST['kode_kategori'];
$kodeBarang = $_POST['kode_barang'];
$namaBarang = $_POST['nama_barang'];
$stock = $_POST['stock'];
$harga = $_POST['harga'];

//upload gambar 

$rand = rand();
$ekstensi = array('jpg', 'jpeg', 'png');
$filename = $_FILES['image']['name'];
$ukuran = $_FILES['image']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array($ext, $ekstensi)) {
    header("Location: ../../index.php?page=barang/create");
} else {
    if ($ukuran < 1044070) {
        $xx = $rand . '_' . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], '../../public/img/product/' . $xx);

        $sql = "INSERT INTO barang (kode_kategori, kode_barang, nama_barang, stock, harga, images) VALUES ('$kodeKategori', '$kodeBarang', '$namaBarang', '$stock', '$harga', '$xx')";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../../index.php?page=barang");
        } else {
            echo "Error" . "<br>" . mysqli_error($conn);
        }
    } else {
        header("Location: ../../index.php?page=barang/create");
    }
}
