<?php

include '../../../koneksi/koneksi.php';
$id = $_GET['id'];

$result = mysqli_query($koneksi, "SELECT * FROM data_distributor WHERE id_distributor = '$id' ");

while ($user_data = mysqli_fetch_array($result)) {
    $nama_distributor = $user_data['nama_distributor'];
    $alamat = $user_data['alamat_distributor'];
    $telp = $user_data['no_telp'];
    $email = $user_data['email_distributor'];
}
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $distributor = $_POST['distributor'];
    $alamat = $_POST['alamat'];
    $notelp = $_POST['notelp'];
    $email = $_POST['email'];

    echo "$id <br>";
    echo "$distributor <br>";
    echo "$alamat <br>";
    echo "$notelp <br>";
    echo "$email <br>";


    $result = mysqli_query($koneksi, "UPDATE data_distributor 
                                        SET nama_distributor = '$distributor', alamat_distributor = '$alamat', no_telp = '$notelp', email_distributor = '$email' 
                                        WHERE id_distributor = '$id'");

    header("location: ../data_distributor.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/edit.css">
    <link rel="stylesheet" href="../../../assets/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/fontawesome.min.css">
    <title>Edit Data Distributor</title>
</head>

<body>

    <div class="back">
        <div class="bck">
            <div>
                <a href="../data_distributor.php?page=1">
                    <i class="fa fa-solid fa-arrow-left"></i>
                    <label>Kembali</label>
                </a>
            </div>
        </div>
    </div>

    <div class="content">
        <h2>EDIT DATA <br>DISTRIBUTOR</h2>


        <form action="" method="post">

            <div class="container">

                <div class="insert">
                    <div class="insert1">

                        <!-- <span>Kode Barang</span> -->
                        <input type="text" name="distributor" placeholder="NAMA DISTRIBUTOR" value="<?php echo $nama_distributor ?>">

                        <!-- <span>Brand</span> -->
                        <input type="text" name="alamat" placeholder="ALAMAT" value="<?php echo $alamat ?>">

                        <!-- <span>Harga</span> -->
                        <input type="text" name="notelp" placeholder="NO TELEPON" value="<?php echo $telp ?>">

                        <!-- <span>Nama Barang</span> -->
                        <input type="text" name="email" placeholder="EMAIL" value="<?php echo $email ?>">
                    </div>

                </div>
                <div class="submit-insert">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="submit" name="simpan" value="SIMPAN" class="simpan" onclick="alert('apakah anda yakin akan menyimpan perubaahan ini?')">
                </div>

            </div>

        </form>
    </div>

    <div class="footer">
        <p>COPYRIGHT &copy 2023 TRIGUSMAETA & FADLAN</p>
    </div>


</body>

</html>