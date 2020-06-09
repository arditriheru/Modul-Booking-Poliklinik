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
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          Cara memperbarui daftar zona merah COVID-19 : <b>Copy jpg terbaru - explorer - network - RACHMI-SVR - folder redzone - paste - rename jpg menjadi redzone - kembali ke simetris - CTRL+F5</b>
        </div>
      </div>
      <div class="col-lg-12">
        <img class="img-responsive" src="../redzone/redzone.jpg" width="100%" alt="Gambar Bootstrap 3">
      </div>
    </div><!-- /.row --><br><br><?php include "../copyright.php";?>
  </div><!-- /#page-wrapper -->
  </div><!-- /#wrapper -->
<?php include "views/footer.php"; ?>
