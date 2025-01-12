<?php 
	session_start();
	error_reporting(0); 
	include "config/koneksi.php"; 
	include "config/class_paging.php"; 
	if(empty($_SESSION['panitia_npm']) AND empty($_SESSION['panitia_password'])) { include "index.php"; } else {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Include the Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="../../favicon.ico">

    <title>e-Voting Koordinator Relawan Nasional PMI</title>

    <!-- CSS links -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/offcanvas.css" rel="stylesheet">
    
    <!-- Custom styles for Palang Merah color scheme -->
    <style>
      body {
        font-family: 'Poppins', sans-serif;
      }
      .navbar, .navbar-inverse {
        background-color: #D50032;
        border-color: #D50032;
      }
      .navbar-inverse .navbar-nav>li>a {
        color: white;
      }
      .navbar-inverse .navbar-nav>.active>a {
        color: white;
        background-color: #C40029;
      }
      .list-group-item {
        background-color: white;
        color: #D50032;
        border: 1px solid #D50032;
      }
      .list-group-item.active {
        background-color: #D50032;
        color: white;
      }
      .footer {
        background-color: #D50032;
        color: white;
        text-align: center;
        padding: 10px;
      }
    </style>

    <script src="assets/js/ie-emulation-modes-warning.js"></script>
  </head>

  <body>
    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">e-Voting Koor Forelnas</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php
              if($_GET['page']=='panitia_home') {
                echo" <li class='active'>";
              } else {
                echo" <li class=''>";
              }
            ?><a href="panitia_halaman.php?page=panitia_home">Home</a></li>
            <?php
              if($_GET['page']=='data_mhs' OR  $_GET['page']=='data_mhs_tambah' OR  $_GET['page']=='data_mhs_edit'){
                echo" <li class='active'>";
              } else {
                echo" <li class=''>";
              }
            ?><a href="panitia_halaman.php?page=data_mhs">Data Pegawai</a></li>
            <?php
              if($_GET['page']=='data_panitia' OR  $_GET['page']=='data_panitia_tambah' OR  $_GET['page']=='data_panitia_edit') {
                echo" <li class='active'>";
              } else {
                echo" <li class=''>";
              }
            ?><a href="panitia_halaman.php?page=data_panitia">Data Admin</a></li>
            <?php
              if($_GET['page']=='data_kahim' OR  $_GET['page']=='data_kahim_tambah' OR  $_GET['page']=='data_kahim_edit') {
                echo" <li class='active'>";
              } else {
                echo" <li class=''>";
              }
            ?><a href="panitia_halaman.php?page=data_kahim">Data Calon Koordinator Forelnas</a></li>
            <?php
              if($_GET['page']=='data_suara') {
                echo" <li class='active'>";
              } else {
                echo" <li class=''>";
              }
            ?><a href="panitia_halaman.php?page=data_suara">Data Suara Masuk</a></li>
            <?php
              if($_GET['page']=='tgl_pemilihan') {
                echo" <li class='active'>";
              } else {
                echo" <li class=''>";
              }
            ?><a href="panitia_halaman.php?page=tgl_pemilihan">Tanggal Pemilihan</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         <?php include "content.php"; ?>
        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="#" class="list-group-item active">Menu Content</a> 
            <a href="panitia_halaman.php?page=panitia_home" class="list-group-item">Home</a>
            <a href="panitia_halaman.php?page=data_mhs" class="list-group-item">Data Pegawai</a>
            <a href="panitia_halaman.php?page=data_panitia" class="list-group-item">Data Admin</a>
            <a href="panitia_halaman.php?page=data_kahim" class="list-group-item">Data Calon Ketua Koordinator Relawan Nasional</a>
            <a href="panitia_halaman.php?page=data_suara" class="list-group-item">Data Suara Masuk</a> 
            <a href="panitia_halaman.php?page=tgl_pemilihan" class="list-group-item">Tanggal Pemilihan</a>         
            <a href="logout.php" class="list-group-item" onClick="return confirm('Apakah anda akan Keluar?');">Logout</a>
          </div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->

      <hr>

      <footer class="footer">
        <p>&copy; e-Voting Palang Merah Indonesia 2024</p>
      </footer>

    </div><!--/.container-->

  </body>
</html>

<?php } ?>
