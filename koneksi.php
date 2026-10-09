<?php
$host     = "localhost";
$user     = "root";
$password = ""; // Kosongkan jika pakai XAMPP/Laragon default
$database = "iriset_db"; // Sesuaikan dengan nama DB di phpMyAdmin

// Gunakan fungsi prosedural mysqli_connect
$koneksi = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>