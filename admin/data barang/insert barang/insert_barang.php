<?php

include '../../../koneksi/koneksi.php';



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/edit.css">
    <link rel="stylesheet" href="../../../assets/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/fontawesome.min.css">
    <title>register page</title>
</head>

<body>

    <div class="back">
        <div class="bck">
            <div>
                <a href="../data_barang.php?page=1">
                    <i class="fa fa-solid fa-arrow-left"></i>
                    <label>Kembali</label>
                </a>
            </div>
        </div>
    </div>

    <div class="content">
        <h2>TAMBAH DATA <br>BARANG</h2>


        <form action="simpan_barang.php" method="post">

            <div class="container">

                <div class="insert">
                    <div class="insert1">
                        <!-- <span>tanggal masuk</span> -->


                        <!-- <span>Brand</span> -->
                        <select name="distributor" id="distributor" onchange="generateKodeBarang()" required>
                            <option value="">Pilih Distributor</option>
                            <?php
                            $resultDistributor = mysqli_query($koneksi, "SELECT * FROM data_distributor");
                            while ($rowDistributor = mysqli_fetch_assoc($resultDistributor)) {
                                echo "<option value='" . $rowDistributor['id_distributor'] . "'>" . $rowDistributor['nama_distributor'] . "</option>";
                            }
                            ?>
                        </select>



                        <!-- <span>Brand</span> -->
                        <div id="brand"></div>


                        <!-- <span>Kode Barang</span> -->
                        <input type="text" name="kode" id="kode" placeholder="KODE BARANG" readonly required>

                        <!-- <span>Nama Barang</span> -->
                        <input type="text" name="barang" placeholder="NAMA BARANG" required>

                        <!-- <span>Harga</span> -->
                        <input type="text" name="harga" placeholder="HARGA" required>

                        <div class="submit-insert">
                            <input type="submit" name="simpan" value="+ TAMBAH" class="tambah">
                        </div>


                    </div>

                </div>


            </div>

        </form>
    </div>

    <div class="footer">
        <p>COPYRIGHT &copy 2023 TRIGUSMAETA & FADLAN</p>
    </div>

    <script src="../../../assets/js/jquery-3.6.4.min.js"></script>

    <script>
        function generateKodeBarang() {
            var distributor = $('#distributor').val();
            if (distributor != "") {
                $.ajax({
                    url: 'generate_kode_barang.php',
                    method: 'GET',
                    data: {
                        distributor: distributor
                    },
                    success: function(response) {
                        $('#kode').val(response);
                    }
                });
            }
        }

        $(document).ready(function() {
            $("#distributor").change(function() {
                var data = {
                    data: $(this).val()
                };
                console.log(data)
                $.ajax({
                    url: "get_brand.php",
                    method: "POST",
                    data: data,
                    dataType: "html",
                    success: function(response) {
                        $("#brand").html(response)
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                })
            })
        })
    </script>

</body>

</html>