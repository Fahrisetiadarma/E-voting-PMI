<?php
$server = "localhost"; // Nama host database
$username = "root";    // Username database
$password = "";        // Password database
$dbname = "e-voting";  // Nama database

try {
    // Membuat koneksi menggunakan PDO
    $conn = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $username, $password);
    
    // Mengatur mode error PDO ke exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Jika koneksi berhasil
    // echo "Koneksi berhasil"; // Bisa diaktifkan untuk pengujian
} catch (PDOException $e) {
    // Jika terjadi error saat koneksi
    die("Koneksi gagal: " . $e->getMessage());
}
?>
