<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
include '../database/database.php';
$page = 'dashboard'



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css?">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dashboard</title>
</head>
<body>
    
<div class="container">
    <?php include '../partials/sidebar.php'  ?>

    <main>
        <div class="header">
            <p><button onclick="toggleSidebar()" class="toggle-btn">☰</button>Dashborad</p>
        </div>
        <div class="content">
            <div class="content-header">
                <p>Selamat Datang, 
                    <br> 
                    <b><?php echo $_SESSION['username'] ?></b>
                </p>

                <p><?php echo date("l")   ?> <br> <b><?php echo date("d F") ?></b></p>
            </div>

            <div class="content-main">
                <h1>Dashboard</h1>
                <p>Anda Telah Masuk Sebagai <b><?php echo $_SESSION['username'] ?></b><br>
                    Anda Dapat Mengelola Website Persediaan Barang
                </p>
            </div>
        </div>
    </main>
</div>


<script src="../../assets/js/script.js"></script>
</body>
</html>