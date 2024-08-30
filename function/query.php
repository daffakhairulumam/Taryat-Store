<?php

require_once '../config/database.php';
function genereteCodeBarang()
{
    $conn = connection();
    $query = "SELECT max(kode_barang) as kode FROM barang";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);
    $codeTrans = $data['kode'];

    $noUrut = (int) substr($codeTrans, 3, 3);
    $noUrut++;

    $char = "BRG";
    $newID = $char . sprintf("%03s", $noUrut);

    return $newID;
}

function getCategory($id = null)
{

    $conn = connection();

    if ($id) {
        $query = "SELECT * FROM kategori WHERE id = '$id'";
    } else {
        $query = "SELECT * FROM kategori";
    }

    $result = mysqli_query($conn, $query);

    return $result;
}

function getBarang($id = null)
{
    $conn = connection();

    if ($id) {
        $query = "SELECT barang.*, kategori.kode_kategori, kategori.nama_kategori FROM barang JOIN kategori ON barang.kode_kategori = kategori.kode_kategori WHERE barang.id = '$id'";
    } else {
        $query = "SELECT barang.*, kategori.kode_kategori, kategori.nama_kategori FROM barang JOIN kategori ON barang.kode_kategori = kategori.kode_kategori";
    }

    $result = mysqli_query($conn, $query);

    return $result;
}

function genereteCodeKategori()
{
    $conn = mysqli_connect("localhost", "root", "", "taryat_store");
    $query = "SELECT max(kode_kategori) as kode FROM kategori";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);
    $codeTrans = $data['kode'];

    $noUrut = (int) substr($codeTrans, 3, 3);
    $noUrut++;

    $char = "KTG";
    $newID = $char . sprintf("%03s", $noUrut);

    return $newID;
}

function genereteCodeTransaksi()
{
    $conn = connection();
    $query = "SELECT max(id_transaksi) as kode FROM headtrans";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);
    $codeTrans = $data['kode'];

    $noUrut = (int) substr($codeTrans, 3, 3);
    $noUrut++;

    $char = "TRX";
    $newID = $char . sprintf("%03s", $noUrut);

    return $newID;
}

function saveKeranjang()
{
    $conn = connection();

    $idTransaksi = $_POST['id_transaksi'];
    $kodeBarang = $_POST['kode_barang'];

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
            $query = "INSERT INTO keranjang (id_transaksi, kode_barang, nama_barang, qty, total) VALUES ('$idTransaksi', '$kodeBarang', 1, '$harga')";
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

    $barang = "SELECT * FROM barang WHERE kode_baran = '$kodeBarang'";
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

    $query = "DELETE FROM barang WHERE id = '$id'";
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

    $query = "UPDATE barang SET stock - '$qty' WHERE kode_barang = '$kodeBarang'";
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

    $idTransaksi = $data['id_transaksi'];
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $kembalian = $_POST['kembalian'];

    $keranjang = "SELECT * FROM keranjang WHERE id_transaksi = '$idTransaksi'";
    $resultKeranjang = mysqli_query($conn, $keranjang);

    $query = "INSERT INTO headtrans (id_transaksi, tanggal_transaksi, total, bayar, kembalian) VALUES ('$idTransaksi', 'now(), '$total', '$bayar', '$kembalian')";
    $result = mysqli_query($conn, $query);

    foreach ($resultKeranjang as $key => $value) {
        $idTransaksi = $value['id_transaksi'];
        $qty = $value['qty'];
        $kodeBarang = $value['kode_barang'];
        $subTotal = $value['total'];

        $queryDetail = "INSERT INTO detailtrans (id_transaksi, kode_barang, qty, subtotal) VALUES ('$idTransaksi', '$kodeBarang', '$qty', '$subTotal')";
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

function getKeranjang($idTransaksi, $kodeBarang = null)
{
    $conn = connection();

    if ($kodeBarang) {
        $query = "SELECT * FROM keranjang JOIN barang ON keranjang.kode_barang, = barang.kode_barang WHERE keranjang.kode_barang = '$kodeBarang' AND keranjang.id_transaksi = '$idTransaksi'";
    } else {
        $query = "SELECT keranjang.*, barang.nama_barang, barang.harga, barang.images FROM keranjang JOIN barang ON keranjang.kode_barang = barang.kode_barang WHERE keranjang.id_transaksi = '$idTransaksi'";
    }
    $result = mysqli_query($conn, $query);

    return $result;
}

function getTransaksi($idTransaksi = null)
{

    $conn = connection();

    if ($idTransaksi) {
        $query = "SELECT detailtrans.*, barang.nama_barang, barang.harga, kategori.nama_kategori, headtrans.total as total_transaksi, headtrans.total_bayar FROM detailtrans JOIN headtrans ON detailtrans.id_transaksi = headtrans.id_transaksi JOIN barang ON detailtrans.kode_barang = barang.kode_barang JOIN kategori ON barang.kode_kategori = kategori.kode_kategori WHERE detailtrans.id_transaksi = '$idTransaksi' ORDER BY detailtrans.kode_barang ASC";
    } else {
        $query = "SELECT * FROM headtrans";
    }

    $result = mysqli_query($conn, $query);

    return $result;
}
