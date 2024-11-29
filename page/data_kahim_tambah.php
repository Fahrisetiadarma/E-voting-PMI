<?php
include "config/koneksi.php";

if (isset($_POST['tambah_calon'])) {
    $calon_no = htmlspecialchars($_POST['calon_no']);
    $calon_nama = htmlspecialchars($_POST['calon_nama']);
    $calon_kelas = htmlspecialchars($_POST['calon_kelas']);
    $asal = $_FILES['file']['tmp_name'];
    $nama_file = basename($_FILES['file']['name']);
    $direktori = "assets/foto_cakahim/" . $nama_file;

    // Validasi file upload
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $file_size = $_FILES['file']['size'];

    if (!in_array($file_extension, $allowed_extensions)) {
        echo "<div class='btn btn-danger btn-block'>Format file tidak diperbolehkan. Harap upload file gambar.</div>";
    } elseif ($file_size > 2000000) { // 2MB
        echo "<div class='btn btn-danger btn-block'>Ukuran file terlalu besar. Maksimal 2MB.</div>";
    } else {
        try {
            if (move_uploaded_file($asal, $direktori)) {
                // Gunakan tanda tanya (?) untuk parameter binding
                $sql = "INSERT INTO t_calon (calon_no, calon_nama, calon_kelas, calon_foto) 
                        VALUES (?, ?, ?, ?)";
                
                // Prepare statement
                $sqlStmt = $conn->prepare($sql);
                
                // Bind parameter ke statement
                $sqlStmt->bindParam(1, $calon_no);
                $sqlStmt->bindParam(2, $calon_nama);
                $sqlStmt->bindParam(3, $calon_kelas);
                $sqlStmt->bindParam(4, $nama_file);

                // Eksekusi query
                if ($sqlStmt->execute()) {
                    echo "<div class='btn btn-success btn-block'>Data Calon Ketua Koordinator Relawan Nasional Berhasil ditambahkan</div>";
                } else {
                    echo "<div class='btn btn-danger btn-block'>Data Calon Ketua Koordinator Relawan Nasional Gagal ditambahkan</div>";
                }
            } else {
                echo "<div class='btn btn-danger btn-block'>Gagal mengupload file.</div>";
            }
        } catch (Exception $e) {
            echo "<div class='btn btn-danger btn-block'>Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    }
}
?>

<form action="" method="POST" enctype="multipart/form-data">
<h3>Tambah Data Calon Koordinator Forum Relawan Nasional</h3>    
<table class="table">
        <tr>
            <td>No. Urut</td>
            <td>:</td>
            <td><input type="text" name="calon_no" required class="form-control" maxlength="8"></td>
        </tr>
        <tr>
            <td>Nama Calon Forelnas</td>
            <td>:</td>
            <td><input type="text" name="calon_nama" required class="form-control"></td>
        </tr>
        <tr>
            <td>Nomor Siamo</td>
            <td>:</td>
            <td><input type="text" name="calon_kelas" required class="form-control"></td>
        </tr>
        <tr>
            <td>Foto</td>
            <td>:</td>
            <td><input type="file" name="file" required class="form-control"></td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" name="tambah_calon" value="Simpan Data" class="btn btn-primary"> 
                <input type="button" value="Batal" onclick="location.href='panitia_halaman.php?page=data_kahim'" class="btn btn-danger">
            </td>
        </tr>
    </table>
</form>
