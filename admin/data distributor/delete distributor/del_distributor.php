<?php

include '../../../koneksi/koneksi.php';

$id = $_GET['id'];

// Hapus data terkait dari tabel detail_barang_masuk
$sql2 = mysqli_query($koneksi, "DELETE FROM detail_barang_masuk WHERE id_distributor = '$id'");
if ($sql2) {
    // Hapus data terkait dari tabel detail_barang_keluar
    $sql3 = mysqli_query($koneksi, "DELETE FROM detail_barang_keluar WHERE id_distributor = '$id'");
    if ($sql3) {
        // Hapus data terkait dari tabel log_databarang
        $sql4 = mysqli_query($koneksi, "DELETE FROM log_databarang WHERE id_barang IN (SELECT id_barang FROM data_barang WHERE id_distributor = '$id')");
        if ($sql4) {
            // Hapus data terkait dari tabel data_barang
            $sql5 = mysqli_query($koneksi, "DELETE FROM data_barang WHERE id_distributor = '$id'");
            if ($sql5) {
                // Hapus data distributor dari tabel data_distributor
                $sql = "DELETE FROM data_distributor WHERE id_distributor = '$id'";
                $hapus = mysqli_query($koneksi, $sql);
                if ($hapus) {
                    // Jika semua data berhasil dihapus
                    echo "
                    <script>
                        alert('Data berhasil dihapus');
                    </script>    
                    ";
                    header('location:../data_distributor.php');
                } else {
                    // Jika data distributor gagal dihapus
                    echo "
                    <script>
                        alert('Data gagal dihapus');
                    </script>    
                    ";
                    header('location:../data_distributor');
                }
            }
        }
    }
}
?>
