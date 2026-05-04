<?php
include '../../../koneksi/koneksi.php';
if (isset($_POST['simpan'])) {
    $distributor = $_POST['distributor'];
    $harga = $_POST['harga'];
    $barang = $_POST['barang'];
    $date = date("Y-m-d");
    $data_brand = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM data_distributor WHERE id_distributor = '$distributor'"));
    $nama_brand = strtoupper(substr($data_brand['brand'], 0, 2)); // Mengambil 2 huruf awal dari nama brand
    $stock = 0;
    $status = '';

    if ($stock > 0) {
        $status = 'Tersedia';
    } else {
        $status = 'Tidak Tersedia';
    }

    $query = "SELECT MAX(kode_barang) AS max_kode FROM data_barang WHERE id_distributor = '$distributor'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    $lastCode = $row['max_kode'];

    // Membuat kode barang baru
    if ($lastCode) {
        $number = intval(substr($lastCode, -3));
        $number++;
        $newCode = $nama_brand . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    } else {
        $newCode = $nama_brand . '-001';
    }
    $query = "INSERT INTO data_barang VALUES (null, '$distributor', '$date', '$newCode', '$barang', '$stock', '$harga', '$status')";

    $proses = mysqli_query($koneksi, $query);

    if ($proses) {
        $lastInsertedId = mysqli_insert_id($koneksi);

        // $logQuery = "INSERT INTO log_databarang (id_log, id_barang, id_distributor, aktifitas) VALUES ('$lastInsertedId', '$newCode', '$distributor', 'INSERT DATA')";

        // mysqli_query($koneksi, $logQuery);

        echo "
            <script>
                alert('Data Berhasil Disimpan');
                window.location.href='../data_barang.php?page=1';
            </script>
        ";
    } else {
        echo 'Error: Failed to insert data. ' . mysqli_error($koneksi);
    }
}
