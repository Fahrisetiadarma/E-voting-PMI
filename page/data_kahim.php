<h3>Data Calon Koordinator Forum Relawan Nasional</h3><br>
<a href="panitia_halaman.php?page=data_kahim_tambah" class="btn btn-primary">Tambah Data Calon Ketua Koordinator Relawan Nasional</a><br><br>
<table class="table">
    <tr>
        <th>No.Urut</th>
        <th>Nama Calon Koordinator Forelnas</th>
        <th>Nomor Siamo</th>
        <th>Aksi</th>
    </tr>
    <?php
    include "config/koneksi.php";

    try {
        // Menyiapkan query untuk mengambil data calon
        $stmt = $conn->prepare("SELECT * FROM t_calon ORDER BY calon_no");
        $stmt->execute();

        // Menampilkan data calon
        while ($kahim = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . htmlspecialchars($kahim['calon_no']) . "</td>
                    <td>" . htmlspecialchars($kahim['calon_nama']) . "</td>
                    <td>" . htmlspecialchars($kahim['calon_kelas']) . "</td>
                    <td>
                        <a href='panitia_halaman.php?page=data_kahim_edit&no=" . htmlspecialchars($kahim['calon_no']) . "' class='btn btn-info'>
                            <span class='fa fa-pencil'></span>
                        </a>
                        <a href='panitia_halaman.php?page=data_kahim_hapus&no=" . htmlspecialchars($kahim['calon_no']) . "' class='btn btn-danger'>
                            <span class='fa fa-trash-o'></span>
                        </a>
                    </td>
                </tr>";
        }
    } catch (PDOException $e) {
        echo "<tr><td colspan='4'>Error: " . $e->getMessage() . "</td></tr>";
    }
    ?>
</table>
