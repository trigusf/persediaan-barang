<?php

include 'app/database/database.php';


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="parent">
        <div class="card">
            <div class="header-index">
                <span>Login</span>
                <p>Don't have an account? <a href="app/views/register.php">Sign Up</a></p>
            </div>
            <div class="input">
                <form action="app/controller/AuthController.php" method="post">
                    <input type="hidden" name="action" value="login">
                    <div class="credential">
                        <label for="">Username</label>
                        <input type="text" name="username" placeholder="">
                    </div>
                    <div class="credential">
                        <label for="">Password</label>
                        <input type="password" name="password" placeholder="">

                        <div class="save">
                            <label for=""><input type="checkbox" name="remember" id="remember"> Remember me</label>
                        <a href="#">Forgot Password?</a>
                    </div>
                    <div class="credential">
                        <button type="submit">Login</button>
                    </div>
                    </div>
                </form>
                <div class="line">OR</div>

                <div class="other">
                    <a href="#"><i class="fa-brands fa-apple"></i> Login With Apple</a>
                    <a href="#"><i class="fa-brands fa-google"></i> Login With Google</a>
                    <a href="#"><i class="fa-brands fa-facebook"></i> Login With Facebook</a>
                </div>
            </div>
            <div class="other"></div>
        </div>
    </div>
</body>
</html>