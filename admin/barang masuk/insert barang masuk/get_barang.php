<?php
include '../../../koneksi/koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['data'];
?>
    <span>Nama Barang</span>
    <select name="nama_barang" id="nama_barang">
        <option value="">Pilih</option>

        <?php
        $query = "SELECT * FROM data_barang WHERE id_distributor = '$id'";
        $result = mysqli_query($koneksi, $query);
        while ($barang = mysqli_fetch_assoc($result)) {
            if ($barang['status_barang'] == 'Tersedia' || $barang['status_barang'] == 'Tidak Tersedia') {
                echo '<option value="' . $barang['id_barang'] . '">' . $barang['nama_barang'] . '</option>';
            } else {
                echo '<option disabled value="' . $barang['id_barang'] . '">' . $barang['nama_barang'] . '</option>';
            }
        }

        if (isset($_POST['status'])) {
            $status = $_POST['status'];
            if ($status == 'NONAKTIF') {
            }
        }
        ?>

    </select>
    <span>Jumlah</span>
    <input type="number" name="stock" placeholder="STOCK" min="1">

<?php } ?>