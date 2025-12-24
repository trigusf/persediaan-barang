<?php
include "../../database/database.php";

if(empty($_GET['id'])){
    exit;
}

$id = intval($_GET['id']); 
 $q = mysqli_query($conn, "SELECT harga_barang FROM data_barang WHERE id_barang = '$id' LIMIT 1");

while($row = mysqli_fetch_assoc($q)){
    echo $row['harga_barang'];
}

?>