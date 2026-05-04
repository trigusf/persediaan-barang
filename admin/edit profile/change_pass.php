<?php

session_start();
if (isset($_SESSION['username'])) {
    include '../../koneksi/koneksi.php';
} else {
    header('location:../index.php');
}

$username = $_SESSION['username'];
$query = mysqli_query($koneksi, "SELECT * FROM biodata INNER JOIN role ON biodata.level = role.level where username = '$username'");
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
                <a href="edit_profile.php">
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

            <form action="simpan_edit.php" method="post" enctype="multipart/form-data" class="image">
                <div class="edit-photo">
                    <input type="file" name="foto">
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
                <span>Ganti Password</span>
            </div>



            <form action="simpan_pass.php" method="post">
                <div class="from">
                    <div class="judul-isi">*Masukan Password Lama Anda</div>

                    <div class="acc-info">

                        <div class="isi">
                            <span>Password</span> <br>
                            <input type="password" id="passwordInput" name="old_pass" value="" placeholder="Masukan password lama anda" required> <div class="toggle-login a4">
                            <i class="fa-solid fa-eye" id="togglePassword"></i>
                </div> <br>

                        </div>

                    </div>


                    <div class="judul-isi">*Masukan Password Baru Anda</div>

                    <div class="data-pribadi">


                        <div class="isi">
                            <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
                            <span>password</span> <br>
                            <input type="password" name="new_pass" value="" placeholder="Masukan password baru anda"> <br>

                            <span>password confirm</span> <br>
                            <input type="password" name="confirm_pass" value="" placeholder="Konfirmasi password baru anda"> <br>

                            <span></span><br>
                            <input type="hidden" name="id_biodata" value="<?= $id ?>">
                            <input type="reset" value="Reset" name="hapus" onclick="return confirm('Yakin ingin mereset semuanya?')"><br>
                            <input type="submit" value="Simpan" name="simpan" onclick="return confirm('Yakin ingin mengubah password anda?')">

                        </div>





                    </div>


                </div>
            </form>

        </div>
    </div>
    <!-- END OF CONTENT -->

    <script src="../../assets/js/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
  var passwordInput = $('#passwordInput');
  var togglePassword = $('#togglePassword');

  togglePassword.click(function() {
    var type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
    passwordInput.attr('type', type);
    togglePassword.toggleClass('fa-eye fa-eye-slash');
  });
});
    </script>

</body>

</html>