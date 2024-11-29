<?php
include "config/koneksi.php";

if (isset($_GET['npm'])) {
    $npm = $_GET['npm']; // Ambil NPM dari parameter GET

    try {
        // Siapkan query DELETE
        $stmt = $conn->prepare("DELETE FROM t_mahasiswa WHERE mahasiswa_npm = :npm");

        // Eksekusi query dengan parameter
        $stmt->execute([':npm' => $npm]);

        // Redirect ke halaman data mahasiswa dengan pesan sukses
        header("location:panitia_halaman.php?page=data_mhs&status=success");
    } catch (PDOException $e) {
        // Redirect ke halaman data mahasiswa dengan pesan error
        header("location:panitia_halaman.php?page=data_mhs&status=error&message=" . urlencode($e->getMessage()));
    }
} else {
    // Redirect jika npm tidak ada
    header("location:panitia_halaman.php?page=data_mhs&status=invalid");
}
?>
