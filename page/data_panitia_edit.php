<h3>Edit Data Admin</h3>
<?php
if(isset($_POST['edit_panitia'])) {

    
    try {
        $stmt = $conn->prepare("SELECT * FROM t_panitia WHERE panitia_npm = :npm");
        $stmt->bindParam(':npm', $_POST['npm']);
        $stmt->execute();
        $data2 = $stmt->fetch(PDO::FETCH_ASSOC);

        $npm = $_POST['npm'];
        $panitia_nama = $_POST['panitia_nama'];
        $panitia_password = $_POST['panitia_password'];

        
        if ($panitia_password == $data2['panitia_password']) {
            $password2 = $panitia_password;
        } else {
            $password2 = md5($panitia_password);
        }

        
        $sql = "UPDATE t_panitia SET panitia_nama = :panitia_nama, panitia_password = :panitia_password WHERE panitia_npm = :npm";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':panitia_nama', $panitia_nama);
        $stmt->bindParam(':panitia_password', $password2);
        $stmt->bindParam(':npm', $npm);

        if ($stmt->execute()) {
            echo "<div class='btn btn-success btn-block'>Data Admin Berhasil diedit</div>";
        } else {
            echo "<div class='btn btn-danger btn-block'>Data Admin Gagal diedit</div>";
        }

    } catch (PDOException $e) {
        echo "<div class='btn btn-danger btn-block'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<?php
// Menyiapkan data panitia untuk di-edit
$npm = $_GET['npm'];
try {
    $stmt = $conn->prepare("SELECT * FROM t_panitia WHERE panitia_npm = :npm");
    $stmt->bindParam(':npm', $npm);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='btn btn-danger btn-block'>Error: " . $e->getMessage() . "</div>";
}
?>

<form action="" method="POST">
    <input type='hidden' name='npm' value="<?php echo $npm; ?>" />
    <table class="table">
        <tr>
            <td>Nomor Siamo</td>
            <td>:</td>
            <td><input type="text" name="panitia_npm" required class="form-control" value="<?php echo $npm; ?>" readonly="readonly" maxlength="8"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" name="panitia_password" class="form-control" maxlength="8"> *kosongkan bila tidak diganti</td>
        </tr>
        <tr>
            <td>Nama Admin</td>
            <td>:</td>
            <td><input type="text" name="panitia_nama" value="<?php echo $data['panitia_nama']; ?>" required class="form-control"></td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" name="edit_panitia" value="Simpan Data" class="btn btn-primary">
                <input type="button" value="Batal" onclick="location.href='panitia_halaman.php?page=data_panitia'" class="btn btn-danger">
            </td>
        </tr>
    </table>
</form>
