<?php

include '../../../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['data'];

    $query = mysqli_query($koneksi, "SELECT * FROM data_distributor WHERE id_distributor = '$id'");

    if ($query && mysqli_num_rows($query) > 0) {
        $brand = mysqli_fetch_assoc($query)['brand']; ?>

        <input type="text" name="brand" id="brand" placeholder="BRAND" value="<?php echo $brand ?>" disabled>

<?php }
} ?>