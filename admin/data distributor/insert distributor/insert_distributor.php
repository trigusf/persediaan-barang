<?php

include '../../../koneksi/koneksi.php';



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
    <title>Tambah Data Distributor</title>
</head>

<body>

    <div class="back">
        <div class="bck">
            <div>
                <a href="../data_distributor.php">
                    <i class="fa fa-solid fa-arrow-left"></i>
                    <label>Kembali</label>
                </a>
            </div>
        </div>
    </div>

    <div class="content">
        <h2>TAMBAH DATA <br>DISTRIBUTOR</h2>


        <form action="simpan_distributor.php" method="post">

            <div class="container">

                <div class="insert">
                    <div class="insert1">

                        <!-- <span>Nama Distributor</span> -->
                        <input type="text" name="distributor" placeholder="NAMA DISTIRBUTOR" required>

                        <!-- <span>Nama Distributor</span> -->
                        <input type="text" name="brand" placeholder="BRAND" required>

                        <!-- <span>Alamat Distributor</span> -->
                        <input type="text" name="alamat" placeholder="ALAMAT" required>

                        <!-- <span>Brand</span> -->
                        <input type="number" name="notelp" placeholder="NO TELEPON" required>

                        <!-- <span>Harga</span> -->
                        <input type="email" name="email" placeholder="EMAIL" required>

                    </div>

                </div>
                <div class="submit-insert">
                    <input type="submit" name="simpan" value="+ TAMBAH" class="tambah2">
                </div>

            </div>

        </form>
    </div>

    <div class="footer">
        <p>COPYRIGHT &copy 2023 TRIGUSMAETA & FADLAN</p>
    </div>


</body>

</html>