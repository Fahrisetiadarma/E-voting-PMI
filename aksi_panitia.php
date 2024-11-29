<?php
session_start();
include "config/koneksi.php";

// Mengambil data dari form
$panitia_npm = $_POST['panitia_npm'];
$panitia_password = md5($_POST['panitia_password']);

try {
    // Query untuk memeriksa data panitia
    $query = "SELECT * FROM t_panitia WHERE panitia_npm = :panitia_npm AND panitia_password = :panitia_password";
    $stmt = $conn->prepare($query);
    $stmt->execute([':panitia_npm' => $panitia_npm, ':panitia_password' => $panitia_password]);

    // Periksa apakah ada data yang ditemukan
    if ($stmt->rowCount() > 0) {
        // Ambil data panitia
        $r = $stmt->fetch(PDO::FETCH_ASSOC);

        // Simpan data ke session
        $_SESSION['panitia_npm'] = $r['panitia_npm'];
        $_SESSION['panitia_password'] = $r['panitia_password'];

        // Redirect ke halaman panitia
        header('Location: panitia_halaman.php?page=panitia_home');
    } else {
        // Tampilkan pesan error jika login gagal
        echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Password Salah!');
            window.location.href='media.php?page=login_panitia';
            </SCRIPT>");
    }
} catch (PDOException $e) {
    // Menangani kesalahan dalam query
    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Terjadi kesalahan: " . $e->getMessage() . "');
        window.location.href='media.php?page=login_panitia';
        </SCRIPT>");
}
?>
