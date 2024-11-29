<h3>Edit Data Pegawai</h3>
<?php
include "config/koneksi.php";

// Proses saat form disubmit
if (isset($_POST['edit_mhs'])) {
    // Ambil data dari form
    $npm = $_POST['npm'];
    $mahasiswa_nama = trim($_POST['mahasiswa_nama']);
    $mahasiswa_kelas = trim($_POST['mahasiswa_kelas']);
    $mahasiswa_password = trim($_POST['mahasiswa_password']);

    try {
        // Cek apakah password diubah
        if ($mahasiswa_password === "") {
            // Jika password tidak diubah, gunakan password yang lama
            $stmt = $conn->prepare("SELECT mahasiswa_password FROM t_mahasiswa WHERE mahasiswa_npm = :npm");
            $stmt->execute([':npm' => $npm]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $password2 = $data['mahasiswa_password'];
        } else {
            // Jika password diubah, hash password baru
            $password2 = password_hash($mahasiswa_password, PASSWORD_BCRYPT);
        }

        // Query untuk update data mahasiswa
        $sql = "UPDATE t_mahasiswa 
                SET mahasiswa_nama = :mahasiswa_nama, 
                    mahasiswa_kelas = :mahasiswa_kelas, 
                    mahasiswa_password = :mahasiswa_password 
                WHERE mahasiswa_npm = :npm";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([
            ':mahasiswa_nama' => $mahasiswa_nama,
            ':mahasiswa_kelas' => $mahasiswa_kelas,
            ':mahasiswa_password' => $password2,
            ':npm' => $npm,
        ]);

        if ($result) {
            echo "<div class='btn btn-success btn-block'>Data Mahasiswa Berhasil Diedit</div>";
        } else {
            echo "<div class='btn btn-danger btn-block'>Data Mahasiswa Gagal Diedit</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='btn btn-danger btn-block'>Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}

// Ambil data mahasiswa berdasarkan npm yang diterima
if (isset($_GET['npm'])) {
    $npm = $_GET['npm'];
    try {
        $stmt = $conn->prepare("SELECT * FROM t_mahasiswa WHERE mahasiswa_npm = :npm");
        $stmt->execute([':npm' => $npm]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<div class='btn btn-danger btn-block'>Terjadi kesalahan saat mengambil data: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}
?>

<form action="" method="POST">
    <input type='hidden' name='npm' value="<?php echo htmlspecialchars($npm); ?>" />
    <table class="table">
        <tr>
            <td>Nomor Siamo</td>
            <td>:</td>
            <td><input type="text" name="mahasiswa_npm" class="form-control" value="<?php echo htmlspecialchars($npm); ?>" readonly="readonly"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" name="mahasiswa_password" class="form-control" maxlength="255"> *Kosongkan bila tidak diganti</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="mahasiswa_nama" value="<?php echo htmlspecialchars($data['mahasiswa_nama']); ?>" required class="form-control"></td>
        </tr>
        <tr>
            <td>Jabatan di PMI</td>
            <td>:</td>
            <td><input type="text" name="mahasiswa_kelas" value="<?php echo htmlspecialchars($data['mahasiswa_kelas']); ?>" required class="form-control"></td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" name="edit_mhs" value="Simpan Data" class="btn btn-primary">
                <input type="button" value="Batal" onclick="location.href='panitia_halaman.php?page=data_mhs'" class="btn btn-danger">
            </td>
        </tr>
    </table>
</form>
