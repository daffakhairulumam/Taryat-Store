<?php

require_once('../../library/fpdf.php');
require_once('../../config/database.php');

$conn = connection();

$id_transaksi = $_GET['id_transaksi'];
$query = "SELECT detailtrans.*, barang.nama_barang, barang.harga, kategori.nama_kategori, headtrans.total as total_transaksi, headtrans.total_bayar FROM detailtrans JOIN headtrans ON detailtrans.id_transaksi = headtrans.id_transaksi JOIN barang ON detailtrans.kode_barang = barang.kode_barang JOIN kategori ON barang.kode_kategori = kategori.kode_kategori WHERE detailtrans.id_transaksi = '$id_transaksi' ORDER BY detailtrans.kode_barang ASC";

$data = mysqli_query($conn, $query);

$queryTransaksi = "SELECT * FROM headtrans WHERE id_transaksi = '$id_transaksi'";
$result = mysqli_query($conn, $queryTransaksi);
$dataTransaksi = mysqli_fetch_array($result);

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Detail Laporan Transaksi', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Id Transaksi : ' . $dataTransaksi['id_transaksi'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Tanggal Transaksi : ' . $dataTransaksi['tanggal_transaksi'], 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'No.', 1, 0, 'C');
$pdf->Cell(30, 10, 'Kode Barang', 1, 0, 'C');
$pdf->Cell(30, 10, 'Nama', 1, 0, 'C');
$pdf->Cell(30, 10, 'Kategori', 1, 0, 'C');
$pdf->Cell(30, 10, 'Harga', 1, 0, 'C');
$pdf->Cell(30, 10, 'Qty', 1, 0, 'C');
$pdf->Cell(30, 10, 'Sub Total', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);

$no = 1;
foreach ($data as $key => $value) {
    $pdf->Cell(10, 10, $no, 1, 0, 'C');
    $pdf->Cell(30, 10, $value['kode_barang'], 1, 0, 'C');
    $pdf->Cell(30, 10, $value['nama_barang'], 1, 0, 'C');
    $pdf->Cell(30, 10, $value['nama_kategori'], 1, 0, 'C');
    $pdf->Cell(30, 10, $value['harga'], 1, 0, 'C');
    $pdf->Cell(30, 10, $value['qty'], 1, 0, 'C');
    $pdf->Cell(30, 10, $value['total'], 1, 1, 'C');
    $no++;
}

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Total: ' . $value['total_transaksi'], 0, 1, 'R');
$pdf->Cell(0, 10, 'Total Bayar: ' . $value['total_bayar'], 0, 1, 'R');
$pdf->Cell(0, 10, 'Kembalian: ' . $value['total_bayar'] - $value['total_transaksi'], 0, 1, 'R');

$pdf->Output();
