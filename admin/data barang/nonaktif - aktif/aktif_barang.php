<?php
include '../../../koneksi/koneksi.php';

$id = $_GET['id'];

// $stok_terakhir = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT stock FROM barang_masuk WHERE id_barang = '$id' ORDER BY id_masuk DESC LIMIT 1"));
// if ($stok_terakhir) {
//     $stok_barang = $stok_terakhir['stock'];
// } else {
//     // Jika tidak ada data di tabel barang_masuk, Anda juga dapat menggunakan tabel barang_keluar
//     $stok_terakhir = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT stock FROM barang_keluar WHERE id_barang = '$id' ORDER BY id_keluar DESC LIMIT 1"));
//     if ($stok_terakhir) {
//         $stok_barang = $stok_terakhir['stock'];
//     } else {
//         // Jika tidak ada data di tabel barang_masuk dan barang_keluar, set stok_barang ke 0
//         $stok_barang = 0;
//     }
// }

// $result2 = mysqli_query($koneksi, "UPDATE data_barang SET stock_barang = $stok_barang WHERE id_barang = '$id'");

$cek_stok = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT stock_barang FROM data_barang WHERE id_barang = '$id'"));
if ($cek_stok['stock_barang'] > 0) {
    $status = 'Tersedia';
} else {
    $status = 'Tidak Tersedia';
}

$result3 = mysqli_query($koneksi, "UPDATE data_barang SET status_barang = '$status' WHERE id_barang = '$id'");

if ($result3) {
    header("Location: ../data_barang.php");
    exit();
} else {
    echo 'Error: Failed to update status - ' . mysqli_error($koneksi);
}
?>
