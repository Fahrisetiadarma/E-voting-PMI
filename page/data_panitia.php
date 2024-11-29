<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Admin</title>
    <!-- Import Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="media/css/demo_table_jui.css">
    <link rel="stylesheet" type="text/css" href="media/themes/ui-lightness/jquery-ui-1.8.4.custom.css">
    <style>
        /* Ubah font menjadi Poppins */
        * {
            font-family: 'Poppins', sans-serif;
        }
        input[type="text"], input[type="password"], select {
            color: #000;
        }
        h3 {
            font-weight: 600;
        }
        a.btn-primary {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
        a.btn-primary:hover {
            background-color: #0056b3;
        }
        a.btn-info, a.btn-danger {
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            margin-right: 5px;
        }
        a.btn-info {
            background-color: #17a2b8;
        }
        a.btn-info:hover {
            background-color: #117a8b;
        }
        a.btn-danger {
            background-color: #dc3545;
        }
        a.btn-danger:hover {
            background-color: #a71d2a;
        }
    </style>
    <script src="media/js/jquery.js" type="text/javascript"></script>
    <script src="media/js/jquery.dataTables.js" type="text/javascript"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){
            $('#datatables').dataTable({
                "sPaginationType":"full_numbers",
                "aaSorting":[[2, "desc"]],
                "bJQueryUI":true
            });
        });
    </script>
</head>
<body>
    <h3>Data Admin</h3><br>
    <a href="panitia_halaman.php?page=data_panitia_tambah" class="btn btn-primary">Tambah Data Admin</a><br><br>
    <table id="datatables" class="display">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Siamo</th>
                <th>Nama Admin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "config/koneksi.php";
            
            try {
                // Menyiapkan query untuk menampilkan data
                $stmt = $conn->prepare("SELECT * FROM t_panitia ORDER BY panitia_npm");
                $stmt->execute();
                
                $no = 1;
                while ($panitia = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>$no</td>
                            <td>{$panitia['panitia_npm']}</td>
                            <td>{$panitia['panitia_nama']}</td>
                            <td>
                                <a href='panitia_halaman.php?page=data_panitia_edit&npm={$panitia['panitia_npm']}' class='btn btn-info'>
                                    <span class='fa fa-pencil'></span>
                                </a>
                                <a href='panitia_halaman.php?page=data_panitia_hapus&npm={$panitia['panitia_npm']}' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data admin ini?\");'>
                                    <span class='fa fa-trash-o'></span>
                                </a>
                            </td>
                        </tr>";
                    $no++;
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </tbody>
    </table>
</body>
</html>
