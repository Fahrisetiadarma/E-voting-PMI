<h3>Edit Data Calon Koordinator Forum Relawan Nasional</h3>
<?php
// Koneksi ke database
include "config/koneksi.php";

if (isset($_POST['edit_calon'])) {
    $no = $_POST['no']; // No urut calon
    $calon_nama = $_POST['calon_nama'];
    $calon_kelas = $_POST['calon_kelas'];

    // Proses upload foto jika ada file baru
    $filename = $_FILES['file']['name'];
    if (!empty($filename)) {
        $filepath = 'assets/foto_cakahim/' . $filename;
        $move = move_uploaded_file($_FILES['file']['tmp_name'], $filepath);
        if (!$move) {
            echo "<div class='btn btn-danger btn-block'>Gagal mengupload foto</div>";
            exit;
        }
    } else {
        $filepath = null; // Jika tidak ada file baru, gunakan foto lama
    }

    try {
        // SQL update dengan atau tanpa file baru
        $query = "UPDATE t_calon SET calon_nama = :calon_nama, calon_kelas = :calon_kelas";
        if ($filepath) {
            $query .= ", calon_foto = :calon_foto";
        }
        $query .= " WHERE calon_no = :no";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':calon_nama', $calon_nama);
        $stmt->bindParam(':calon_kelas', $calon_kelas);
        if ($filepath) {
            $stmt->bindParam(':calon_foto', $filename);
        }
        $stmt->bindParam(':no', $no);

        if ($stmt->execute()) {
            echo "<div class='btn btn-success btn-block'>Data berhasil diperbarui</div>";
        } else {
            echo "<div class='btn btn-danger btn-block'>Gagal memperbarui data</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='btn btn-danger btn-block'>Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}

// Ambil data calon berdasarkan nomor urut
$no = $_GET['no'];
try {
    $stmt = $conn->prepare("SELECT * FROM t_calon WHERE calon_no = :no");
    $stmt->bindParam(':no', $no);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='btn btn-danger btn-block'>Terjadi kesalahan saat mengambil data: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <input type='hidden' name='no' value="<?php echo htmlspecialchars($no); ?>" />
    <table class="table">
        <tr>
            <td>No. Urut</td>
            <td>:</td>
            <td><input type="text" name="calon_no" class="form-control" value="<?php echo htmlspecialchars($no); ?>" readonly="readonly"></td>
        </tr>
        <tr>
            <td>Nama Calon Koordinator Forelnas</td>
            <td>:</td>
            <td><input type="text" name="calon_nama" required value="<?php echo htmlspecialchars($data['calon_nama']); ?>" class="form-control"></td>
        </tr>
        <tr>
            <td>Nomor Siamo</td>
            <td>:</td>
            <td><input type="text" name="calon_kelas" required value="<?php echo htmlspecialchars($data['calon_kelas']); ?>" class="form-control"></td>
        </tr>
        <tr>
            <td>Foto Saat Ini</td>
            <td>:</td>
            <td><img src="assets/foto_cakahim/<?php echo htmlspecialchars($data['calon_foto']); ?>" width="90"></td>
        </tr>
        <tr>
            <td>Ganti Foto</td>
            <td>:</td>
            <td><input type="file" name="file" class="form-control"></td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" name="edit_calon" value="Simpan Data" class="btn btn-primary">
                <input type="button" value="Batal" onclick="location.href='panitia_halaman.php?page=data_mhs'" class="btn btn-danger">
            </td>
        </tr>
    </table>
</form>
