<?php

session_start();
if (isset($_SESSION['username'])) {
    include '../../koneksi/koneksi.php';
} else {
    header('location:../../index.php');
}


$username = $_SESSION['username'];
$query = mysqli_query($koneksi, "SELECT * FROM biodata where username = '$username'");
$row = mysqli_fetch_array($query);
$name = $row['nama'];
$us = $row['username'];
$photo = $row['foto'];

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
    <link rel="stylesheet" href="../../assets/css/edit.css">
    <link rel="stylesheet" href="../../assets/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/fontawesome.min.css">
    <title>Laporan</title>
</head>

<body>
    <div id="content">
        <div class="navbar">
            <div class="photo">
                <?php
                $foto =  mysqli_query($koneksi, "SELECT foto FROM biodata where username = '$username'");
                while ($img = mysqli_fetch_array($foto)) { ?>
                    <img src="../../assets/profile photo/<?= $img['foto'] ?>" alt="photo profile">

                <?php } ?>
            </div>
            <h3><?= $us ?></h3>

            <a href="../edit profile/edit_profile.php" class="edit_prof">Edit Profile <i class="fa-solid fa-pen"></i></a>
            <hr>
            <div class="nav">

                <div class="data">
                    <ul>
                        <li><a href="../dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                        <li><a href="../data barang/data_barang.php?page=<?= $aktif_page ?>"><i class="fa-solid fa-boxes-stacked"></i> Data Barang</a></li>
                        <li><a href="../data pegawai/data_pegawai.php?page=<?= $aktif_page ?>"><i class="fa-solid fa-users"></i> Data Pegawai</a></li>
                        <li><a href="../data distributor/data_distributor.php?page=<?= $aktif_page ?>"><i class="fa-solid fa-truck"></i> Data Distributor</a></li>
                        <li><a href="../barang masuk/barang_masuk.php?page=<?= $aktif_page ?>"><i class="fa-solid fa-right-to-bracket"></i> Barang Masuk</a></li>
                        <li><a href="../barang keluar/barang_keluar.php?page=<?= $aktif_page ?>"><i class="fa-solid fa-right-from-bracket"></i> Barang Keluar</a></li>
                        <li><a href="#" class="link-active"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
                    </ul>
                    <hr>
                    <span><a href="../../koneksi/logout.php" onclick="return confirm('Yakin Untuk Keluar Dari Website?')">Log Out</a></span>
                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="container">

            <div class="head">
                <span>Laporan</span>
            </div>
            <div class="line"></div>



            <div class="isi">
                <div class="text">
                    <div class="text1">
                        <b class="judul-isi"><i class="fa-solid fa-file-lines"></i>&nbsp; Laporan</b>
                    </div>
                </div>
                <div class="laporan">
                    <a href="laporan_barang_masuk.php?page=1" class="masuk"><i class="fa-solid fa-right-to-bracket"></i> Laporan Barang Masuk</a>
                    <a href="laporan_barang_keluar.php?page=1" class="keluar"><i class="fa-solid fa-right-from-bracket"></i> Laporan Barang Keluar</a>
                </div>


                <!-- <div class="isi-barang">
                    <div class="table">
                        <table border>
                            <tr>
                                <th>no</th>
                                <th>id barang</th>
                                <th>tanggal keluar</th>
                                <th>distributor</th>
                                <th>jumlah barang masuk</th>
                                <th>total harga beli</th>
                                <th>petugas</th>
                            </tr>

                            <?php
                            include '../../koneksi/koneksi.php';
                            $sql = "SELECT * FROM barang_masuk";
                            $barang = mysqli_query($koneksi, $sql);
                            $no = 1;
                            foreach ($barang as $nama) {
                            ?>

                                    <tr>
                                        <td>
                                            <?php
                                            echo $no++;
                                            ?>
                                        </td>
                                        <td><?= $nama['tgl_masuk']; ?></td>
                                        <td><?= "Rp." . number_format($nama['harga']); ?></td>
                                        <td><?= "Rp." . number_format($nama['harga']); ?></td>
                                        <td><?= "Rp." . number_format($nama['harga']); ?></td>
                                        <td><?= "Rp." . number_format($nama['harga']); ?></td>
                                        <td><?= "Rp." . number_format($nama['harga']); ?></td>
                                    </tr>
                                    

                            <?php } ?>
                            
                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div> -->
                <!-- END OF CONTENT -->


</body>

</html>