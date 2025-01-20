<?php

require 'config/database.php';

function genereteCodeKategori()
{
    $conn = connection();
    $query = "SELECT max(kode_kategori) as kode FROM kategori";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);
    $codeCategory = $data['kode'];

    $noUrut = (int) substr($codeCategory, 3, 3);
    $noUrut++;

    $char = "KTG";
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

function genereteCodeBarang()
{
    $conn = connection();
    $query = "SELECT max(kode_barang) as kode FROM barang";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);
    $codeBarang = $data['kode'];

    $noUrut = (int) substr($codeBarang, 3, 3);
    $noUrut++;

    $char = "BRG";
    $newID = $char . sprintf("%03s", $noUrut);

    return $newID;
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

function genereteCodeTransaksi()
{
    $conn = connection();
    $query = "SELECT max(id_transaksi) as kode FROM headtrans";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);
    $codeTransaksi = $data['kode'];

    $noUrut = (int) substr($codeTransaksi, 3, 3);
    $noUrut++;

    $char = "TRX";
    $newID = $char . sprintf("%03s", $noUrut);

    return $newID;
}

function getKeranjang($idTransaksi, $kodeBarang = null)
{
    $conn = connection();

    if ($kodeBarang) {
        $query = "SELECT * FROM keranjang JOIN barang ON keranjang.kode_barang = barang.kode_barang WHERE keranjang.kode_barang = '$kodeBarang' AND keranjang.id_transaksi = '$idTransaksi'";
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
