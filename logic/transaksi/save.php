<?php

include('../../function/query.php');

$id_transaksi = $_POST['id_transaksi'];
$total = $_POST['total'];
$bayar = $_POST['bayar'];

$data = [
    'id_transaksi' => $id_transaksi,
    'total' => $total,
    'bayar' => $bayar
];

if (saveTransaksi($data)) {
    header("location: ../../index.php?page=transaksi&alert=berhasil_transaksi&id_transaksi = $id_transaksi");
} else {
    header("location:../../index.php?page=transaksi&alert=gagal_transaksi");
}
