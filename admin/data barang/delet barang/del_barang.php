<?php

    include '../../../koneksi/koneksi.php';

    $id = $_GET['id'];
    $sql2 = mysqli_query($koneksi, "DELETE FROM detail_barang_masuk WHERE id_barang = '$id'");
    var_dump($sql2);
    if ($sql2) {
        echo "lima";
        $sql3 = mysqli_query($koneksi, "DELETE FROM detail_barang_keluar WHERE id_barang = '$id'");
        if ($sql3) {
            $sql = "DELETE FROM data_barang WHERE id_barang = '$id'";
            $hapus = mysqli_query($koneksi, $sql);

            if ($hapus) {
                echo "
            
                        <script>
                            alert('data berhasil di hapus');
                        </script>    
            
                     ";
                     header('location:../data_barang.php');
            }else {
                echo "
            
                  
                        
                     ";
            
                     var_dump($hapus);
                  
                
            }

            }

    }
    



?>