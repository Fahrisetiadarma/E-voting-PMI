<?php
include "config/koneksi.php";

try {
    // Persiapkan query untuk mengosongkan tabel t_suara
    $query = "TRUNCATE TABLE t_suara";
    $stmt = $conn->prepare($query);

    // Eksekusi query
    $stmt->execute();

    // Redirect ke halaman setelah berhasil
    header('Location: panitia_halaman.php?page=data_suara');
    exit;
} catch (PDOException $e) {
    // Tangani kesalahan query
    echo "<div class='alert alert-danger'>Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "</div>";
    exit;
}
?>
