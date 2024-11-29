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
    
    <style>
      /* Navbar background merah dan teks putih */
      .navbar-inverse {
        background-color: #d10000; /* Merah */
        border-color: #d10000;
      }

      .navbar-inverse .navbar-brand, 
      .navbar-inverse .navbar-nav > li > a {
        color: white; /* Teks putih pada navbar */
      }

      .navbar-inverse .navbar-nav > li > a:hover {
        background-color: #b30000; /* Warna merah lebih gelap untuk hover */
      }

      /* Gaya untuk tombol Home */
      .navbar-inverse .navbar-nav > li > a.active {
        background-color: #d10000; /* Merah */
        color: white;
        font-weight: bold;
        border-radius: 4px;
      }

      .navbar-inverse .navbar-nav > li > a.active:hover {
        background-color: #b30000; /* Warna merah lebih gelap saat hover */
      }

      /* Sidebar active item dengan warna merah */
      .list-group-item.active {
        background-color: #d10000; /* Merah */
        border-color: #d10000;
        color: white;
      }

      .list-group-item {
        border: 1px solid #d10000; /* Border merah pada link sidebar */
      }

      .list-group-item:hover {
        background-color: #b30000; /* Warna merah lebih gelap untuk hover */
      }

      /* Menambahkan margin-top untuk memindahkan menu ke bawah */
      .sidebar-offcanvas .list-group {
        margin-top: 20px; /* Atur margin sesuai kebutuhan */
      }

      footer {
        background-color: #d10000; /* Merah */
        color: white;
        text-align: center;
        padding: 10px 0;
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
          <a class="navbar-brand" href="#">e-Voting Palang Merah Indonesia</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php" class="active">Home</a></li> <!-- Tombol Home dengan kelas active -->
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
            <a href="#" class="list-group-item active">Silahkan Login</a>
            <a href="?page=login_mhs" class="list-group-item">Login Pegawai</a>
            <a href="?page=login_panitia" class="list-group-item">Login Admin</a>
          </div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; e-Voting Palang Merah Indonesia 2024</p>
      </footer>

    </div><!--/.container-->

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

    <script src="http://getbootstrap.com/examples/offcanvas/offcanvas.js"></script>
  </body>
</html>
