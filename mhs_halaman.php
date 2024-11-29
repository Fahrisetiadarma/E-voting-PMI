<?php 
	session_start();
	error_reporting(0); 
	include "config/koneksi.php"; 
	if(empty($_SESSION['mahasiswa_npm']) AND empty($_SESSION['mahasiswa_password'])) { include "index.php"; } else {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>e-Voting Palang Merah Indonesia</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/offcanvas.css" rel="stylesheet">
    <!-- Link ke font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="assets/js/ie-emulation-modes-warning.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .navbar-inverse {
            background-color: #D50032; /* Merah Palang Merah Indonesia */
            border-color: #D50032;
        }
        .navbar-inverse .navbar-brand {
            color: white;
        }
        .navbar-inverse .navbar-nav > li > a {
            color: white;
        }
        .navbar-inverse .navbar-nav > li > a:hover {
            color: #FFEB3B; /* Warna kuning cerah untuk hover */
        }
        .navbar-inverse .navbar-nav > li.active > a {
            background-color: #D50032; /* Merah Palang Merah Indonesia untuk Home yang aktif */
        }
        .list-group-item.active {
            background-color: #D50032; /* Merah Palang Merah Indonesia */
            border-color: #D50032;
        }
        .footer {
            background-color: #D50032;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .btn-primary {
            background-color: #D50032; /* Merah Palang Merah Indonesia */
            border-color: #D50032;
        }
        .btn-primary:hover {
            background-color: #FFEB3B; /* Hover dengan warna kuning cerah */
            border-color: #FFEB3B;
        }
    </style>
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
          <a class="navbar-brand" href="#">e-Voting Palang Merah Indonesia</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
         	<?php
				if($_GET['page']=='mhs_home') {
					echo" <li class='active'>"; 
				} else {
					echo" <li class=''>"; 
				}
			?><a href="mhs_halaman.php?page=mhs_home">Home</a></li>
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
            <a href="mhs_halaman.php?page=mhs_home" class="list-group-item">Home</a>      
            <a href="logout.php" class="list-group-item" onClick="return confirm('Apakah anda akan Keluar?');">Logout</a>
          </div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->

      <hr>

      <footer class="footer">
        <p>&copy; e-Voting Palang Merah Indonesia 2024</p>
      </footer>

    </div><!--/.container-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

    <script src="http://getbootstrap.com/examples/offcanvas/offcanvas.js"></script>
  </body>
</html>

<?php } ?>
