<?php
session_start();
include '../../database/database.php';
$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM data_barang WHERE id_barang = '$id'");
$data = mysqli_fetch_assoc($query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../assets/css/style.css?">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Tambah Barang</title>
</head>
<body>
    <div class="tambahdata">
        <div class="back"><a href="../dataBarang.php"><- Kembali</a></div>
        <div class="isitambahdata">
            <h1>Tambah Data Barang</h1>
            <form action="../../controller/barangController.php" method="post" class="formAdd">
            <input type="hidden" name="action" value="editBarang">
            <input type="hidden" name="idBarang" value="<?= $data['id_barang'] ?>">
            <div class="input">
                <span>Distributor</span>
                <select name="idDistributor" id="distributor" disabled>
                    <?php 

                    $sql = mysqli_query($conn, "SELECT id_distributor, nama_distributor FROM data_distributor WHERE id_distributor = '$id'");
                    
                    while ($row = mysqli_fetch_assoc($sql)):
                    ?>
                    <option value="<?= $row['id_distributor'] ?>" >
                        <?= $row['nama_distributor'] ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="input">
                <span>Kode Barang</span>
                <input type="text" name="KodeBarang" value="<?= $data['kode_barang'] ?>" disabled>
            </div>

            <div class="input">
                <span>Nama Barang</span>
                <input type="text" name="namaBarang" value="<?= $data['nama_barang'] ?>">
            </div>
            
            <div class="input">
                <span>Harga Barang</span>
                <input type="number" name="hargaBarang" value="<?= $data['harga_barang'] ?>">
            </div>

            <div class="input">
                <button type="submit">Tambah</button>
            </div>

            
            </form>

        </div>
    </div>
</body>
</html>