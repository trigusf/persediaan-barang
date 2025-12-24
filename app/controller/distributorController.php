<?php
session_start();

require_once '../database/database.php';

$action = $_POST['action'] ?? $_GET['action'] ?? null;

switch ($action) {
    case 'addDistributor':
        addDistributor();
        break;

    case 'editDistributor':
        editDistributoR();
        break;

    case 'deleteDistributor':
        deleteDistributor();
    
    default:
        # code...
        break;
}


function addDistributor(){
    global $conn;

    $namaDistributor = $_POST['namaDistributor'];
    $kodeDistributor = $_POST['kodeDistributor'];
    $brand = $_POST['brand'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];

    $sql = "INSERT INTO data_distributor (kode_distributor, nama_distributor, brand, alamat, telp, email) VALUES ('$kodeDistributor', '$namaDistributor', '$brand', '$alamat', '$telp', '$email')";
    if (mysqli_query($conn, $sql)) {
        header('Location: ../views/dataDistributor.php');
    }else {
        die('gagal menyimpan data');
    }

}

function editDistributor(){
    global $conn;

    $id = $_POST['idDistributor'];
    $namaDistributor = $_POST['namaDistributor'];
    $brand = $_POST['brand'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];

    $sql = "UPDATE data_distributor SET nama_distributor = '$namaDistributor', brand = '$brand', alamat = '$alamat', telp = '$telp', email = '$email' WHERE id_distributor = '$id'";
    if (mysqli_query($conn, $sql)) {
        header('Location: ../views/dataDistributor.php');
    }else {
        die('gagal mengedit data');
    }



}

function deleteDistributor(){
    global $conn;

    $id = $_GET['id'];

    $sql = "DELETE FROM data_distributor WHERE id_distributor = '$id'";
    if (mysqli_query($conn, $sql)) {
        header('Location: ../views/dataDistributor.php');
    }else {
        die('gagal hapus data');
    }
}




?>