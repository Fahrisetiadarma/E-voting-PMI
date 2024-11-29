<h3>Data Suara yang telah masuk</h3><br>
<a href="panitia_halaman.php?page=data_suara_hapus" class="btn btn-danger" style="float:right" onClick="return confirm('Apakah anda akan Menghapus Semua Suara?');">Hapus Semua Suara</a>
<a href="page/data_suara_print.php" class="btn btn-primary" style="float:right" target="_blank">Print Out Suara</a>
<br /><br /><br />

<table class="table">
    <tr>
        <th>No.Urut</th>
        <th>Nama Calon Koordinator Forelnas</th>
        <th>Suara</th>
    </tr>
    <?php
    // Database connection
    include "config/koneksi.php";

    try {
        // Ambil daftar calon
        $sql = "SELECT * FROM t_calon ORDER BY calon_no";
        $stmt_calon = $conn->prepare($sql);
        $stmt_calon->execute();
        $calons = $stmt_calon->fetchAll(PDO::FETCH_ASSOC);

        foreach ($calons as $calon) {
            $calon_no = $calon['calon_no'];
            $calon_nama = $calon['calon_nama'];

            // Ambil jumlah suara untuk setiap calon
            $sql_jumlah = "SELECT COUNT(*) AS suara_jml FROM t_suara WHERE calon_no = :calon_no";
            $stmt_jumlah = $conn->prepare($sql_jumlah);
            $stmt_jumlah->execute([':calon_no' => $calon_no]);
            $suara = $stmt_jumlah->fetch(PDO::FETCH_ASSOC);
            $suara_jml = $suara['suara_jml'];
    ?>
            <tr>
                <td><?php echo htmlspecialchars($calon_no); ?></td>
                <td><?php echo htmlspecialchars($calon_nama); ?></td>
                <td><?php echo htmlspecialchars($suara_jml); ?></td>
            </tr>
    <?php
        }

        // Ambil total jumlah suara
        $stmt_total = $conn->query("SELECT COUNT(*) AS total_suara FROM t_suara");
        $total_suara = $stmt_total->fetch(PDO::FETCH_ASSOC)['total_suara'];
    ?>
    <tr>
        <td colspan="2"><b>TOTAL SUARA MASUK :</b></td>
        <td><b><?php echo htmlspecialchars($total_suara); ?></b></td>
    </tr>
    <?php
    } catch (PDOException $e) {
        echo "<div class='btn btn-danger btn-block'>Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
    ?>
</table>

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script src="assets/js/highcharts.js"></script>
<script src="assets/js/exporting.js"></script>
<script type="text/javascript">
    $(function () {
        $(document).ready(function () {
            // Build the pie chart
            $('#container').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Suara yang Sudah Masuk'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Jumlah Suara',
                    colorByPoint: true,
                    data: [
                        <?php
                        foreach ($calons as $calon) {
                            $calon_no = $calon['calon_no'];
                            $calon_nama = $calon['calon_nama'];

                            // Ambil jumlah suara untuk pie chart
                            $stmt_pie = $conn->prepare("SELECT COUNT(*) AS suara_jml FROM t_suara WHERE calon_no = :calon_no");
                            $stmt_pie->execute([':calon_no' => $calon_no]);
                            $suara_pie = $stmt_pie->fetch(PDO::FETCH_ASSOC)['suara_jml'];
                        ?>
                            {
                                name: '<?php echo htmlspecialchars($calon_nama); ?>',
                                y: <?php echo $suara_pie; ?>
                            },
                        <?php } ?>
                    ]
                }]
            });
        });
    });
</script>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
<br />

<script type="text/javascript">
    $(document).ready(function () {
        // Build the column chart
        var chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'grafik2',
                type: 'column'
            },
            title: {
                text: 'Suara yang Sudah Masuk'
            },
            xAxis: {
                categories: ['Nama Calon Ketua Koordinator Relawan Nasional']
            },
            yAxis: {
                title: {
                    text: 'Skala Banyak Suara'
                }
            },
            series: [
                <?php
                foreach ($calons as $calon) {
                    $calon_nama = $calon['calon_nama'];

                    // Ambil jumlah suara untuk column chart
                    $stmt_column = $conn->prepare("SELECT COUNT(*) AS suara_jml FROM t_suara WHERE calon_no = :calon_no");
                    $stmt_column->execute([':calon_no' => $calon['calon_no']]);
                    $suara_column = $stmt_column->fetch(PDO::FETCH_ASSOC)['suara_jml'];
                ?>
                    {
                        name: '<?php echo htmlspecialchars($calon_nama); ?>',
                        data: [<?php echo $suara_column; ?>]
                    },
                <?php } ?>
            ]
        });
    });
</script>

<div id='grafik2'></div>
