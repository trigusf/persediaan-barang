<?php

session_start();
if (isset($_SESSION['username'])) {
    include '../koneksi/koneksi.php';
} else {
    header('location:../index.php');
}

$username = $_SESSION['username'];
$query = mysqli_query($koneksi, "SELECT * FROM biodata where username = '$username'");
$row = mysqli_fetch_array($query);
$name = $row['nama'];
$us = $row['username'];
$photo = $row['foto'];

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
    <link rel="stylesheet" href="../assets/css/edit.css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <title>Dahsboard</title>
</head>

<body>
    <div id="content">



        <!-- SIDEBAR -->
        <div class="navbar">
            <div class="photo">
                <?php

                $foto =  mysqli_query($koneksi, "SELECT foto FROM biodata where username = '$username'");
                while ($img = mysqli_fetch_array($foto)) { ?>

                    <img src="../assets/profile photo/<?= $img['foto'] ?>" alt="photo profile">

                <?php } ?>
            </div>

            <h3><?= $username ?></h3>






            <a href="edit profile/edit_profile.php" class="edit_prof">Edit Profile <i class="fa-solid fa-pen"></i></a>
            <hr>
            <div class="nav">

                <div class="data">
                    <ul>
                        <li><a href="dashboard.php?page=1" class="link-active"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                        <li><a href="data barang/data_barang.php?page=1"><i class="fa-solid fa-boxes-stacked"></i> Data Barang</a></li>
                        <li><a href="data pegawai/data_pegawai.php?page=1"><i class="fa-solid fa-users"></i> Data Pegawai</a></li>
                        <li><a href="data distributor/data_distributor.php?page=1"><i class="fa-solid fa-truck"></i> Data Distributor</a></li>
                        <li><a href="barang masuk/barang_masuk.php?page=1"><i class="fa-solid fa-right-to-bracket"></i> Barang Masuk</a></li>
                        <li><a href="barang keluar/barang_keluar.php?page=1"> <i class="fa-solid fa-right-from-bracket"></i> Barang Keluar</a></li>
                        <li><a href="laporan/laporan.php?page=1"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
                    </ul>
                    <hr>
                    <span><a href="../koneksi/logout.php" onclick="return confirm('Apakah anda yakin akan meninggalkan web ini?')">Log Out</a></span>
                </div>

            </div>

        </div>


        <!-- END SIDEBAR -->




        <!-- CONTENT -->
        <div class="container">
            <div class="head">
                <span>Persediaan Barang</span>
            </div>
            <div class="line"></div>





            <div class="isi">
                <div class="text">
                    <div class="text1">
                        <div class="welcome">
                            Selamat Datang,<br>
                            <b><?= $name ?></b>
                        </div>
                        <div class="date">
                            <?php
                            date_default_timezone_set("Asia/Jakarta");
                            $date = new DateTime("Asia/Jakarta");
                            $month = $date->format("M");
                            $day = $date->format("D");
                            $year = $date->format("Y");
                            echo $days[$day] . ",<br> <b>" .  date("d") . "&nbsp" . $months[$month] . " ". $year ."</b>";
                            ?>
                        </div>
                    </div>
                    <div class="kotak">
                        <div class="kotak_text">DASHBOARD</div>
                        <div class="garis"></div>
                        <div class="text_dalam">Anda Telah Masuk Sebagai <b>@<?= $username ?></b>,<br>
                            Anda Dapat Meng-akses Website Persediaan Barang.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- END OF CONTENT -->
</body>

</html>