<h3>Tambah Data Pegawai</h3>
<?php
// Pastikan file koneksi sudah benar
include "config/koneksi.php";

if (isset($_POST['tambah_mhs'])) {
    // Ambil data dari form dan lakukan trim untuk menghapus spasi di awal/akhir
    $mahasiswa_npm = trim($_POST['mahasiswa_npm']);
    $mahasiswa_nama = trim($_POST['mahasiswa_nama']);
    $mahasiswa_kelas = trim($_POST['mahasiswa_kelas']);
    $mahasiswa_password = password_hash(trim($_POST['mahasiswa_password']), PASSWORD_BCRYPT); // Enkripsi password menggunakan password_hash

    // Validasi input untuk menghindari data kosong
    if (empty($mahasiswa_npm) || empty($mahasiswa_nama) || empty($mahasiswa_kelas) || empty($mahasiswa_password)) {
        echo "<div class='btn btn-danger btn-block'>Semua data harus diisi!</div>";
    } else {
        // Siapkan query untuk menambahkan data mahasiswa ke database
        try {
            $stmt = $conn->prepare("
                INSERT INTO t_mahasiswa 
                (mahasiswa_npm, mahasiswa_password, mahasiswa_nama, mahasiswa_kelas) 
                VALUES (:npm, :password, :nama, :kelas)
            ");

            // Eksekusi query dengan data yang diambil dari form
            $stmt->execute([
                ':npm' => $mahasiswa_npm,
                ':password' => $mahasiswa_password,
                ':nama' => $mahasiswa_nama,
                ':kelas' => $mahasiswa_kelas,
            ]);

            echo "<div class='btn btn-success btn-block'>Data Pegawai Berhasil Ditambahkan</div>";
        } catch (PDOException $e) {
            echo "<div class='btn btn-danger btn-block'>Data Pegawai Gagal Ditambahkan. Error: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    }
}
?>

<form action="" method="POST">
    <table class="table">
        <tr>
            <td>Nomor Siamo</td>
            <td>:</td>
            <td><input type="text" name="mahasiswa_npm" required class="form-control" maxlength="20"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" name="mahasiswa_password" required class="form-control"></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="mahasiswa_nama" required class="form-control"></td>
        </tr>
        <tr>
            <td>Jabatan di PMI</td>
            <td>:</td>
            <td><input type="text" name="mahasiswa_kelas" required class="form-control"></td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" name="tambah_mhs" value="Simpan Data" class="btn btn-primary">
                <input type="button" value="Batal" onclick="location.href='panitia_halaman.php?page=data_mhs'" class="btn btn-danger">
            </td>
        </tr>
    </table>
</form>
