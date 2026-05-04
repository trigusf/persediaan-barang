<?php


    include '../../koneksi/koneksi.php';

    if (isset($_POST['simpan'])) {
            $id = $_POST['id_biodata'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $nama = $_POST['nama'];
            $telp = $_POST['no_telp'];
            $jk = $_POST['jk'];
            $alamat = $_POST['alamat'];
            $tgl = $_POST['tgl_lahir'];

            

            $result = mysqli_query($koneksi, "UPDATE biodata SET nama ='$nama' ,no_telp ='$telp' ,jk ='$jk' ,alamat ='$alamat' ,tgl_lahir ='$tgl' WHERE id_biodata = '$id'" );

            header("location:edit_profile.php");

    } 

    if (isset($_POST['save'])) {
            $id = $_POST['id_biodata'];
            $img = $_FILES['foto']['name'];
            $file_tmp = $_FILES['foto']['tmp_name'];

            move_uploaded_file($file_tmp, '../../assets/profile photo/' .$img);

            $result2 = mysqli_query($koneksi, "UPDATE biodata SET foto ='$img' WHERE id_biodata = '$id'");

            header("location:edit_profile.php");
    }
