<?php
$host = "localhost";
$username = "root";
$password = "202312035";
$database = "db_toko";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>