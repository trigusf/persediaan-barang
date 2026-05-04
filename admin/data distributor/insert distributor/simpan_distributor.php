<?php
    include '../../../koneksi/koneksi.php';
    if (isset($_POST['simpan'])) {
        $distributor = $_POST['distributor'];
        $alamat = $_POST['alamat'];
        $notelp = $_POST['notelp'];
        $email = $_POST['email'];
        $brand = $_POST['brand'];


        $query = "INSERT INTO data_distributor VALUES (null, '$distributor', '$brand', '$alamat', '$notelp', '$email')";
        $proses = mysqli_query($koneksi, $query);
   


        if ($proses) {
            echo 
            "
                <script>
                    alert('Data Berhasil Disimpan');
                    document.location='../data_distributor.php?page=1'
                </script>
                
            ";
        }else {
            echo
            "
            
                <script>
                alert('Data Gagal Ditambahkan');
                document.location='location:../data_distributor.php?page=1'
                </script>
                
            ";
        }
    }




?>