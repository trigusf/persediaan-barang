<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
include '../database/database.php';
$page = 'dataBarang';



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css?">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Data barang</title>
</head>
<body>
    
<div class="container">

    <?php include '../partials/sidebar.php'  ?>
   

    <main>
        <div class="header">
            <p><button onclick="toggleSidebar()" class="toggle-btn">☰</button>Data Barang</p>
        </div>
        <div class="content">
            <div class="content-header">
                <h2>Data Barang</h2>
                <a href="tambah/tambahBarang.php" class="add">
                    <span class="icon">+</span>
                    <span class="text">Tambah Barang</span>
                </a>
            </div>

            <div class="content-main">
                <div class="table-wrapper">
                    <table>
                        <tr>
                            <th class="col-no">No</th>
                            <th>Nama Barang</th>
                            <th>Nama Brand</th>
                            <th>Kode Barang</th>
                            <th>Harga Barang</th>
                            <th>QTY</th>
                            <th>Opsi</th>
                        </tr>
                        <?php 

                            $no = 1;
                            $query = mysqli_query($conn, "SELECT * FROM data_barang INNER JOIN data_distributor ON data_barang.id_distributor = data_distributor.id_distributor");
                            while ($row = mysqli_fetch_assoc($query)):
                                ?>
                        <tr class="data-value">
                            <td><?= $no++ ?></td>
                            <td><?= $row['kode_barang'] ?></td>
                            <td><?= $row['brand'] ?></td>
                            <td><?= $row['nama_barang'] ?></td>
                            <td><?= $row['harga_barang'] ?></td>
                            <td><?= $row['qty'] ?></td>
                            <td class="option">
                                <a href="edit/editBarang.php?id=<?= $row['id_barang'] ?>">edit</a>
                                <a href="../controller/barangController.php?action=deleteBarang&id=<?= $row['id_barang'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">hapus</a>
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