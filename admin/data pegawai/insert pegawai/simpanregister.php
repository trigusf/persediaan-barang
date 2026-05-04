<?php

include '../../../koneksi/koneksi.php';

$defaultFotoProfil = 'default-profile-pic-e1513291410505.jpg';
$uploadDirectory = '../../../assets/profile photo/';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $telp = $_POST['no_telp'];
    $username = $_POST['username'];
    $pass = md5($_POST['password']);
    $alamat = $_POST['alamat'];
    $tgl = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    $lvl = 2;

    // img
    if (!empty($_FILES['img']['name'])) {
        $img = $_FILES['img']['name'];
        $file_tmp = $_FILES['img']['tmp_name'];
        $uploadPath = $uploadDirectory . $img;

        // Pindahkan file gambar ke direktori yang ditentukan
        move_uploaded_file($file_tmp, $uploadPath);
    } else {
        // Jika tidak ada file gambar yang diunggah, gunakan foto profil default
        $img = $defaultFotoProfil;
    }
    // end img

    $pass_confirm = $_POST['confirm_password'];
    if ($pass !== md5($pass_confirm)) {
        $error = "Password/Konfirmasi Password Tidak Sama. Coba Lagi.";
    } else {
        $query = "INSERT INTO biodata VALUES (NULL, '$img', '$username', '$pass', '$nama', '$alamat', '$telp', '$tgl', '$jk', '$lvl')";
        $proses = mysqli_query($koneksi, $query);

        if ($proses) {
            echo "
                <script>
                    alert('Data berhasil disimpan');
                    window.location.href = '../data_pegawai.php';
                </script>
            ";
        } else {
            $error = "Terjadi kesalahan saat menyimpan data";
        }
    }
}

if (isset($error)) {
    echo "
        <script>
            alert('$error');
            window.location.href = 'javascript:history.back()';
        </script>
    ";
}
