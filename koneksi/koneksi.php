<?php
$host = "localhost";
$username = "root";
$pass = "";
$db = "db_persediaan_barang";
$koneksi = mysqli_connect($host, $username, $pass, $db);

$dns = "mysql:host=$host;dbname=$db";
$con = new PDO($dns, $username, $pass);

// check conection

if (mysqli_connect_errno()){
    echo "koneksi database gagal : " .mysqli_connect_error();
} 

?>
