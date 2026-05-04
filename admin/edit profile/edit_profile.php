<?php

session_start();
if (isset($_SESSION['username'])) {
    include '../../koneksi/koneksi.php';
} else {
    header('location:../index.php');
}

$username = $_SESSION['username'];
$query = mysqli_query($koneksi, "SELECT * FROM biodata INNER JOIN role ON biodata.level = role.level WHERE username = '$username'");
$row = mysqli_fetch_array($query);
$id = $row['id_biodata'];
$name = $row['nama'];
$us = $row['username'];
$photo = $row['foto'];
$password = $row['password'];
$notelp = $row['no_telp'];
$alamat = $row["alamat"];
$tgl = $row['tgl_lahir'];
$gender = $row['jk'];
$level = $row['nama_level'];


$days = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
);

$months = array(
    'Jan' => 'Januari',
    'Feb' => 'Februari',
    'Mar' => 'Maret',
    'Apr' => 'April',
    'May' => 'Mei',
    'Jun' => 'Juni',
    'Jul' => 'Juli',
    'Aug' => 'Agustus',
    'Sep' => 'September',
    'Oct' => 'Oktober',
    'Nov' => 'November',
    'Dec' => 'Desember'
);

if (isset($_GET['page'])) {
    $aktif_page = $_GET['page'];
} else {
    $aktif_page = 1;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/edit.css">
    <link rel="stylesheet" href="../../assets/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/fontawesome.min.css">
    <script src="assets/js/jquery-3.6.4.min.js"></script>
    <title>Profile</title>
</head>

<body>
    <div id="content">



        <!-- SIDEBAR -->


        <div class="navbar">
            <div class="back-1">
                <a href="../dashboard.php">
                    <div class="btn">
                        <div><i class="fa-solid fa-arrow-left"></i></div>
                    </div>

                    <div class="kembali-1">
                        Profile
                    </div>
                </a>
            </div>

            <!-- <div class="photo"> -->
            <?php

            $foto =  mysqli_query($koneksi, "SELECT foto FROM biodata where username = '$username'");
            while ($img = mysqli_fetch_array($foto)) { ?>

                <img src="../../assets/profile photo/<?= $img['foto'] ?>" alt="photo profile" width="150px" height="150px">

            <?php } ?>
            <!-- </div>  -->

            <form action="simpan_edit.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();" class="image">
                <div class="edit-photo">
                    <input type="file" name="foto" id="imageUpload" onchange="validateFileType()" accept=".jpg, .jpeg, .png">
                    <div>Ubah Foto Profile <i class="fa-solid fa-pen"></i></div>
                    <input type="hidden" name="id_biodata" value="<?= $id ?>">
                </div>
                <input type="submit" value="simpan foto" name="save" class="save-btn" onclick="return confirm('Yakin ingin mengubah foto profil anda?')"> <br>


            </form>

            <h3><?= $name ?></h3>

            <a class="edit_prof">@<?= $username ?></a>
            <hr>
            <div class="nav">

                <span class="supervisor"><?= $level ?></span>

            </div>

        </div>


        <!-- END SIDEBAR -->




        <!-- CONTENT -->
        <div class="profile">

            <div class="judul">
                <span>Profile Info</span>
            </div>



            <form action="simpan_edit.php" method="post">
                <div class="from">
                    <div class="judul-isi">Info Akun</div>

                    <div class="acc-info">

                        <div class="isi">
                            <span>Username</span> <br>
                            <input type="text" name="username" value="<?= $username ?>" disabled> <br>
                        </div>

                        <div class="isi">
                            <span></span>
                            <a href="change_pass.php">*Change Password</a>
                        </div>

                    </div>


                    <div class="judul-isi">Data Pribadi</div>

                    <div class="data-pribadi">


                        <div class="isi">
                            <span>Nama Lengkap</span> <br>
                            <input type="text" name="nama" value="<?= $name ?>"> <br>

                            <span>No Telepon</span> <br>
                            <input type="number" name="no_telp" value="<?= $notelp ?>"> <br>

                            <span>Jenis Kelamin</span> <br>
                            <select name="jk" id="">
                                <option value="Laki-laki" <?= $gender == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="Perempuan" <?= $gender == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="isi">
                            <span>Alamat</span> <br>
                            <input type="text" name="alamat" value="<?= $alamat ?>"> <br>

                            <span>Tanggal Lahir</span> <br>
                            <input type="date" name="tgl_lahir" value="<?= $tgl ?>"> <br>


                            <span></span><br>
                            <input type="hidden" name="id_biodata" value="<?= $id ?>">
                            <input type="submit" value="simpan" name="simpan" onclick="return confirm('Yakin ingin mengubah biodata anda?')">
                        </div>




                    </div>


                </div>
            </form>

        </div>
    </div>
    <!-- END OF CONTENT -->

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