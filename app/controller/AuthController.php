<?php
session_start();
require_once '../database/database.php';

$action = $_POST['action'] ?? $_GET['action'] ?? null;

switch ($action) {
    case 'login':
        login();
        break;

    case 'register':
        register();
        break;
    
    default:
        
        break;
}



    function login(){
        global $conn;

        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $cek = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        if (mysqli_num_rows($cek) === 0) {
                die('password salah');
        }

        $user = mysqli_fetch_assoc($cek);

        if (password_verify($password, $user['password'])) {
            $_SESSION['id_user'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header('Location: ../views/dashboard.php');
        }else {
            die('password salah');
        }

    }

    function register(){
        global $conn;

        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $umur = $_POST['umur'];
            
        $sql = "INSERT INTO user (username, password, umur) VALUES ('$username', '$hash', '$umur')";
        if (mysqli_query($conn, $sql)) {
            header('Location: ../../index.php');
        }else {
            echo "gagal". mysqli_error($conn);
        }


    }

    function logout(){
        session_unset();
        session_destroy();

        header('Location: ../../index.php');    
    }







?>