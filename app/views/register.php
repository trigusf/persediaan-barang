<?php

include '../database/database.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Register</title>
</head>
<body>
    <div class="parent">
        <div class="card">
            <div class="header">
                <span>Register</span>
            </div>
            <div class="input">
                <form action="../controller/AuthController.php" method="post">
                    <input type="hidden" name="action" value="register">
                    <div class="credential">
                        <label for="">username</label>
                        <input type="text" name="username" placeholder="">
                    </div>
                    <div class="credential">
                        <label for="">Password</label>
                        <input type="password" name="password" placeholder="">
                    </div>
                    <div class="credential">
                        <label for="">Umur</label>
                        <input type="text" name="umur" placeholder="">
                    </div>
                    <div class="credential">
                        <button type="submit">Register</button>
                    </div>
                     <div class="credential">
                        <a href="../../index.php">back</a>
                    </div>
                    </div>
                </form>
        </div>
    </div>
</body>
</html>