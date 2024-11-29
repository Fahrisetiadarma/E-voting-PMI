<?php
include "config/koneksi.php"; // Pastikan file koneksi sudah menggunakan PDO

$npm = $_GET['npm']; // Ambil parameter `npm` dari URL

try {
    // Persiapkan query DELETE menggunakan prepared statement
    $sql = "DELETE FROM t_panitia WHERE panitia_npm = :npm";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':npm', $npm, PDO::PARAM_STR);

    // Eksekusi query
    if ($stmt->execute()) {
        // Jika berhasil, redirect ke halaman data panitia
        header("location:panitia_halaman.php?page=data_panitia");
    } else {
        // Jika gagal, redirect ke halaman data panitia dengan pesan error
        header("location:panitia_halaman.php?page=data_panitia&status=error");
    }
} catch (PDOException $e) {
    // Tangani error koneksi atau query
    error_log("Error: " . $e->getMessage());
    header("location:panitia_halaman.php?page=data_panitia&status=error");
}
?>
