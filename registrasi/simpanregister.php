<?php

include '../koneksi/koneksi.php';
if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $username = $_POST['username'];
    $pass = md5($_POST['password']);
    $alamat = $_POST['alamat'];
    $tgl = $_POST['tgl'];
    $jk = $_POST['kelamin'];
    $lvl = 2;

    // img

    $img = $_FILES['img']['name'];
    $file_tmp = $_FILES['img']['tmp_name'];

    move_uploaded_file($file_tmp, '../assets/profile photo/' . $img);

    // end img

    $query = "INSERT INTO biodata VALUE
                       (NULL, '$img', '$username', '$pass', '$nama', '$alamat', '$telp', '$tgl', '$jk', '$lvl')";
    $proses = mysqli_query($koneksi, $query);

    if ($proses) {
        echo
        "
                    <script>
                        alert('Data Berhasil Di Simpan');
                        document.location='../index.php'
                    </script>

                ";

    } else {
        echo
        "
                    <script>
                        alert('Data Gagal Di Simpan');
                        document.location='../index.php'
                    </script>

                ";
    }
}
