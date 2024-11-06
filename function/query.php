<?php

require_once('../../config/database.php');

function saveKeranjang($data)
{
    $conn = connection();

    $idTransaksi = $data['id_transaksi'];
    $kodeBarang = $data['kode_barang'];

    $queryBarang = "SELECT * FROM barang WHERE kode_barang = '$kodeBarang'";
    $resultBarang = mysqli_query($conn, $queryBarang);

    $barang = mysqli_fetch_array($resultBarang);
    $harga = $barang['harga'];

    $keranjang = "SELECT * FROM keranjang WHERE kode_barang = '$kodeBarang' AND id_transaksi = '$idTransaksi'";
    $resultKeranjang = mysqli_query($conn, $keranjang);
    $dataKeranjang = mysqli_fetch_array($resultKeranjang);

    if ($dataKeranjang) {
        if ($barang['stock'] <= 0) {
            return false;
        } else {
            $query = "UPDATE keranjang SET qty = qty + 1, total = total + $harga WHERE id_transaksi = '$idTransaksi' AND kode_barang = '$kodeBarang'";
            $result = mysqli_query($conn, $query);

            $queryUpdateBarang = "UPDATE barang SET stock = stock - 1 WHERE kode_barang = '$kodeBarang'";
            $resultUpdateBarang = mysqli_query($conn, $queryUpdateBarang);
        }
    } else {
        if ($barang['stock'] <= 0) {
            return false;
        } else {
            $query = "INSERT INTO keranjang (id_transaksi, kode_barang, qty, total) VALUES ('$idTransaksi', '$kodeBarang', 1, '$harga')";
            $result = mysqli_query($conn, $query);

            $queryUpdateBarang = "UPDATE barang SET stock = stock - 1 WHERE kode_barang = '$kodeBarang'";
            $resultUpdateBarang = mysqli_query($conn, $queryUpdateBarang);
        }
    }

    if ($result) {
        return true;
    } else {
        return false;
    }
}

function updateKeranjag($data)
{

    $conn = connection();

    $id = $data['id'];
    $qty = $data['qty'];

    $query = "SELECT * FROM keranjang WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $dataKeranjang = mysqli_fetch_array($result);
    $kodeBarang = $dataKeranjang['kode_barang'];

    $barang = "SELECT * FROM barang WHERE kode_barang = '$kodeBarang'";
    $resultBarang = mysqli_query($conn, $barang);
    $dataBarang = mysqli_fetch_array($resultBarang);

    $harga = $dataBarang['harga'];
    $totalQty = $dataKeranjang['qty'] + $qty;

    if ($dataBarang['stock'] < $totalQty) {
        return false;
    } else {
        $query = "UPDATE keranjang SET qty = '$totalQty', total = '$totalQty' * '$harga' WHERE kode_barang = '$kodeBarang' AND id = '$id'";
        $result = mysqli_query($conn, $query);

        $queryUpdateBarang = "UPDATE barang SET stock = stock - $qty WHERE kode_barang = '$kodeBarang'";
        $resultUpdateBarang = mysqli_query($conn, $queryUpdateBarang);
    }

    if ($result) {
        return true;
    } else {
        return false;
    }
}

function deleteKeranjang($id)
{

    $conn = connection();

    $queryGetKeranjang = "SELECT * FROM keranjang WHERE id = '$id'";
    $resultGetKeranjang = mysqli_query($conn, $queryGetKeranjang);
    $dataKeranjang = mysqli_fetch_array($resultGetKeranjang);

    $kodeBarang = $dataKeranjang['kode_barang'];
    $qty = $dataKeranjang['qty'];

    $queryUpdateBarang = "UPDATE barang SET stock = stock + $qty WHERE kode_barang = '$kodeBarang'";
    $resultUpdateBarang = mysqli_query($conn, $queryUpdateBarang);

    $query = "DELETE FROM keranjang WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

function updateStock($kodeBarang, $qty)
{

    $conn = connection();

    $query = "UPDATE barang SET stock = stock - '$qty' WHERE kode_barang = '$kodeBarang'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        return true;
    } else {
        return false;
    }
}

function saveTransaksi($data)
{
    $conn = connection();

    $id_transaksi = $data['id_transaksi'];
    $total = $_POST['total'];
    $totalBayar = $_POST['bayar'];

    $keranjang = "SELECT * FROM keranjang WHERE id_transaksi = '$id_transaksi'";
    $resultKeranjang = mysqli_query($conn, $keranjang);

    $query = "INSERT INTO headtrans (id_transaksi, total, tanggal_transaksi, total_bayar) VALUES ('$id_transaksi', $total, now(), '$totalBayar')";
    $result = mysqli_query($conn, $query);

    foreach ($resultKeranjang as $key => $value) {
        $idTransaksi = $value['id_transaksi'];
        $qty = $value['qty'];
        $kodeBarang = $value['kode_barang'];
        $subTotal = $value['total'];

        $queryDetail = "INSERT INTO detailtrans (id_transaksi, kode_barang, qty, total) VALUES ('$idTransaksi', '$kodeBarang', '$qty', '$subTotal')";
        $resultDetail = mysqli_query($conn, $queryDetail);

        if ($resultDetail) {
            updateStock($kodeBarang, $qty);
            deleteKeranjang($value['id']);
        }
    }

    if ($result && $resultDetail) {
        return true;
    } else {
        return false;
    }
}
