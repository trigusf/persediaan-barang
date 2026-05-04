<?php

    session_start();
    include "koneksi.php";
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $sql = "SELECT * from biodata where username = '$username' and password = '$password'";

    $query = mysqli_query($koneksi,$sql);
    if (mysqli_num_rows($query)!= 0){
        $data = mysqli_fetch_array($query);
        $_SESSION['username'] = $data['username'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['LOGIN'] = "LOGIN";

        if ($_SESSION['level'] = $data['level'] == "1") {
            // header("location:../admin/dashboard.php");
            echo "./admin/dashboard.php";
        } elseif ($_SESSION['level'] = $data['level'] == "2") {
            // header("location:../user/dashboard.php");
            echo "./user/dashboard.php";
        } 
    } else {
        echo "gagal";
    }

?>
