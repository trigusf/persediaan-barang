<?php
include '../../../koneksi/koneksi.php';
$id = $_GET['id'];

$result = mysqli_query($koneksi, "SELECT * FROM data_barang INNER JOIN data_distributor ON data_barang.id_distributor = data_distributor.id_distributor WHERE id_barang = '$id' ");

while ($user_data = mysqli_fetch_array($result)) {
    $kode_barang = $user_data['kode_barang'];
    $brand_barang = $user_data['brand'];
    $harga_barang = $user_data['harga_barang'];
    $nama_barang = $user_data['nama_barang'];
    $stock_barang   = $user_data['stock_barang'];
    $status_barang = $user_data['status_barang'];
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $kode = $_POST['kode']; 
    $brand = $_POST['brand']; 
    $harga = $_POST['harga'];
    $barang = $_POST['barang'];

    $result = mysqli_query($koneksi, "UPDATE data_barang SET kode_barang ='$kode', nama_barang ='$barang', harga_barang ='$harga' WHERE id_barang = '$id'");



    if ($result) {
        echo "<script>
                alert('Data Berhasil Di Simpan');
                window.location.href='../data_barang.php?page=1';
            </script>";
        exit();
    } else {
        echo 'Error: Failed to update data. ' . mysqli_error($koneksi);
    }
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
    <title>EDIT BARANG</title>
</head>

<body>

    <div class="back">
        <div class="bck">
            <div>
                <a href="../data_barang.php?page=1">
                    <i class="fa fa-solid fa-arrow-left"></i>
                    <label>Kembali</label>
                </a>
            </div>
        </div>
    </div>

    <div class="content">
        <h2>EDIT DATA <br>BARANG</h2>


        <form action="" method="post">
            <div class="container">

                <div class="insert">
                    <div class="insert1">

                        <!-- <span>Kode Barang</span> -->
                        <input type="text" name="kode" placeholder="KODE BARANG" disabled value="<?php echo $kode_barang ?>">
                        <input type="hidden" name="kode" value="<?php echo $kode_barang?>">
                        <!-- <span>Tgl masuk</span> -->
                        <input type="text" name="tanggal" class="tgl" disabled value="<?php
                                                                                        date_default_timezone_set("Asia/Jakarta");
                                                                                        echo date("d-m-Y"); ?>">
                        <!-- <span>Brand</span> -->
                        <input type="text" name="brand" placeholder="BRAND" disabled value="<?php echo $brand_barang ?>">
                        <input type="hidden" name="brand" value="<?php echo $brand_barang?>">
                        
                        <!-- <span>Brand</span> -->
                        <input type="text" name="barang" placeholder="NAMA BARANG" value="<?php echo $nama_barang ?>">
                        

                        <!-- <span>Harga</span> -->
                        <input type="text" name="harga" placeholder="HARGA" value="<?php echo $harga_barang ?>">

                        
                    </div>
                </div>
                <div class="submit-insert">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="submit" name="simpan" value="SIMPAN" class="simpan" onclick="alert('Apakah Anda Yakin Dengan Perubahan Ini? Klik OKE Untuk Melanjutkan.')">
                </div>

            </div>

        </form>
    </div>

    <div class="footer">
        <p>COPYRIGHT &copy 2023 TRIGUSMAETA & FADLAN</p>
    </div>


</body>

</html>