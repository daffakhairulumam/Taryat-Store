<?php

include('../../function/query.php');

$id = $_GET['id'];

if (deleteKeranjang($id)) {
    header("location: ../../index.php?page=transaksi");
} else {
    header("location: ../../index.php?page=transaksi&alert=gagal");
}
