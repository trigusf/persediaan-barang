<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
include '../database/database.php';
$page = 'barangMasuk';



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css?">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Barang Masuk</title>
</head>
<body>
    
<div class="container">

    <?php include '../partials/sidebar.php'  ?>
   

    <main>
        <div class="header">
            <p><button onclick="toggleSidebar()" class="toggle-btn">☰</button>Barang Masuk</p>
        </div>
        <div class="content">
            <div class="content-header">
                <h2>Barang Masuk</h2>
                <a href="tambah/tambahBarangMasuk.php" class="add">
                    <span class="icon">+</span>
                    <span class="text">Tambah Barang</span>
                </a>
            </div>

            <div class="content-main">
                <div class="table-wrapper">
                    <table>
                        <tr>
                            <th class="col-no">No</th>
                            <th>Input</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total Harga</th>
                            <th>Opsi</th>
                        </tr>
                        <?php 

                            $no = 1;
                            $query = mysqli_query($conn, "SELECT * FROM barang_masuk");
                            while ($row = mysqli_fetch_assoc($query)):
                                ?>
                        <tr class="data-value">
                            <td><?= $no++ ?></td>
                            <td><?= $row['id_user'] ?></td>
                            <td><?= $row['tgl_barang_masuk'] ?></td>
                            <td><?= $row['total'] ?></td>
                            <td class="option">
                                <a href="detail/detailBarangMasuk.php?id=<?= $row['id_barang_masuk'] ?>">Detail</a>
                           </td>
                        </tr>

                           <?php endwhile; ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>


<script src="../../assets/js/script.js"></script>
</body>
</html>