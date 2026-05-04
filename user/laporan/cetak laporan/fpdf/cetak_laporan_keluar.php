<?php

session_start();
if (isset($_SESSION['bulan'])) {
    include '../../../../koneksi/koneksi.php';
}
include '../../../../koneksi/koneksi.php';
$id = $_SESSION['username'];
$query = mysqli_query($koneksi, "SELECT nama FROM biodata WHERE username = '$id'");
$data = mysqli_fetch_array($query);

$name = $data['nama'];

$id = $_GET['bulan'];
$bulan = date("F", mktime(0, 0, 0, $id, 1));
$bulan_kapital = strtoupper($bulan);


$days = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
);

$months = array(
    'Jan' => 'Januari',
    'Feb' => 'Februari',
    'Mar' => 'Maret',
    'Apr' => 'April',
    'May' => 'Mei',
    'Jun' => 'Juni',
    'Jul' => 'Juli',
    'Aug' => 'Agustus',
    'Sep' => 'September',
    'Oct' => 'Oktober',
    'Nov' => 'November',
    'Dec' => 'Desember'
);

date_default_timezone_set("Asia/Jakarta");
$date = new DateTime("Asia/Jakarta");
$month = $date->format("M");
$day = $date->format("D");

?>





<?php

require('fpdf181/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', array(210, 297));
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 10);
// mencetak string 
$pdf->Cell(270, 7, 'LAPORAN BARANG KELUAR BULAN ' . $bulan_kapital, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10, 'C');
$pdf->Cell(270, 7, 'DAFTAR LAPORAN', 0, 1, 'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetFillColor(0, 119, 182);
$pdf->SetTextColor(225);
$pdf->Cell(7, 6, 'NO', 1, 0, 'C', true);
$pdf->Cell(25, 6, 'KODE BARANG', 1, 0, 'C', true);
$pdf->Cell(25, 6, 'TANGGAL', 1, 0, 'C', true);
$pdf->Cell(30, 6, 'WAKTU MASUK', 1, 0, 'C', true);
$pdf->Cell(50, 6, 'NAMA BARANG', 1, 0, 'C', true);
$pdf->Cell(40, 6, 'DISTRIBUTOR', 1, 0, 'C', true);
$pdf->Cell(10, 6, 'QTY', 1, 0, 'C', true);
$pdf->Cell(25, 6, 'KONDISI', 1, 0, 'C', true);
$pdf->Cell(40, 6, 'HARGA PERBARANG', 1, 0, 'C', true);
$pdf->Cell(30, 6, 'SUBTOTAL', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);

include '../../../../koneksi/koneksi.php';
//$id = $_GET['id'];
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
if (isset($_POST["Cari2"])) {
    $cari2 = $_POST['cari_makanan'];


    // $sql = "SELECT * FROM masakan where nama_masakan_hamidah='$cari2'";
    // $masakan = mysqli_query($conn, $sql);

}
$laporan_masuk = mysqli_query($koneksi, "SELECT * FROM `barang_keluar` 
INNER JOIN detail_barang_keluar ON barang_keluar.id_keluar = detail_barang_keluar.id_keluar 
INNER JOIN data_barang ON detail_barang_keluar.id_barang = data_barang.id_barang
INNER JOIN data_distributor ON detail_barang_keluar.id_distributor = data_distributor.id_distributor
INNER JOIN kondisi_barang ON detail_barang_keluar.id_kondisi = kondisi_barang.id_kondisi
WHERE YEAR (barang_keluar.tgl_keluar) = '$tahun' AND MONTH (barang_keluar.tgl_keluar) = '$bulan' ");

$sub = mysqli_query($koneksi, "SELECT SUM(data_barang.harga_barang * detail_barang_keluar.jumlah) AS subtotal FROM `barang_keluar` 
                            INNER JOIN detail_barang_keluar ON barang_keluar.id_keluar = detail_barang_keluar.id_keluar 
                            INNER JOIN data_barang ON detail_barang_keluar.id_barang = data_barang.id_barang
                            INNER JOIN data_distributor ON detail_barang_keluar.id_distributor = data_distributor.id_distributor
                            INNER JOIN kondisi_barang ON detail_barang_keluar.id_kondisi = kondisi_barang.id_kondisi
                            WHERE YEAR (barang_keluar.tgl_keluar) = '$tahun' AND MONTH (barang_keluar.tgl_keluar) = '$bulan'");
$subtotal = mysqli_fetch_assoc($sub);
$no = 1;
while ($row = mysqli_fetch_array($laporan_masuk)) {
    $pdf->SetTextColor(0);
    $subtotal_barang = $row['jumlah'] * $row['harga_barang'];
    $pdf->Cell(7, 6, $no++, 1, 0, 'C');
    $pdf->Cell(25, 6, $row['kode_barang'], 1, 0, 'C');
    $pdf->Cell(25, 6, date('d F Y', strtotime($row['tgl_keluar'])), 1, 0, 'C');
    $pdf->Cell(30, 6, date('H:i:s', strtotime($row['tgl_keluar'])), 1, 0, 'C');
    $pdf->Cell(50, 6, $row['nama_barang'], 1, 0, 'C');
    $pdf->Cell(40, 6, $row['nama_distributor'], 1, 0, 'C');
    $pdf->Cell(10, 6, $row['jumlah'], 1, 0, 'C');
    $pdf->Cell(25, 6, $row['kondisi'], 1, 0, 'C');
    $pdf->Cell(40, 6, "Rp." . number_format($row['harga_barang']), 1, 0, 'C');
    $pdf->Cell(30, 6, "Rp." . number_format($subtotal_barang), 1, 0, 'C');
    $pdf->MultiCell(0, 6, '', 0, 0);
}


$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(252, 6, "SUBTOTAL", 1, 0, 'C');
$pdf->SetFillColor(0, 119, 182);
$pdf->SetTextColor(225);
$pdf->Cell(30, 6, "Rp. " . number_format($subtotal['subtotal']), 1, 0, 'C', true);
$pdf->MultiCell(0, 6, '', 0, 0);
$pdf->MultiCell(0, 6, '', 0, 0);
$pdf->MultiCell(0, 6, '', 0, 0);
$pdf->Cell(232, 0, "", 0, 0, 'C');
$pdf->SetTextColor(0);
$pdf->Cell(40, 6, "PENANGGUNG JAWAB", 0, 0, 'C', FALSE);
$pdf->MultiCell(0, 6, '', 0, 0);
$pdf->MultiCell(0, 6, '', 0, 0);

$pdf->Cell(227, 0, "", 0, 0, 'C');
$pdf->Cell(50, 5, $name, 0, 0, 'C', false);
$pdf->MultiCell(0, 6, '', 0, 0);
$pdf->Cell(505, 5, $days[$day] . " " . date("d") . " " .  $months[$month], 0, 0, 'C', false);
$pdf->Output();
