<?php include "readme.php";?>
<?php include "views/header.php"; ?>
  <nav>
    <div id="wrapper">
      <?php include "menu.php"; ?>
    </div><!-- /.navbar-collapse -->
  </nav>
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>Zona Merah <small>COVID-19</small></h1>
        <ol class="breadcrumb">
          <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</li></a>
          <li class="active"><i class="fa fa-exclamation-triangle"></i> Peringatan</li>
        </ol>  
        <?php include "../notifikasi1.php"?>
      </div>
      <div class="col-lg-12">
        <img class="img-responsive" src="../images/blacklist.jpg" width="100%" alt="Gambar Bootstrap 3">
      </div>
    </div><!-- /.row --><br><br><?php include "../copyright.php";?>
  </div><!-- /#page-wrapper -->
  </div><!-- /#wrapper -->
<?php include "views/footer.php"; ?>
