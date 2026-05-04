<?php
include '../../koneksi/koneksi.php';

echo 'Error'. '<br>';

if(isset($_POST['simpan'])){
    $status = $_POST['status'];
}

if($status == NULL){
echo 'Error System: '. var_dump($status);
}
?>