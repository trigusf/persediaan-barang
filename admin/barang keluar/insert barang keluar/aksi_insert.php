<?php
session_start();
include '../../../koneksi/koneksi.php';

$total = $_SESSION['total'];
date_default_timezone_set("Asia/Jakarta");
$tanggal = date("y-m-d");
$distributor = $_SESSION['distributor'];
$barang = $_SESSION['nama_barang'];
$stock = $_SESSION['stock'];


$sql = mysqli_query($koneksi, "INSERT INTO barang_keluar VALUES(null, null, $total)");

$query = mysqli_query($koneksi, "SELECT * FROM  barang_keluar order by id_keluar desc limit 0,1");
$barangkeluar = mysqli_fetch_array($query);

$idkeluar = $barangkeluar['id_keluar'];
$awal = @$_SESSION['isi'];
$a = 1;
$barang_tersedia = true;
while ($a <= $awal) {
    @$iddistributor = @$_SESSION['akhir'][$a][5];
    $idbarang = @$_SESSION['akhir'][$a][4];

    // Query untuk mendapatkan nilai stock_barang terbaru
    $result = mysqli_query($koneksi, "SELECT stock_barang FROM data_barang WHERE id_barang = '$idbarang'");
    $row = mysqli_fetch_assoc($result);
    $stock_barang = $row['stock_barang'];
    $status = ($stock_barang >= 1) ? 'Tersedia' : 'Tidak Tersedia';
    $result2 = mysqli_query($koneksi, "UPDATE data_barang SET status_barang = '$status' WHERE id_barang = '$idbarang'");

    // Menentukan status barang yang baru
    $jumlah = @$_SESSION['akhir'][$a][2];
    $sql2 = mysqli_query($koneksi, "SELECT stock_barang FROM data_barang WHERE id_barang = '$idbarang'");
    $row = mysqli_fetch_assoc($sql2);
    $stock = $row['stock_barang'];
    $sub = @$_SESSION['akhir'][$a][3];
    $idkondisi = @$_SESSION['akhir'][$a][7];
    if ($idbarang != "" && $jumlah != "") {
    }
    if ($jumlah <= $stock && $stock > 0) {
        $query2 = mysqli_query($koneksi, "INSERT INTO detail_barang_keluar VALUES('', '$idkeluar', '$iddistributor' , '$idbarang', '$idkondisi', '$jumlah', '$sub')");
    } else {
        $barang_tersedia = false;
        break;
    }
    $a++;
}
if ($barang_tersedia) {
    echo "<script type='text/javascript'>alert('Data berhasil di simpan')</script>";
} else {
    echo "<script type='text/javascript'>alert('Data Gagal Di Simpan, Karena Stock Kosong/Tidak Ada. Periksa Kembali Stock Di Data Barang Atau Hubungi Pihak Distributor.')
        document.location.href='insert_keluar.php';
        </script>";
}
echo "<script> document.location.href='../../data barang/data_barang.php?page=1';</script>";
unset($_SESSION['isi']);
unset($_SESSION['id_keluar']);
    // echo "".mysqli_error();
