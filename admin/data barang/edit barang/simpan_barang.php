<?php

include '../../../koneksi/koneksi.php';

$id = $_GET['id'];
//check if from is submitted for user update, then redirect to hompage after update
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $kode = $_POST['kode'];
    $brand = $_POST['brand'];
    $harga = $_POST['harga'];
    $barang = $_POST['barang'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];

    echo "$id <br>";
    echo "$kode <br>";
    echo "$brand <br>";
    echo "$harga <br>";
    echo "$barang <br>";
    echo "$stock <br>";
    echo "$status <br>";

    $result = mysqli_query($koneksi, "UPDATE data_barang SET kode_barang ='$kode' ,nama_barang ='$barang' ,stock_barang ='$stock' ,harga_barang ='$harga' ,status_barang ='$status' WHERE id_barang = '$id'");

    if ($result) {
        echo "  <script>
                alert('Data Berhasil Di Simpan');
                document.location='../data_barang.php?page=1'
            </script>
         ";
    }
}

?>

<?php

$id = $_GET['id'];

$result = mysqli_query($koneksi, "SELECT * FROM data_barang INNER JOIN data_distributor ON data_barang.id_distributor = data_distributor.id_distributor WHERE id_barang = '$id' ");

while ($user_data = mysqli_fetch_array($result)) {
    $kode_barang = $user_data['kode_barang'];
    $brand_barang = $user_data['brand'];
    $harga_barang = $user_data['harga_barang'];
    $nama_barang = $user_data['nama_barang'];
    $stock_barang   = $user_data['stock_barang'];
    $status_barang = $user_data['status_barang'];

    echo "  <script>
                alert('Data Berhasil Di Simpan');
                document.location='../data_barang.php?page=1'
            </script>
        ";
}




?>