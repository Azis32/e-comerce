<?php
    //include "conf/conn.php";
  require __DIR__ . '/conf/connect.php';
  $crud = new crud("localhost","root","F@ridi23","db_broadcast");

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
                    <a class="navbar-brand navbar-menu" href="#"><i class="glyphicon glyphicon-send"> </i> SIAK STMIK</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a data-toggle="modal" href='#modal-id' class="navbar-menu"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"> </span> Bantuan</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <div class="container isi">
            <div class="row">
              <div class="col-xs-12 col-sm-8 col-md-8">&nbsp;</div>
              <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="panel panel-default"><div class="panel-body">
                    <div class="text-center"><h4>Login Area</h4></div>
                        <form method="post" action="conf/cek.login.php">
                          <div class="form-group">
                            <label for="InputUsername1">Username</label>
                            <input type="text" class="form-control" name="username" required id="InputUsername1" placeholder="Username">
                          </div>
                          <div class="form-group">
                            <label for="InputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" required id="InputPassword1" placeholder="Password">
                          </div>
                          <p><small style="color:#999;">Username: Nomor Induk Pegawai</small></p>
                          <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
                
              </div>
            </div>
        </div>
        <div class="modal fade" id="modal-id">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Bantuan</h4>
              </div>
              <div class="modal-body">
                <p>Untuk dapat menggunakan Aplikasi Sistem informasi perkuliahan ini silahkan login terlebih dahulu pada form yang sudah disediakan!. Untuk informasi lebih lanjut silahkan hubungi ADMIN. </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        
        <script src="datatables/datatables.min.js"></script>
        <script src="dist/js/standalone/selectize.min.js"></script>
        <script src="js/javascript.js"></script>
        <!--<script src="js/menu.js"></script>-->
        <!--?php include "formatsms.php";?-->
        
    </body>
</html>

