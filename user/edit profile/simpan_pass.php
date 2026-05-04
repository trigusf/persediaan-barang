<?php

include '../../koneksi/koneksi.php';

$old_pass = md5($_POST['old_pass']);

$username = $_POST['username'];

$query = mysqli_query($koneksi, "SELECT * FROM biodata WHERE username = '$username' AND password = '$old_pass'");

$result = mysqli_fetch_array($query);

if ($result) {

    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    if ($new_pass == $confirm_pass) {
        $pass_fix = md5($confirm_pass);
        $query2 = mysqli_query($koneksi, "UPDATE biodata set password = '$pass_fix' WHERE id_biodata = '$result[id_biodata]'");

        if ($query2) {
            echo
            "
                <script>
                    alert('Password anda berhasil di ubah, silahkan logout untuk menguji password baru anda!');
                    document.location='edit_profile.php'
                </script>
                ";
        }
    } else {
        echo
        "
                <script>
                    alert('Maaf, password baru & konfirmasi password yang anda inputkan tidak sama!');
                    document.location='change_pass.php'
                </script>
                ";
    }
} else {
    echo
    "
        <script>
            alert('Maaf, Password lama anda tidak sesuai/tidak terdaftar!');
            document.location='change_pass.php'
        </script>
        ";
}
