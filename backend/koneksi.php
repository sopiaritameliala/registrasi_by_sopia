<?php
$host = "localhost";
$user = "root";
$password = ""; 
$dbName = "registrasi_by_sopia";

$koneksi = mysqli_connect($host, $user, $password, $dbName);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
