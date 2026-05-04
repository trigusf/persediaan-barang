<?php
session_start();
unset($_SESSION['isi']);
header('location: ./insert_keluar.php');