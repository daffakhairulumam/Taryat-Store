<?php

include('../../function/query.php');

$id = $_GET['id'];

if (deleteKeranjang($id)) {
    header("location: ../../index.php?page=transaksi&alert=berhasil_hapus");
} else {
    header("location: ../../index.php?page=transaksi&alert=gagal_hapus");
}
