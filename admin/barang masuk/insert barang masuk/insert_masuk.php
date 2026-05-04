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
    <title>Barang Masuk</title>
</head>

<body>

    <div class="back">
        <div class="bck">
            <div>
                <a href="../barang_masuk.php?page=1">
                    <i class="fa fa-solid fa-arrow-left"></i>
                    <label>Kembali</label>
                </a>
            </div>
        </div>
    </div>

    <div class="barang-masuk">
        <div class="masuk">
            <h2>TAMBAH DATA <br>BARANG MASUK</h2>
        </div>

        <form action="" method="post">

            <div class="container">

                <div class="insert">
                    <div class="insert-masuk-1">

                        <span>Tanggal Pembelian</span>
                        <input type="text" name="tanggal" disabled value="<?php
                                                                            date_default_timezone_set("Asia/Jakarta");
                                                                            echo date("d-m-Y");
                                                                            ?>">


                        <form action="" method="post">
                            <span>Distributor</span>
                            <select name="distributor" id="distributor">
                                <option value="">Pilih</option>
                                <?php

                                $query = "SELECT * FROM data_distributor";
                                $result = mysqli_query($koneksi, $query);

                                while ($distributor = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $distributor['id_distributor'] . '">' . ($distributor['nama_distributor']) . '</option>';
                                };

                                ?>
                            </select>

                            <div id="barang">

                            </div>

                            <div class="submit-masuk">
                                <input type="submit" id="distributor" name="simpan" value="+ TAMBAH">
                            </div>
                        </form>




                    </div>
        </form>

        <div class="insert-masuk-2">
            <div class="table1">
                <form action="aksi_insert.php" method="post" class="form-table">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>nama barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Catatan</th>
                            <th>Subtotal</th>
                        </tr>

                        <?php

                        session_start();
                        $awal = 1;
                        $sub = 0;
                        $total = 0;




                        if (@$_POST["nama_barang"] != '') {
                            if (empty($_SESSION["isi"]) == TRUE) {
                                $_SESSION["isi"] = 1;
                            } else {
                                $_SESSION["isi"]++;
                            }

                            $_SESSION['distributor'] = $_POST['distributor'];
                            $_SESSION['nama_barang'] = $_POST['nama_barang'];
                            $_SESSION['stock'] = $_POST['stock'];
                            header('location: ./insert_masuk.php');

                            @$idbarang = $_POST['nama_barang'];
                            $tampil = mysqli_fetch_array(
                                mysqli_query($koneksi, "SELECT * FROM data_barang
                                            WHERE id_barang = '$idbarang'")
                            );
                            var_dump($tampil);

                            @$idkondisi = $_POST['kondisi'];
                            $tampil2 = mysqli_fetch_array(
                                mysqli_query($koneksi, "SELECT * FROM kondisi_barang WHERE id_kondisi = '1'")
                            );


                            @$kondisi = $tampil2['kondisi'];
                            @$brand = $tampil['nama_barang'];
                            @$harga = $tampil['harga_barang'];
                            @$stock = trim($_POST['stock']);
                            @$sub = $harga * $stock;
                            @$iddistributor = $_POST['distributor'];
                            $_SESSION['akhir'][$_SESSION["isi"]] = [
                                $brand,
                                $harga,
                                $stock,
                                $sub,
                                $idbarang,
                                $iddistributor,
                                $kondisi,
                                $idkondisi
                            ];
                        }
                        @$awal = $_SESSION["isi"];
                        $_SESSION['isi'] = $awal;
                        for ($i = 1; $i <= $awal; $i++) {
                            if (@$_SESSION['akhir'][$i][0] != '') { ?>

                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo @$_SESSION['akhir'][$i][0] ?></td>
                                    <td><?php echo "Rp. " . number_format(@$_SESSION['akhir'][$i][1]) ?></td>
                                    <td><?php echo @$_SESSION['akhir'][$i][2] ?></td>
                                    <td><?php echo @$_SESSION['akhir'][$i][6] ?></td>
                                    <td><?php echo "Rp. " . number_format(@$_SESSION['akhir'][$i][3]) ?></td>
                                    <td hidden><?php echo @$_SESSION['akhir'][$i][4] ?> </td>
                                </tr>


                        <?php }

                            $total = @$_SESSION['akhir'][$i][3] + $total;
                            @$_SESSION['total'] = $total;
                        } ?>


                        <tr>
                            <td colspan=5>
                                <?php echo "Total"; ?>
                            </td>

                            <td>
                                <?php echo "Rp. " . number_format($total); ?>
                            </td>
                        </tr>

                    </table>
                    <div class="btn">
                        <a href="delete.php" onclick="return confirm(' menghapus semua data?')">Delete</a>
                        <input type="submit" value="simpan" name="simpan">
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="footer">
        <p>COPYRIGHT &copy 2023 TRIGUSMAETA & FADLAN</p>
    </div>
    <script src="../../../assets/js/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#distributor").change(function() {
                var data = {
                    data: $(this).val()
                };
                console.log(data)
                $.ajax({
                    url: "get_barang.php",
                    method: "POST",
                    data: data,
                    dataType: "html",
                    success: function(response) {
                        $("#barang").html(response)
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