<?php

session_start();
if (isset($_SESSION['username'])) {
    include '../../../koneksi/koneksi.php';
} else {
    header('location:../../../index.php');
}

$username = $_SESSION['username'];
$query = mysqli_query($koneksi, "SELECT * FROM biodata where username = '$username'");
$row = mysqli_fetch_array($query);
$name = $row['nama'];
$us = $row['username'];
$photo = $row['foto'];


$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');

if (isset($_GET['page'])) {
    $aktif_page = $_GET['page'];
} else {
    $aktif_page = 1;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/edit.css">
    <link rel="stylesheet" href="../../../assets/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/fontawesome.min.css">
    <title>Detail Laporan Barang Masuk</title>
</head>

<body>
    <div id="content">
        <div class="navbar">

            <div class="back-1">
                <a href="../laporan_barang_masuk.php?page=1">
                    <div class="btn">
                        <div><i class="fa-solid fa-arrow-left"></i></div>
                    </div>

                    <div class="kembali-1">
                        Detail
                    </div>
                </a>
            </div>

            <div class="photo">
                <?php
                $foto =  mysqli_query($koneksi, "SELECT foto FROM biodata where username = '$username'");
                while ($img = mysqli_fetch_array($foto)) { ?>
                    <img src="../../../assets/profile photo/<?= $img['foto'] ?>" alt="photo profile">

                <?php } ?>
            </div>
            <h3><?= $us ?></h3>

            <a href="../../edit profile/edit_profile.php" class="edit_prof">Edit Profile <i class="fa-solid fa-pen"></i></a>
            <hr>
            <div class="nav">

                <div class="data">
                    <ul>
                        <li><a href="../../dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                        <li><a href="../../data barang/data_barang.php?page=1"><i class="fa-solid fa-boxes-stacked"></i> Data Barang</a></li>
                        <li><a href="../../data pegawai/data_pegawai.php?page=1"><i class="fa-solid fa-users"></i> Data Pegawai</a></li>
                        <li><a href="../../data distributor/data_distributor.php?page=1"><i class="fa-solid fa-truck"></i> Data Distributor</a></li>
                        <li><a href="../../barang masuk/barang_masuk.php?page=1"><i class="fa-solid fa-right-to-bracket"></i> Barang Masuk</a></li>
                        <li><a href="../../barang keluar/barang_keluar.php?page=1"><i class="fa-solid fa-right-from-bracket"></i> Barang Keluar</a></li>
                        <li><a href="../../laporan/laporan.php" class="link-active"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
                    </ul>
                    <hr>
                    <span><a href="../../../koneksi/logout.php" onclick="return confirm('Yakin Untuk Keluar Dari Website?')">Log Out</a></span>
                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="container">

            <div class="head">
                <span>Detail Laporan Barang Masuk</span>
            </div>
            <div class="line"></div>




            <div class="isi">
                <div class="text">
                    <div class="text1">
                        <b class="judul-isi"><i class="fa-solid fa-right-to-bracket"></i>&nbsp; Detail Laporan Barang Masuk</b>
                        <a href="../cetak laporan/fpdf/cetak_laporan_masuk.php?tahun=<?= $tahun ?>&bulan=<?= $bulan ?> "><i class="fa-solid fa-print"></i> Cetak Laporan</a>
                    </div>

                </div>
                <div class="isi-barang">
                    <div class="table">
                        <table>
                            <tr>
                                <th>no</th>
                                <th>kode barang</th>
                                <th>tanggal</th>
                                <th>Waktu masuk</th>
                                <th>nama barang</th>
                                <th>distributor</th>
                                <th>QTY</th>
                                <th>kondisi</th>
                                <th>harga perbarang</th>
                                <th>total harga keseluruhan</th>
                            </tr>

                            <?php
                            include '../../../koneksi/koneksi.php';

                            // pagination function
                            $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
                            $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');


                            $data_page = mysqli_query($koneksi, "SELECT * FROM `barang_masuk` 
                            INNER JOIN detail_barang_masuk ON barang_masuk.id_masuk = detail_barang_masuk.id_masuk 
                            INNER JOIN data_barang ON detail_barang_masuk.id_barang = data_barang.id_barang
                            INNER JOIN data_distributor ON detail_barang_masuk.id_distributor = data_distributor.id_distributor
                            INNER JOIN kondisi_barang ON detail_barang_masuk.id_kondisi = kondisi_barang.id_kondisi
                            WHERE YEAR(barang_masuk.tgl_masuk) = '$tahun' AND MONTH(barang_masuk.tgl_masuk) = '$bulan' ");

                            $data_batas = 4;
                            $total_data = mysqli_num_rows($data_page);
                            if ($total_data > 0) {
                                $jumlah_pagination = ceil($total_data / $data_batas);
                            } else {
                                $jumlah_pagination = 1;
                            }


                            if (isset($_GET['page'])) {
                                $aktif_page = $_GET['page'];
                            } else {
                                $aktif_page = 1;
                            }


                            $jumlah_link = 5;
                            if ($aktif_page > $jumlah_link) {
                                $start_number = $aktif_page - $jumlah_link;
                            } else {
                                $start_number = 1;
                            }

                            if ($aktif_page < ($jumlah_pagination -  $jumlah_link)) {
                                $end_number = $aktif_page + $jumlah_link;
                            } else {
                                $end_number = $jumlah_pagination;
                            }

                            $data_awal = ($aktif_page * $data_batas) - $data_batas;


                            $data_halaman = mysqli_query($koneksi, "SELECT * FROM `barang_masuk` 
                            INNER JOIN detail_barang_masuk ON barang_masuk.id_masuk = detail_barang_masuk.id_masuk 
                            INNER JOIN data_barang ON detail_barang_masuk.id_barang = data_barang.id_barang
                            INNER JOIN data_distributor ON detail_barang_masuk.id_distributor = data_distributor.id_distributor
                            INNER JOIN kondisi_barang ON detail_barang_masuk.id_kondisi = kondisi_barang.id_kondisi
                            WHERE YEAR (barang_masuk.tgl_masuk) = '$tahun' AND MONTH (barang_masuk.tgl_masuk) = '$bulan' LIMIT $data_awal,$data_batas");




                            // end pagination function

                            // $tahun = $_GET['tahun'];
                            // $bulan = $_GET['bulan'];

                            // $sql = "SELECT * FROM `barang_masuk` 
                            // INNER JOIN detail_barang_masuk ON barang_masuk.id_masuk = detail_barang_masuk.id_masuk 
                            // INNER JOIN data_barang ON detail_barang_masuk.id_barang = data_barang.id_barang
                            // INNER JOIN data_distributor ON detail_barang_masuk.id_distributor = data_distributor.id_distributor
                            // WHERE YEAR (barang_masuk.tgl_masuk) = '$tahun' AND MONTH (barang_masuk.tgl_masuk) = '$bulan' ";
                            // $result = mysqli_query($koneksi, $sql);


                            $no = 1 + $data_awal;
                            $sub = mysqli_query($koneksi, "SELECT SUM(data_barang.harga_barang * detail_barang_masuk.jumlah) AS subtotal FROM `barang_masuk` 
                            INNER JOIN detail_barang_masuk ON barang_masuk.id_masuk = detail_barang_masuk.id_masuk 
                            INNER JOIN data_barang ON detail_barang_masuk.id_barang = data_barang.id_barang
                            INNER JOIN data_distributor ON detail_barang_masuk.id_distributor = data_distributor.id_distributor
                            INNER JOIN kondisi_barang ON detail_barang_masuk.id_kondisi = kondisi_barang.id_kondisi
                            WHERE YEAR (barang_masuk.tgl_masuk) = '$tahun' AND MONTH (barang_masuk.tgl_masuk) = '$bulan' ");
                            $subtotal = mysqli_fetch_assoc($sub);

                            while ($user_data = mysqli_fetch_array($data_halaman)) {

                                $kode_barang = $user_data['kode_barang'];
                                $nama = $user_data['nama_barang'];
                                $distributor = $user_data['nama_distributor'];
                                $stock = (int)$user_data['jumlah'];
                                $harga = (int)$user_data['harga_barang'];
                                $tanggal = (date('d F Y', strtotime($user_data['tgl_masuk'])));
                                $jam = (date('H:i:s', strtotime($user_data['tgl_masuk'])));
                                $kondisi = $user_data['kondisi'];


                            ?>

                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?= $kode_barang ?></td>
                                    <td><?= $tanggal ?></td>
                                    <td><?= $jam ?></td>
                                    <td><?= $nama ?></td>
                                    <td><?= $distributor ?></td>
                                    <td><?= $stock ?></td>
                                    <td><?= $kondisi ?></td>
                                    <td><?= "Rp. " . number_format($harga) ?></td>
                                    <td><?= "Rp. " . number_format($total_sub = $stock * $harga) ?></td>
                                </tr>

                            <?php
                            }
                            ?>

                            <tr>
                                <td colspan="9">
                                    <h3><b>Subtotal</b></h3>
                                </td>
                                <th><?= "Rp. " . number_format($subtotal['subtotal']) ?></th>
                            </tr>

                        </table>

                        <div class="pagination">
                            <!-- pagenation -->
                            <?php


                            if ($aktif_page > 1) {
                                echo '<a class="prev" href="?tahun=' . $tahun . '&bulan=' . $bulan . '&page=' . ($aktif_page - 1) . '"><i class="fa-solid fa-angle-left" style="color: white;"></i></a>';
                            }

                            for ($i = $start_number; $i <= $end_number; $i++) {

                                if (@$_GET['page'] == $i) {
                                    $active = 'active';
                                } else {
                                    $active = '';
                                }

                                echo '<a class="' . $active . '" href="?tahun=' . $tahun . '&bulan=' . $bulan . '&page=' . $i . '">' . $i . '</a>';
                            }

                            if ($aktif_page >= 1 && $aktif_page < $jumlah_pagination) {
                                echo '<a class="next" href="?tahun=' . $tahun . '&bulan=' . $bulan . '&page=' . ($aktif_page + 1) . '"><i class="fa-solid fa-angle-right" style="color: white;"></i></a>';
                            }
                            ?>
                        </div>
                        <!-- end pagenation -->

                        <!-- END OF CONTENT -->
</body>

</html>