<?php
session_start();
include '../../database/database.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Tambah Barang</title>
</head>
<body>
    <div class="tambahdata">
        <div class="back"><a href="../barangMasuk.php"><- Kembali</a></div>

        <div class="isitambahdata">
            <h1>Barang Masuk</h1>
            <div class="datamasuk">
                <form action="#" method="post" class="formAdd">
                <input type="hidden" name="action" value="addBarangMasuk">
                <div class="input">
                    <span>Distributor</span>
                    <select name="idDistributor" id="distributor">
                        <option value="" disabled selected>Pilih Distributor</option>
                        <?php 

                        $dataDistributor = mysqli_query($conn, "SELECT id_distributor, nama_distributor FROM data_distributor");

                        while ($row = mysqli_fetch_assoc($dataDistributor)):
                        ?>
                        <option value="<?= $row['id_distributor'] ?>" >
                            <?= $row['nama_distributor'] ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="input">
                    <span>Nama Barang</span>
                    <select name="idBarang" id="barang">
                        
                    </select>   
                </div>

                <input type="hidden" name="harga" placeholder="harga" id="harga">
                
                <div class="input">
                    <span>QTY</span>
                    <input type="number" name="qty" placeholder="qty" id="qty">
                </div>


                <div class="input">
                    <button type="Button" onclick="tambahBarang()">Tambah</button>
                </div>

                
                </div>     
            </form>
            
            
            <div class="tablemasuk">
                <table>
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Distributor</td>
                            <td>Nama Barang</td>
                            <td>QTY</td>
                            <td>Subtotal</td>
                        </tr>
                    </thead>
                    <tbody id="tableBarang">

                    </tbody>
                    <tr class="tablefooter">
                        <td colspan="3"><b>Total</b></td>
                        <td id="totalQTY">0</td>
                        <td id="totalHarga">0</td>
                    </tr>
                </table>
                
                <div class="input">
                    <input type="button" onclick="simpanBarangMasuk()" value="Simpan Barang Masuk">
                </div>
            </div>
        </div>
    </div>








<script src="../../../assets/js/script.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() { 

    document.getElementById('distributor');

    document.getElementById('distributor').addEventListener('change', function() {
        console.log('change', this.value);  
        let idDistributor = this.value;

        if(!idDistributor) {
            document.getElementById('barang').innerHTML = '<option>Pilih Barang</option>';
            return;
        }

        fetch('../get/get_barang.php?id=' + idDistributor)
            .then(res => res.text())
            .then(data => {
                document.getElementById('barang').innerHTML = data;
            });
    });

    document.getElementById('barang').addEventListener('change', function() {
        console.log('change barang', this.value);  
        let idBarang = this.value;
        let hargaInput = document.getElementById('harga');

        if(!idBarang) {
            hargaInput.value = '';  
            return;
        }

        fetch('../get/get_harga.php?id=' + idBarang)
            .then(res => res.text())
            .then(data => {
                hargaInput.value = data; 
            });
    });    
});
</script>
</body>
</html>