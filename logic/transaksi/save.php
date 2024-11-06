<?php

include('../../function/query.php');

$idTransaksi = $_POST['id_transaksi'];
$total = $_POST['total'];
$bayar = $_POST['bayar'];

$data = [
    'id_transaksi' => $idTransaksi,
    'total' => $total,
    'bayar' => $bayar
];

if (saveTransaksi($data)) {
    header("location: ../../index.php?page=transaksi&alert=berhasil_transaksi&id_transaksi=$idTransaksi");
} else {
    header("location:../../index.php?page=transaksi&alert=gagal_transaksi");
}
