<?php

session_start();
if (isset($_SESSION['username'])) {
    include '../../koneksi/koneksi.php';
} else {
    header('location:../../index.html');
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
    <title>Data Distributor</title>
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
                        <li><a href="../data barang/data_barang.php?page=1"><i class="fa-solid fa-boxes-stacked"></i> Data Barang</a></li>
                        <li><a href="../data pegawai/data_pegawai.php?page=1"><i class="fa-solid fa-users"></i> Data Pegawai</a></li>
                        <li><a href="data_distributor.php?page=1" class="link-active"><i class="fa-solid fa-truck"></i> Data Distributor</a></li>
                        <li><a href="../barang masuk/barang_masuk.php?page=1"><i class="fa-solid fa-right-to-bracket"></i> Barang Masuk</a></li>
                        <li><a href="../barang keluar/barang_keluar.php?page=1"> <i class="fa-solid fa-right-from-bracket"></i> Barang Keluar</a></li>
                        <li><a href="../laporan/laporan.php"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
                    </ul>
                    <hr>
                    <span><a href="../../koneksi/logout.php" onclick="return confirm('Apakah anda yakin akan meninggalkan web ini?')">Log Out</a></span>
                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="container">

            <div class="head">
                <span>Data Distributor</span>
            </div>
            <div class="line"></div>




            <div class="isi">
                <div class="text">
                    <div class="text1">
                        <b class="judul-isi"><i class="fa-solid fa-truck"></i>&nbsp; Data Distributor</b>
                    </div>
                </div>


                <?php
                include '../../koneksi/koneksi.php';

                // pagination function
                $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
                $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');


                $data_page = mysqli_query($koneksi, "SELECT * FROM data_distributor");

                $data_batas = 7;
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


                $data_halaman = mysqli_query($koneksi, "SELECT * FROM data_distributor LIMIT $data_awal,$data_batas");

                // end pagination function
                ?>


                <div class="isi-barang">
                    <div class="table">
                        <table>
                            <tr>
                                <th>no</th>
                                <th>Nama Distributor</th>
                                <th>BRAND</th>
                                <th>Alamat Distributor</th>
                                <th>No Telp</th>
                                <th>Email</th>

                            </tr>

                            <?php
                            include '../../koneksi/koneksi.php';
                            $sql = "SELECT * FROM data_distributor";
                            $distributor = mysqli_query($koneksi, $sql);
                            $no = 1;
                            foreach ($distributor as $nama) {
                            ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo $no++;
                                        ?>
                                    </td>
                                    <td><?= $nama['nama_distributor']; ?></td>
                                    <td><?= $nama['brand']; ?></td>
                                    <td><?= $nama['alamat_distributor']; ?></td>
                                    <td><?= $nama['no_telp']; ?></td>
                                    <td><?= $nama['email_distributor']; ?></td>
                                </tr>

                            <?php } ?>
                            <?php
                            if (mysqli_num_rows($data_halaman) == 0) {
                                echo '<tr>';
                                echo '<td colspan="7">Data Tidak Ada</td>';
                                echo '</tr>';
                            }
                            ?>
                            <?php echo "<a class='halaman-1';> Halaman $aktif_page Dari $end_number Halaman </a>"; ?>

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





                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- END OF CONTENT -->
</body>

</html>