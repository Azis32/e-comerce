<?php
    //include "conf/conn.php";
  require __DIR__ . '/conf/connect.php';
  $crud = new crud("localhost","root","F@ridi23","db_broadcast");
  session_start();
  if (!isset($_SESSION['level'])) {
      header('location:./');
  }else {
      if ($_SESSION['level']=="admin") {

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Sistem Aplikasi SMS Broadcast</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="bootstrap/roboto/roboto.css">
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="datatables/datatables.min.css" rel="stylesheet">
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
      <?php
        include "style.php";
      ?>
    </style>
    </head>
    <body style="background: #eee url(img/back1.jpg) left bottom;">
      <div class="page-header">
        <div class="container">
          <div class="col-md-1 ">
            <a href="?hal=utama"><img src="img/logo-stmik.png" class="images" width="100" height="auto"></a> 
          </div>
          <div class="col-md-1 space">
              
          </div>
          <div class="col-md-10 hidden-xs">
            <P><h2 style="margin: -17px 150px 0 0; color: #154417;">Badan Eksekutif Mahasiswa</h2>
            <h3 style="margin: 0px; color: #154417;">STMIK Syaikh Zainuddin Nahdlatul Wathan</h3>
            <h6 style="margin: 3px 150px 0 0; color: #154417;">JL. Raya Mataram Labuhan Lombok KM 49 Pontren Syaikh Zainuddin NW Anjani, Nusa Tenggara Barat</h6></P>
          </div>
        </div>
      </div>
        <nav id="menu-utama" class="navbar navbar-inverse navbar-static-top" role="complementary">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand navbar-menu text-primary" style="padding-top: 15px; color: white" href="?hal=utama"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Pemilu BEM</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="conf/cek.login.php?logout" class="navbar-menu" style="color: white;" ><span class="glyphicon glyphicon-off" aria-hidden="true"> </span> Logout</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container isi">
            <div class="row">
                <div class="col-md-3 menu">
                    <a href="?hal=utama"  class="list-group-item tombol <?php $_GET['hal']=='utama' ? active : null ;?>">Home </a>
                    <a href="?hal=mahasiswa" class="list-group-item tombol <?php $_GET['hal']=='mahasiswa' ? active : null ;?>">Mahasiswa </a>
                    <a href="?hal=jurusan" class="list-group-item tombol <?php $_GET['hal']=='jurusan' ? active : null ;?>">Jurusan </a>
                    <a href="?hal=data_kandidat" class="list-group-item tombol <?php $_GET['hal']=='data_kandidat' ? active : null ;?>">Data Kandidat </a>
                    <a href="?hal=pengguna" class="list-group-item tombol <?php $_GET['hal']=='pengguna' ? active : null ;?>">Pengguna </a>
                </div>
                <?php include "formatsms.php"; ?>
                <div class="col-md-9 col-sm-12 isi" id="content-page">
                        <!-- isi halaman-->
                        <?php
                            include "page.php";
                       ?>
                </div>
            </div>
        </div>
        
        <nav class="navbar-fixed-bottom">
            <a href="http://www.fecebook.com" target="_blank">Muhammad Khairul Faridi</a>
        </nav>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        
        <script src="datatables/datatables.min.js"></script>
        <script src="dist/js/standalone/selectize.min.js"></script>
        <!--script src="js/javascript.js"></script-->
        <script type="text/javascript">
            $('.datatable-sms').DataTable();
            $('#dt-mahasiswa').DataTable();
        </script>
        <!--<script src="js/menu.js"></script>-->
        <!--?php include "formatsms.php";?-->
        
    </body>
</html>
<?php
}
}
?>