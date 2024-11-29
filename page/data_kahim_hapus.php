<?php
include "config/koneksi.php";

$no = $_GET['no'];

try {
    // Memulai transaksi untuk memastikan kedua query berjalan bersama
    $conn->beginTransaction();

    // Hapus data dari tabel t_calon
    $stmt1 = $conn->prepare("DELETE FROM t_calon WHERE calon_no = :calon_no");
    $stmt1->execute([':calon_no' => $no]);

    // Hapus data dari tabel t_suara
    $stmt2 = $conn->prepare("DELETE FROM t_suara WHERE calon_no = :calon_no");
    $stmt2->execute([':calon_no' => $no]);

    // Commit transaksi
    $conn->commit();

    // Redirect ke halaman data kahim dengan pesan sukses
    header("location:panitia_halaman.php?page=data_kahim&status=success");
} catch (Exception $e) {
    // Rollback transaksi jika terjadi error
    $conn->rollBack();

    // Redirect ke halaman data kahim dengan pesan error
    header("location:panitia_halaman.php?page=data_kahim&status=error");
    // Opsional: log atau tampilkan pesan error untuk debugging
    error_log("Error deleting data: " . $e->getMessage());
}
?>
