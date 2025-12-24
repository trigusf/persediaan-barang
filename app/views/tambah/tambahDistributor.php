<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../assets/css/style.css?">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Tambah Distributor</title>
</head>
<body>
    <div class="tambahdata">
        <div class="back"><a href="../dataDistributor.php"><- Kembali</a></div>

        <div class="isitambahdata">
            <h1>Tambah Data Distributor</h1>
            <form action="../../controller/distributorController.php" method="post" class="formAdd">
            <input type="hidden" name="action" value="addDistributor">
            <div class="input">
                <span>Nama Distributor</span>
                <input type="text" name="namaDistributor" placeholder="Nama Distributor">
            </div>

            <div class="input">
                <span>Kode Distributor</span>
                <input type="text" name="kodeDistributor" placeholder="Kode Distributor: contoh 'KH'">
            </div>

            <div class="input">
                <span>Nama Brand</span>
                <input type="text" name="brand" placeholder="Brand">
            </div>

            <div class="input">
                <span>No.telpon</span>
                <input type="text" name="telp" placeholder="No.telp">
            </div>
            
            <div class="input">
                <span>Alamat</span>
                <textarea name="alamat" name="alamat" placeholder="alamat"></textarea>
            </div>

            <div class="input">
                <span>Email</span>
                <input type="text" name="email" placeholder="Email@gmail.com">
            </div>

            <div class="input">
                <button type="submit">Tambah</button>
            </div>

            
            </form>

        </div>
    </div>
</body>
</html>