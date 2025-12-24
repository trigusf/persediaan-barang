<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
include '../database/database.php';
$page = 'dataDistributor';



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css?">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Data Distributor</title>
</head>
<body>
    
<div class="container">

    <?php include '../partials/sidebar.php'  ?>
   

    <main>
        <div class="header">
            <p><button onclick="toggleSidebar()" class="toggle-btn">☰</button>Data Distributor</p>
        </div>
        <div class="content">
            <div class="content-header">
                <h2>Data Barang</h2>
                <a href="tambah/tambahDistributor.php" class="add">
                    <span class="icon">+</span>
                    <span class="text">Tambah Distributor</span>
                </a>
            </div>

            <div class="content-main">
                
                <table>
                    <tr>
                        <th class="col-no">No</th>
                        <th>Nama Distributor</th>
                        <th>Brand</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>alamat</th>
                        <th>Opsi</th>
                    </tr>
                    <?php 
                        
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT * FROM data_distributor");
                        while ($row = mysqli_fetch_assoc($query)):
                            ?>
                    <tr class="data-value">
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_distributor'] ?></td>
                        <td><?= $row['brand'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['telp'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td class="option">
                            <a href="edit/editDistributor.php?id=<?= $row['id_distributor'] ?>">edit</a>
                            <a href="../controller/distributorController.php?action=deleteDistributor&id=<?= $row['id_distributor']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">hapus</a>
                       </td>
                    </tr>

                       <?php endwhile; ?>
                </table>
                
            </div>
        </div>
    </main>
</div>


<script src="../../assets/js/script.js"></script>
</body>
</html>