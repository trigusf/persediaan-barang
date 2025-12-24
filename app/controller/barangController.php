<?php 
session_start();
require_once '../database/database.php';

$action = $_POST['action'] ?? $_GET['action'] ?? null;

switch ($action) {
    case 'addBarang':
        addBarang();
        break;
    
    case 'editBarang':
        editBarang();

    case 'deleteBarang':
        deleteBarang();
    
    default:
        # code...
        break;
}


function addBarang(){
    global $conn;

    $idDistributor = $_POST['idDistributor'];
    
    $q = mysqli_query($conn, "SELECT kode_distributor FROM data_distributor WHERE id_distributor = '$idDistributor'");
    $dist = mysqli_fetch_assoc($q);
    $kodeDist = $dist['kode_distributor'];

    $qlast = mysqli_query($conn, "SELECT kode_barang FROM data_barang WHERE id_distributor = '$idDistributor' ORDER BY id_barang DESC LIMIT 1");
    $last = mysqli_fetch_assoc($qlast);

    if ($last) {
        $lastNumber = (int) substr($last['kode_barang'], -3);
        $nextNumber = $lastNumber + 1;
    }else {
        $nextNumber = 1;
    }

    $kodeBarang = $kodeDist . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

    $namaBarang = $_POST['namaBarang'];
    $hargaBarang = $_POST['hargaBarang'];
    $qty = $_POST['qty'];

    $sql = mysqli_query($conn, "INSERT INTO data_barang (id_distributor, kode_barang, nama_barang, harga_barang, qty) VALUES ('$idDistributor', '$kodeBarang', '$namaBarang', '$hargaBarang', '$qty')" );

    if ($sql) {
        header('Location: ../views/dataBarang.php');
    }else{
        die('Salah coy');
    }

};

function editBarang(){
    global $conn;
    $id = $_POST['idBarang'];
    $namaBarang = $_POST['namaBarang'];
    $hargaBarang = $_POST['hargaBarang'];


    $sql = mysqli_query($conn, "UPDATE data_barang SET nama_barang = '$namaBarang', harga_barang = '$hargaBarang' WHERE id_barang = '$id'");
    if($sql){
        header('Location: ../views/dataBarang.php');
    }else{
        die("data gagal diedit");   
    }
};

function deleteBarang(){
    global $conn;

    $id = $_GET['id'];

    $sql = mysqli_query($conn, "DELETE FROM data_barang WHERE id_barang = '$id'");
    if ($sql) {
        header('Location: ../views/dataBarang.php');
    }else{
        die("data tidak dapat di hapus");
    }

};




?>