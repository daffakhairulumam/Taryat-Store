<?php

include('../../function/query.php');

$idTransaksi = $_GET['id_transaksi'];
$kodeBarang = $_GET['kode_barang'];

$data = [
    'id_transaksi' => $idTransaksi,
    'kode_barang' => $kodeBarang
];

if (saveKeranjang($data)) {
    header("Location:../../index.php?page=transaksi&alert=berhasil&kode_barang=$kodeBarang");
} else {
    header("Location:../../index.php?page=transaksi&alert=gagal");
}
