<?php
session_start();
include "config/koneksi.php";

// Ambil data dari form login dan sanitasi input
$mahasiswa_npm = trim($_POST['mahasiswa_npm']);
$mahasiswa_password = $_POST['mahasiswa_password'];

try {
    // Siapkan query menggunakan parameterized query untuk keamanan
    $query = "SELECT * FROM t_mahasiswa WHERE mahasiswa_npm = :mahasiswa_npm";
    $stmt = $conn->prepare($query);

    // Bind parameter
    $stmt->bindParam(':mahasiswa_npm', $mahasiswa_npm, PDO::PARAM_STR);

    // Eksekusi query
    $stmt->execute();

    // Cek apakah data ditemukan
    if ($stmt->rowCount() > 0) {
        // Ambil data mahasiswa
        $r = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifikasi password dengan password_verify
        if (password_verify($mahasiswa_password, $r['mahasiswa_password'])) {
            // Set session untuk user yang berhasil login
            $_SESSION['mahasiswa_npm'] = $r['mahasiswa_npm'];
            $_SESSION['mahasiswa_nama'] = $r['mahasiswa_nama'];

            // Redirect ke halaman mahasiswa
            header('Location: mhs_halaman.php?page=mhs_home');
            exit;
        } else {
            // Password salah
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Password SALAH!');
                window.location.href='media.php?page=login_mhs';
                </SCRIPT>");
            exit;
        }
    } else {
        // Jika NPM tidak ditemukan
        echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Nomor Induk Keanggotaan tidak ditemukan!');
            window.location.href='media.php?page=login_mhs';
            </SCRIPT>");
        exit;
    }
} catch (PDOException $e) {
    // Tangani kesalahan koneksi atau query
    echo "<div class='alert alert-danger'>Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "</div>";
    exit;
}
?>
