<?php
session_start();

include '../../database/database.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM data_distributor where id_distributor = '$id'");
$data = mysqli_fetch_assoc($query);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../assets/css/style.css?">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit Distributor</title>
</head>
<body>
    <div class="tambahdata">
        <div class="back"><a href="../dataDistributor.php"><- Kembali</a></div>

        <div class="isitambahdata">
            <h1>Edit Data Distributor</h1>
            <form action="../../controller/distributorController.php" method="post" class="formAdd">
            <input type="hidden" name="action" value="editDistributor">
            <input type="hidden" name="idDistributor" value="<?= $data['id_distributor'] ?>">
            <div class="input">
                <span>Edit Distributor</span>
                <input type="text" name="namaDistributor" placeholder="Nama Distributor" value="<?= $data['nama_distributor'] ?>" required>
            </div>

            <div class="input">
                <span>Nama Brand</span>
                <input type="text" name="brand" placeholder="Brand" value="<?= $data['brand'] ?>" required>
            </div>

            <div class="input">
                <span>No.telpon</span>
                <input type="number" name="telp" placeholder="No.telp" value="<?= $data['telp'] ?>" required>
            </div>
            
            <div class="input">
                <span>Alamat</span>
                <textarea name="alamat" name="alamat" placeholder="<?= $data['alamat'] ?>" required></textarea>
            </div>

            <div class="input">
                <span>Email</span>
                <input type="text" name="email" placeholder="Email@gmail.com" value="<?= $data['email'] ?>" required>
            </div>

            <div class="input">
                <button type="submit">Edit</button>
            </div>

            
            </form>

        </div>
    </div>
</body>
</html>