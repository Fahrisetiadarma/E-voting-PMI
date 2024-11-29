<h3>Tambah Data Admin</h3>
<?php
if (isset($_POST['tambah_panitia'])) {
    // Mendapatkan data dari form
    $panitia_npm = $_POST['panitia_npm'];
    $panitia_nama = $_POST['panitia_nama'];
    $panitia_kelas = $_POST['panitia_kelas'];
    $panitia_password = md5($_POST['panitia_password']); // Hash password dengan MD5

    try {
        // Koneksi ke database (ganti sesuai konfigurasi Anda)
        $dsn = "mysql:host=localhost;dbname=nama_database"; // Ganti nama_database dengan nama database Anda
        $username = "root"; // Ganti sesuai username database Anda
        $password = ""; // Ganti sesuai password database Anda
        $pdo = new PDO($dsn, $username, $password);

        // Atur PDO error mode ke exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query untuk memasukkan data
        $sql = "INSERT INTO t_panitia (panitia_npm, panitia_password, panitia_nama) 
                VALUES (:panitia_npm, :panitia_password, :panitia_nama)";

        // Persiapkan dan eksekusi query
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':panitia_npm', $panitia_npm);
        $stmt->bindParam(':panitia_password', $panitia_password);
        $stmt->bindParam(':panitia_nama', $panitia_nama);

        if ($stmt->execute()) {
            echo "<div class='btn btn-success btn-block'>Data Panitia Berhasil ditambahkan</div>";
        } else {
            echo "<div class='btn btn-danger btn-block'>Data Panitia Gagal ditambahkan</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='btn btn-danger btn-block'>Kesalahan: " . $e->getMessage() . "</div>";
    }
}
?>

<form action="" method="POST">
<table class="table">
    <tr>
        <td>Nomor Siamo</td>
        <td>:</td>
        <td><input type="text" name="panitia_npm" required class="form-control" maxlength="8"></td>
    </tr>
    <tr>
        <td>Password</td>
        <td>:</td>
        <td><input type="password" name="panitia_password" required class="form-control" maxlength="8"></td>
    </tr>
    <tr>
        <td>Nama Admin</td>
        <td>:</td>
        <td><input type="text" name="panitia_nama" required class="form-control"></td>
    </tr>
    <tr>
        <td colspan="3">
            <input type="submit" name="tambah_panitia" value="Simpan Data" class="btn btn-primary"> 
            <input type="button" value="Batal" onclick="location.href='panitia_halaman.php?page=data_panitia'" class="btn btn-danger">
        </td>
    </tr>
</table>
</form>
