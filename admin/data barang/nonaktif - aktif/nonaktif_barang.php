<?php
include '../../../koneksi/koneksi.php';

$id = $_GET['id'];

$result = mysqli_query($koneksi, "UPDATE data_barang SET status_barang = 'NONAKTIF' WHERE id_barang = '$id'");

if ($result) {
    header("Location: ../data_barang.php");
    exit();
} else {
    echo 'Error: Failed to update status - ' . mysqli_error($koneksi);
}
?>
