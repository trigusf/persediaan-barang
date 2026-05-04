<?php

session_start();
if (isset($_SESSION['username'])) {
    include '../../koneksi/koneksi.php';
} else {
    header('location:../../../index.php');
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
    <link rel="stylesheet" href="../../assets/css/edit.css">
    <link rel="stylesheet" href="../../assets/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/fontawesome.min.css">
    <title>Laporan Barang Masuk</title>
</head>

<body>
    <div id="content">
        <div class="navbar">

            <div class="back-1">
                <a href="laporan.php">
                    <div class="btn">
                        <div><i class="fa-solid fa-arrow-left"></i></div>
                    </div>

                    <div class="kembali-1">
                        Laporan
                    </div>
                </a>
            </div>



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
                        <li><a href="../data barang/data_barang.php?page=1"><i class="fa-solid fa-boxes-stacked"></i> Data Barang</a></li>
                        <li><a href="../data pegawai/data_pegawai.php?page=1"><i class="fa-solid fa-users"></i> Data Pegawai</a></li>
                        <li><a href="../data distributor/data_distributor.php?page=1"><i class="fa-solid fa-truck"></i> Data Distributor</a></li>
                        <li><a href="../barang masuk/barang_masuk.php?page=1"><i class="fa-solid fa-right-to-bracket"></i> Barang Masuk</a></li>
                        <li><a href="../barang keluar/barang_keluar.php?page=1"><i class="fa-solid fa-right-from-bracket"></i> Barang Keluar</a></li>
                        <li><a href="../laporan/laporan.php" class="link-active"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
                    </ul>
                    <hr>
                    <span><a href="../../koneksi/logout.php" onclick="return confirm('Yakin Untuk Keluar Dari Website?')">Log Out</a></span>
                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="container">

            <div class="head">
                <span>Laporan Barang Masuk</span>
            </div>
            <div class="line"></div>

            <form action="laporan_barang_masuk.php" method="GET">

                <div class="isi">
                    <div class="text">
                        <div class="text1">
                            <b class="judul-isi"><i class="fa-solid fa-right-to-bracket"></i>&nbsp; Laporan Barang Masuk</b>

                            <div class="form-1">
                                <input type="month" name="bulan" id="bulan" class="form-field">

                                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> </button>
                            </div>
                        </div>



                    </div>
                    <div class="isi-barang">
                        <div class="table">
                            <table>
                                <tr>
                                    <th>no</th>
                                    <th>Bulan Masuk</th>
                                    <th>total</th>
                                    <th>opsi</th>
                                </tr>

                                <?php
                                // pagination function
                                $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
                                $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
                                $search = isset($_GET['bulan']) ? $_GET['bulan'] : date('Y-m');

                                $data_page = mysqli_query($koneksi, "SELECT YEAR(tgl_masuk) as tahun, MONTH(tgl_masuk) as bulan, GROUP_CONCAT(tgl_masuk SEPARATOR ', ') as tgl_masuk, SUM(harga) as total_harga FROM barang_masuk WHERE DATE_FORMAT(tgl_masuk, '%Y-%m') = '$search' GROUP BY YEAR(tgl_masuk), MONTH(tgl_masuk) ORDER BY YEAR(tgl_masuk) DESC, MONTH(tgl_masuk) DESC");


                                $data_batas = 5;
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

                                $data_awal = ($aktif_page * $data_batas) - $data_batas;

                                if ($aktif_page < ($jumlah_pagination -  $jumlah_link)) {
                                    $end_number = $aktif_page + $jumlah_link;
                                } else {
                                    $end_number = $jumlah_pagination;
                                }

                                if ($search == @$_GET['bulan']) {
                                    $data_halaman = mysqli_query($koneksi, "SELECT YEAR(tgl_masuk) as tahun, MONTH(tgl_masuk) as bulan, GROUP_CONCAT(DISTINCT DATE_FORMAT(tgl_masuk, '%M %Y') ORDER BY tgl_masuk SEPARATOR ', ') as tgl_masuk, SUM(harga) as total_harga FROM barang_masuk WHERE DATE_FORMAT(tgl_masuk, '%Y-%m') = '$search' GROUP BY YEAR(tgl_masuk), MONTH(tgl_masuk) ORDER BY YEAR(tgl_masuk) DESC, MONTH(tgl_masuk) DESC LIMIT $data_awal,$data_batas");
                                } else {
                                    $data_halaman = mysqli_query($koneksi, "SELECT YEAR(tgl_masuk) as tahun, MONTH(tgl_masuk) as bulan, GROUP_CONCAT(DISTINCT DATE_FORMAT(tgl_masuk, '%M %Y') ORDER BY tgl_masuk SEPARATOR ', ') as tgl_masuk, SUM(harga) as total_harga FROM barang_masuk GROUP BY YEAR(tgl_masuk), MONTH(tgl_masuk) ORDER BY YEAR(tgl_masuk) DESC, MONTH(tgl_masuk) DESC LIMIT $data_awal,$data_batas");
                                }

                                if ($search == NULL) {
                                    $data_halaman = mysqli_query($koneksi, "SELECT YEAR(tgl_masuk) as tahun, MONTH(tgl_masuk) as bulan, GROUP_CONCAT(DISTINCT DATE_FORMAT(tgl_masuk, '%M %Y') ORDER BY tgl_masuk SEPARATOR ', ') as tgl_masuk, SUM(harga) as total_harga FROM barang_masuk GROUP BY YEAR(tgl_masuk), MONTH(tgl_masuk) ORDER BY YEAR(tgl_masuk) DESC, MONTH(tgl_masuk) DESC LIMIT $data_awal,$data_batas");
                                }

                                if (mysqli_num_rows($data_halaman) == 0) {
                                    echo '<tr>';
                                    echo '<td colspan="4">Data Tidak Ada</td>';
                                    echo '</tr>';
                                }
                                // end pagination function
                                ?>

                                <?php
                                include '../../koneksi/koneksi.php';
                                // $sql = "SELECT YEAR(tgl_masuk) as tahun, MONTH(tgl_masuk) as bulan, GROUP_CONCAT(tgl_masuk SEPARATOR ', ') as tgl_masuk, SUM(harga) as total_harga FROM barang_masuk GROUP BY YEAR(tgl_masuk), MONTH(tgl_masuk) ORDER BY YEAR(tgl_masuk) DESC, MONTH(tgl_masuk) DESC";
                                // $barang = mysqli_query($koneksi, $sql);

                                $no = 1 + $data_awal;
                                while ($user_data = mysqli_fetch_array($data_halaman)) {

                                    $tanggal = (date('F Y', strtotime($user_data['tgl_masuk'])));
                                    $jumlah = "Rp." . number_format($user_data['total_harga']);

                                ?>

                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?= $tanggal ?></td>
                                        <td><?= $jumlah ?></td>
                                        <td>
                                            <a href="detail laporan/detail_masuk.php?page=<?= $aktif_page ?>&tahun=<?= $user_data['tahun'] ?>&bulan=<?= $user_data['bulan'] ?>" class=""><i class="fa fa-regular fa-circle-info"></i></a>
                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>
                                <?php
                                // if($search == $_GET['bulan' == NULL]){
                                ?>
                                <!-- <td colspan=4>Data tidak ada</td> -->

                                <?php
                                // } 
                                ?>

                                </tr>


                            </table>

                            <div class="pagination">
                                <!-- pagenation -->
                                <?php
                                if ($aktif_page > 1) {
                                    echo '<a class="prev" href="?page=' . ($aktif_page - 1) . '"> <i class="fa-solid fa-angle-left" style="color: white;"></i></a>';
                                }


                                for ($i = $start_number; $i <= $end_number; $i++) {

                                    if (@$_GET['page'] == $i) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    }



                                    echo '<a class="' . $active . '" href="?page=' . $i . '">' . $i . '</a>';
                                }


                                if ($aktif_page >= 1 && $aktif_page < $jumlah_pagination) {
                                    echo '<a class="next" href="?page=' . ($aktif_page + 1) . '"><i class="fa-solid fa-angle-right" style="color: white;"></i></a>';
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END OF CONTENT -->
</body>

</html>