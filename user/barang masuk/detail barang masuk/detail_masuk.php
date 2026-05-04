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
    <title>Detail Barang Masuk</title>
</head>

<body>
    <div id="content">
        <div class="navbar">

            <div class="back-1">
                <a href="../barang_masuk.php?page=1">
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
                        <li><a href="../../data barang/data_barang.php"><i class="fa-solid fa-boxes-stacked"></i> Data Barang</a></li>
                        <li><a href="../../data pegawai/data_pegawai.php"><i class="fa-solid fa-users"></i> Data Pegawai</a></li>
                        <li><a href="../../data distributor/data_distributor.php"><i class="fa-solid fa-truck"></i> Data Distributor</a></li>
                        <li><a href="../barang_masuk.php" class="link-active"><i class="fa-solid fa-right-to-bracket"></i> Barang Masuk</a></li>
                        <li><a href="../../barang keluar/barang_keluar.php"><i class="fa-solid fa-right-from-bracket"></i> Barang Keluar</a></li>
                        <li><a href="../../laporan/laporan.php"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
                    </ul>
                    <hr>
                    <span><a href="../../koneksi/logout.php" onclick="return confirm('Yakin Untuk Keluar Dari Website?')">Log Out</a></span>
                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="container">

            <div class="head">
                <span>Barang Masuk</span>
            </div>
            <div class="line"></div>




            <div class="isi">
                <div class="text">
                    <div class="text1">
                        <b class="judul-isi"><i class="fa-solid fa-right-to-bracket"></i>&nbsp; Detail Barang Masuk</b>
                        <!-- <a href="insert barang masuk/insert_masuk.php">+ Tambah Data</a> -->
                    </div>
                </div>
                <div class="isi-barang">
                    <div class="table">
                        <table>
                            <tr>
                                <th>no</th>
                                <th>Distributor</th>
                                <th>Nama Barang</th>
                                <th>QTY</th>
                                <th>kondisi</th>
                                <th>Subtotal</th>
                            </tr>

                            <?php
                            include '../../../koneksi/koneksi.php';

                            $id = $_GET['id'];

                            $sql = "SELECT * FROM detail_barang_masuk WHERE id_detail = '$id'";

                            $sql2 = "SELECT
                                               *
                                            FROM
                                                detail_barang_masuk
                                            INNER JOIN data_distributor ON detail_barang_masuk.id_distributor = data_distributor.id_distributor
                                            INNER JOIN data_barang ON detail_barang_masuk.id_barang = data_barang.id_barang
                                            INNER JOIN kondisi_barang ON detail_barang_masuk.id_kondisi = kondisi_barang.id_kondisi
                                            WHERE
                                                detail_barang_masuk.id_masuk = '$id'";



                            $query = mysqli_query($koneksi, $sql2);


                            $no = 1;
                            foreach ($query as $data) {
                            ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo $no++;
                                        ?>
                                    </td>
                                    <td><?= $data['nama_distributor'] ?></td>
                                    <td><?= $data['nama_barang'] ?></td>
                                    <td><?= $data['jumlah'] ?></td>
                                    <td><?= $data['kondisi'] ?></td>
                                    <td><?= "Rp." . number_format($data['subtotal']) ?></td>

                                </tr>


                            <?php } ?>






                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- END OF CONTENT -->
</body>

</html>