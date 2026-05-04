<?php
session_start();
include '../../../koneksi/koneksi.php';

$total = $_SESSION['total'];
date_default_timezone_set("Asia/Jakarta");
$tanggal = date("y-m-d");
$distributor = $_SESSION['distributor'];
$barang = $_SESSION['nama_barang'];
$stock = $_SESSION['stock'];

$status_barang = ($stock > 0) ? 'Tersedia' : 'Tidak Tersedia';

$sql = mysqli_query($koneksi, "INSERT INTO barang_masuk (id_masuk, tgl_masuk, harga) VALUES (null, '$tanggal', $total)");

if ($sql) {
    $id_masuk = mysqli_insert_id($koneksi); // Mendapatkan ID masuk yang baru saja di-generate

    $awal = $_SESSION['isi'];
    $a = 1;
    while ($a <= $awal) {
        $iddistributor = @$_SESSION['akhir'][$a][5];
        $idbarang = @$_SESSION['akhir'][$a][4];
        $jumlah = @$_SESSION['akhir'][$a][2];
        $sub = @$_SESSION['akhir'][$a][3];
        $idkondisi = 1;
        if ($idbarang != "" && $jumlah != "") {
            $query2 = mysqli_query($koneksi, "INSERT INTO detail_barang_masuk VALUES('', '$id_masuk', '$iddistributor', '$idbarang', '$idkondisi', '$jumlah', '$sub')");
        }
        $a++;
    }

    // Mengupdate status barang
    if ($stock > 0) {
        $updateStatus = mysqli_query($koneksi, "UPDATE data_barang SET status_barang = 'Tersedia' WHERE nama_barang = '$barang'");
    } else {
        $updateStatus = mysqli_query($koneksi, "UPDATE data_barang SET status_barang = 'Tidak Tersedia' WHERE nama_barang = '$barang'");
    }

    if ($updateStatus) {
        echo "<script type='text/javascript'>alert('Data berhasil disimpan')</script>";
        echo "<script> document.location.href='../../data barang/data_barang.php?page=1';</script>";
        unset($_SESSION['isi']);
        unset($_SESSION['id_masuk']);
    } else {
        echo 'Error: Failed to update status - ' . mysqli_error($koneksi);
    }
} else {
    echo 'Error: Failed to insert data - ' . mysqli_error($koneksi);
}
