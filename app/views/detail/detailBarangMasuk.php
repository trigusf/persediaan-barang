<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
include '../../database/database.php';
$page = 'barangMasuk';



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/style.css?">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Detail Barang Masuk</title>
</head>
<body>
    
<div class="container">

    <?php include '../../partials/sidebar.php'  ?>
   

    <main>
        <div class="header">
            <p><button onclick="toggleSidebar()" class="toggle-btn">☰</button>Detail Barang Masuk</p>
        </div>
        <div class="content">
            <div class="content-header">
                <h2>Detail Barang Masuk</h2>
            </div>

            <div class="content-main">
                <div class="table-wrapper">
                    <table>
                        <tr>
                            <th class="col-no">No</th>
                            <th>Nama Distributor</th>
                            <th>Brand</th>
                            <th>Barang</th>
                            <th>QTY</th>
                            <th>Subtotal</th>
                        </tr>
                        <?php 

                            $idBarangMasuk = $_GET['id'];
                            $no = 1;
                            $query = mysqli_query($conn, "SELECT a.id_detail_masuk, a.id_barang_masuk, a.id_distributor, a.id_barang, a.qty, a.subtotal, b.nama_distributor, b.brand, c.kode_barang, c.nama_barang, c.harga_barang FROM detail_barang_masuk AS a INNER JOIN data_distributor AS b ON a.id_distributor = b.id_distributor INNER JOIN data_barang AS c ON a.id_barang = c.id_barang WHERE id_barang_masuk = '$idBarangMasuk'");
                            while ($row = mysqli_fetch_assoc($query)):
                                ?>
                        <tr class="data-value">
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama_distributor'] ?></td>
                            <td><?= $row['brand'] ?></td>
                            <td><?= $row['nama_barang'] ?></td>
                            <td><?= $row['qty'] ?></td>
                            <td><?= $row['subtotal'] ?></td>
                        </tr>

                           <?php endwhile; ?>
                        <tr>
                            <td colspan="5"><b>TOTAL</b></td>
                            <td><b>870000</b></td>
                        </tr>
                    </table>
                </div>
            </div>
                  <div class="back">
                        <a href="../barangMasuk.php">Back</a>
                    </div>
        </div>
    </main>
</div>


<script src="../../assets/js/script.js"></script>
</body>
</html>