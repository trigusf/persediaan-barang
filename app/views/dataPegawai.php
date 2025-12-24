<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
include '../database/database.php';
$page = 'dataPegawai';



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css?">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Data Pegawai</title>
</head>
<body>
    
<div class="container">

    <?php include '../partials/sidebar.php'  ?>
   

    <main>
        <div class="header">
            <p><button onclick="toggleSidebar()" class="toggle-btn">☰</button>Data Pegawai</p>
        </div>
        <div class="content">
            <div class="content-header">
                <h2>Data pegawai</h2>
            </div>

            <div class="content-main">
                
                <table>
                    <tr>
                        <th class="col-no">No</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th class="col-no">Opsi</th>
                    </tr>
                    <?php
                        $no = 1;
                        $query = "SELECT * FROM user";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <tr>
                        <td class="col-no"><?= $no++ ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['umur']; ?></td>
                        <td class="col-no"><a href="#">edit</a></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
                
            </div>
        </div>
    </main>
</div>


<script src="../../assets/js/script.js"></script>
</body>
</html>