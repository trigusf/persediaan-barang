<?php

include '../../database/database.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['barang'])) {
    echo json_encode(['status' => 'error', 'message' => 'No barang data provided']);
    exit;
}

$barangMasuk = $data['barang'];

mysqli_begin_transaction($conn);

try{
    foreach ($barangMasuk as $item) {
        $idDistributor = $item['id_distributor'];
        $idBarang = $item['id_barang'];
        $qty = $item['qty'];
        $harga = $item['harga'];
        $subtotal = $item['subtotal'];

        $insertQuery = "INSERT INTO barang_masuk (id_distributor, id_barang, qty, harga, subtotal) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, 'iiiid', $idDistributor, $idBarang, $qty, $harga, $subtotal);
        mysqli_stmt_execute($stmt);
    }

    mysqli_commit($conn);
    echo json_encode(['status' => 'success', 'message' => 'Barang masuk saved successfully']);
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo json_encode(['status' => 'error', 'message' => 'Failed to save barang masuk: ' . $e->getMessage()]);
}


?>