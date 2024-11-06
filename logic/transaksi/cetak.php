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

$pdf = new FPDF('P', 'mm', array(80, 150));
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 3, 'Taryat Store', 0, 1, 'C');

$pdf->SetFont('Arial', '', 5);
$pdf->Cell(0, 3, 'Jl. Ciseupan, Cibeber, Kec. Cimahi Sel., Kota Cimahi', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(0, 3, 'Id Transaksi : ' . $dataTransaksi['id_transaksi'], 0, 1, 'L');
$pdf->Cell(0, 3, 'Tanggal Transaksi : ' . $dataTransaksi['tanggal_transaksi'], 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(10, 3, 'No.', 0, 0, 'C');
$pdf->Cell(13, 3, 'Nama', 0, 0, 'C');
$pdf->Cell(13, 3, 'Harga', 0, 0, 'C');
$pdf->Cell(13, 3, 'Qty', 0, 0, 'C');
$pdf->Cell(13, 3, 'Sub Total', 0, 1, 'C');

$pdf->SetFont('Arial', '', 5);

$no = 1;
foreach ($data as $key => $value) {
    $pdf->Cell(10, 3, $no, 0, 0, 'C');
    $pdf->Cell(13, 3, $value['nama_barang'], 0, 0, 'C');
    $pdf->Cell(13, 3, $value['harga'], 0, 0, 'C');
    $pdf->Cell(13, 3, $value['qty'], 0, 0, 'C');
    $pdf->Cell(13, 3, $value['total'], 0, 1, 'C');
    $no++;
}

$pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(0, 3, 'Total: ' . $value['total_transaksi'], 0, 1, 'R');
$pdf->Cell(0, 3, 'Total Bayar: ' . $value['total_bayar'], 0, 1, 'R');
$pdf->Cell(0, 3, 'Kembalian: ' . $value['total_bayar'] - $value['total_transaksi'], 0, 1, 'R');

$pdf->SetFont('Arial', '', 5);
$pdf->Cell(0, 3, 'Dicetak Oleh : ' . 'Daffa Khairul Umam', 0, 1, 'C');
$pdf->Cell(0, 3, 'Telp : ' . '088229374948', 0, 1, 'C');

$pdf->output();
