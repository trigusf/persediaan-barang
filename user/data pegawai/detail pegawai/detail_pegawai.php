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
    <title>Data Pegawai</title>
</head>

<body>
    <div id="content">
        <div class="navbar">

            <div class="back-1">
                <a href="../data_pegawai.php?page=1">
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
                        <li><a href="../data_pegawai.php?page=1" class="link-active"><i class="fa-solid fa-users"></i> Data Pegawai</a></li>
                        <li><a href="../../data distributor/data_distributor.php?page=1"><i class="fa-solid fa-truck"></i> Data Distributor</a></li>
                        <li><a href="../../barang masuk/barang_masuk.php?page=1"><i class="fa-solid fa-right-to-bracket"></i> Barang Masuk</a></li>
                        <li><a href="../../barang keluar/barang_keluar.php?page=1"><i class="fa-solid fa-right-from-bracket"></i> Barang Keluar</a></li>
                        <li><a href=""><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
                    </ul>
                    <hr>
                    <span><a href="../../../koneksi/logout.php" onclick="return confirm('Apakah anda yakin akan meninggalkan web ini?')">Log Out</a></span>
                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="container">

            <div class="head">
                <span>Detail Pegawai</span>
            </div>
            <div class="line"></div>




            <div class="isi">
                <div class="text">
                    <div class="text1">
                        <b class="judul-isi"><i class="fa-solid fa-users"></i>&nbsp; Detail Pegawai</b>
                    </div>
                </div>
                <div class="isi-barang2">
                    <div class="photo2">
                        <?php

                        $id = $_GET['id'];
                        $sql = "SELECT * FROM biodata WHERE id_biodata = '$id'";
                        $query2 = mysqli_query($koneksi, $sql);
                        $save = mysqli_fetch_array($query2);

                        ?>
                        <img src="../../../assets/profile photo/<?= $save['foto'] ?>" alt="photo profile">


                    </div>
                    <div class="biodata">

                        <?php



                        $nama   = $save['nama'];
                        $usern  = $save['username'];
                        $alamat = $save['alamat'];
                        $no     = $save['no_telp'];
                        $tgl    = $save['tgl_lahir'];
                        $jk     = $save['jk'];

                        ?>

                        <div class="data">
                            <p><?= $nama ?></p>
                            <b>@<?= $usern ?></b>
                        </div>

                        <div class="data">
                            <b>No Telepon:</b>
                            <p><?= $no ?></p>
                        </div>

                        <div class="data">
                            <b>Alamat:</b>
                            <p><?= $alamat ?></p>
                        </div>

                        <div class="data">
                            <b>Tanggal Lahir:</b>
                            <p><?= $tgl ?></p>
                        </div>

                        <div class="data">
                            <b>Jenis kelamin:</b>
                            <p><?= $jk ?></p>
                        </div>
                    </div>



                    <!-- <div class="table">
                        <table border>
                            <tr>
                                <th>no</th>
                                <th>username</th>
                                <th>nama</th>
                                <th>alamat</th>
                                <th>no.telp</th>
                                <th>jenis kelamin</th>
                                <th>tgl lahir</th>
                                <th>level</th>
                                <th>opsi</th>
                            </tr> -->

                    <!--  </table> -->
                </div>

            </div>
        </div>

    </div>
    </div>
    <!-- END OF CONTENT -->
</body>

</html>