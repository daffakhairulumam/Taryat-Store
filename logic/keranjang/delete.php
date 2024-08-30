<?php

include('../../function/query.php');

$id = $_POST['id'];
$qty = $_POST['qty'];

$data = [
    'id' => $id,
    'qty' => $qty
];

if (deleteKeranjang($data)) {
    header("location: ../../index.php?page=transaksi");
} else {
    header("location: ../../index.php?page=transaksi&alert=gagal");
}
