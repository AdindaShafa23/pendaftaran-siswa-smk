<?php
require('fpdf186/fpdf.php');
include("config.php");

// Buat objek FPDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Header PDF
$pdf->Cell(0, 10, 'Daftar Siswa SMK Coding', 0, 1, 'C');
$pdf->Ln(5);

// Header Tabel
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(10, 10, 'ID', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nama', 1, 0, 'C');
$pdf->Cell(40, 10, 'Alamat', 1, 0, 'C');
$pdf->Cell(30, 10, 'Jenis Kelamin', 1, 0, 'C');
$pdf->Cell(30, 10, 'Agama', 1, 0, 'C');
$pdf->Cell(30, 10, 'Sekolah Asal', 1, 1, 'C');

// Isi Tabel
$pdf->SetFont('Arial', '', 7);

$sql = "SELECT * FROM calon_siswa";
$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10, 10, $row['id'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['nama'], 1, 0, 'L');
    $pdf->Cell(40, 10, $row['alamat'], 1, 0, 'L');
    $pdf->Cell(30, 10, $row['jenis_kelamin'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['agama'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['sekolah_asal'], 1, 1, 'C');
}

// Output PDF
$pdf->Output('D', 'Siswa.pdf'); // 'D' untuk langsung unduh
