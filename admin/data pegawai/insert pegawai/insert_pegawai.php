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
    <title>Tambah Data pegawai</title>
</head>

<body>

    <div class="back">
        <div class="bck">
            <div>
                <a href="../data_pegawai.php">
                    <i class="fa fa-solid fa-arrow-left"></i>
                    <label>Kembali</label>
                </a>
            </div>
        </div>
    </div>

    <div class="content">
        <h2>TAMBAH DATA <br>PEGAWAI</h2>


        <form action="simpanregister.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">

            <div class=" container">

                <div class="insert">
                    <div class="insert1">

                        <!-- <span>Nama Distributor</span> -->
                        <input type="file" name="img" id="imageUpload" onchange="validateFileType()" accept=".jpg, .jpeg, .png">

                        <!-- <span>Nama Distributor</span> -->
                        <input type="text" name="nama" placeholder="NAMA LENGKAP" required>


                        <!-- <span>Alamat Distributor</span> -->
                        <input type="number" name="no_telp" placeholder="NO TELEPON" required>

                        <!-- <span>Brand</span> -->
                        <input type="date" name="tgl_lahir" placeholder="TANGGAL LAHIR" required>

                        <!-- <span>Harga</span> -->
                        <select name="jk" class="status">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>

                    </div>

                    <div class="insert2">

                        <!-- <span>Nama Distributor</span> -->
                        <input type="text" name="username" placeholder="USERNAME" required>

                        <!-- <span>Nama Distributor</span> -->
                        <input type="password" name="password" placeholder="PASSWORD" required>

                        <!-- <span>Alamat Distributor</span> -->
                        <input type="password" name="confirm_password" placeholder="CONFIRM PASSWORD" required>

                        <!-- <span>Brand</span> -->
                        <textarea name="alamat" placeholder="ALAMAT LENGKAP" class="alamat"></textarea>

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




    <script type="text/javascript">
        function validateFileType() {
            var fileInput = document.getElementById('imageUpload');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            var file = fileInput.files[0];

            if (!file) {
                alert('Harap pilih file gambar sebelum menekan tombol Submit.');
                return false;
            }

            if (!allowedExtensions.exec(filePath)) {
                alert('Tipe file yang di izinkan adalah JPG, JPEG, dan PNG');
                fileInput.value = '';
                return false;
            }
        }
    </script>


</body>

</html>