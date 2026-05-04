<?php
include '../../../koneksi/koneksi.php';

if (isset($_GET['distributor'])) {
    $distributor = $_GET['distributor'];

    // Query untuk mendapatkan kode barang terakhir dengan inisial brand yang sama
    $query = "SELECT * FROM data_barang INNER JOIN data_distributor ON data_barang.id_distributor = data_distributor.id_distributor WHERE data_distributor.id_distributor = '$distributor' ORDER BY kode_barang DESC LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastCode = $row['kode_barang'];

        // Ambil huruf pertama dari nama brand
        $brandFirstLetter = strtoupper(substr($row['brand'], 0, 1));

        // Ambil huruf kedua dari nama brand
        $brandSecondLetter = strtoupper(substr($row['brand'], 1, 1));

        // Ambil angka dari kode barang terakhir
        $lastNumber = intval(substr($lastCode, -3));

        // Generate kode barang baru dengan penambahan 1
        $newNumber = $lastNumber + 1;
        $newCode = str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Generate kode barang lengkap dengan format HurufPertamaBrandHurufKeduaBrand-001, HurufPertamaBrandHurufKeduaBrand-002, dst.
        $kodeBarang = $brandFirstLetter . $brandSecondLetter . "-" . $newCode;

        // Periksa apakah kode barang sudah digunakan sebelumnya
        $queryCheck = "SELECT * FROM data_barang WHERE kode_barang = '$kodeBarang'";
        $resultCheck = mysqli_query($koneksi, $queryCheck);

        if ($resultCheck && mysqli_num_rows($resultCheck) > 0) {
            // Jika kode barang sudah digunakan, tambahkan angka pada akhir kode hingga ditemukan kode yang belum digunakan
            $i = 2;

            while ($rowCheck = mysqli_fetch_assoc($resultCheck)) {
                $newCode = str_pad($lastNumber + $i, 3, '0', STR_PAD_LEFT);
                $kodeBarang = $brandFirstLetter . $brandSecondLetter . "-" . $newCode;

                $queryCheck = "SELECT * FROM data_barang WHERE kode_barang = '$kodeBarang'";
                $resultCheck = mysqli_query($koneksi, $queryCheck);

                $i++;
            }
        }
    } else {
        // Jika belum ada kode barang sebelumnya, generate kode barang awal dengan huruf pertama dan kedua brand
        $queryDistributor = "SELECT * FROM data_distributor WHERE id_distributor = '$distributor'";
        $resultDistributor = mysqli_query($koneksi, $queryDistributor);
        if ($resultDistributor && mysqli_num_rows($resultDistributor) > 0) {
            $rowDistributor = mysqli_fetch_assoc($resultDistributor);
            $brandFirstLetter = strtoupper(substr($rowDistributor['brand'], 0, 1));
            $brandSecondLetter = strtoupper(substr($rowDistributor['brand'], 1, 1));
        }

        $kodeBarang = $brandFirstLetter . $brandSecondLetter . "-001";
    }

    echo $kodeBarang;
}
?>
