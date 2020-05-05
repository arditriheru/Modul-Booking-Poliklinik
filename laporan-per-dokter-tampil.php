<?php include "readme.php";?>
<?php include "views/header.php"; ?>
<?php
  $id_dokter  = $_POST['id_dokter'];
  $awal       = $_POST['awal'];
  $akhir      = $_POST['akhir'];
  $id_sesi    = $_POST['id_sesi'];
?>
  <nav>
    <div id="wrapper">
      <?php include "menu.php"; ?>
        </div><!-- /.navbar-collapse -->
      </nav>
      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1>Pencarian <small> Data</small></h1>
            <ol class="breadcrumb">
              <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="laporan-per-dokter"><i class="fa fa-search"></i> Cari</a></li>
              <li class="active"><i class="fa fa-list"></i> List</li>
            </ol>  
            <?php include "../notifikasi1.php"?>
          </div>
        </div><!-- /.row -->
        <div class="row">
          <div class="col-lg-12">
          <div class="table-responsive">
            <form method="post" action="laporan-per-dokter-export" role="form">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input class="form-control" type="hidden" name="id_dokter" value="<?php echo $id_dokter?>">
                    </div>
                    <div class="form-group">
                      <input class="form-control" type="hidden" name="awal" value="<?php echo $awal?>">
                    </div>
                  <div class="form-group">
                      <input class="form-control" type="hidden" name="akhir" value="<?php echo $akhir?>">
                  </div>
                  <div class="form-group">
                      <input class="form-control" type="hidden" name="id_sesi" value="<?php echo 
                      $id_sesi?>">
                  </div>
                  <button type="submit" class="btn btn-success">EXPORT</button><br><br>
                  </div>
              </form>
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr>
                    <th><center>No</th>
                    <th><center>No.RM</th>
                    <th><center>Nama</th>
                    <th><center>Alamat</th>
                    <th><center>Kontak</th>
                    <th><center>Dokter</th>
                    <th><center>Jadwal</th>
                    <th><center>Sesi</th>
                    <th><center>Status</th>
                    <th><center>Action</th>
                   </tr>
                </thead>
                <tbody>
                  <?php 
                    include '../koneksi.php';
                    $no = 1;
                    date_default_timezone_set("Asia/Jakarta");
                    $tanggalHariIni=date('Y-m-d');
                    $data = mysqli_query($koneksi,
                      "SELECT *, dokter.nama_dokter, sesi.nama_sesi,
                      IF (booking.status='1', 'Datang', 'Belum Datang') AS status
                      FROM booking, dokter, sesi
                      WHERE booking.id_dokter=dokter.id_dokter
                      AND booking.id_sesi=sesi.id_sesi
                      AND booking.booking_tanggal BETWEEN '$awal' AND '$akhir'
                      AND booking.id_sesi = '$id_sesi'
                      AND booking.id_dokter='$id_dokter' ORDER BY booking.id_booking ASC;");
                    while($d = mysqli_fetch_array($data)){
                  ?>
                  <tr>
                    <td><center><?php echo $no++; ?></td>
                    <td><center><?php echo $d['id_catatan_medik']; ?></td>
                    <td><center><?php echo $d['nama']; ?></td>
                    <td><center><?php echo $d['alamat']; ?></td>
                    <td><center><?php echo $d['kontak']; ?></td>
                    <td><center><?php echo $d['nama_dokter']; ?></td>
                    <td><center><?php echo $d['booking_tanggal']; ?></td>
                    <td><center><?php echo $d['nama_sesi']; ?></td>
                    <td><center><?php echo $d['status']; ?></td>
                    <td>
                      <div align="center">
                        <a href="booking-detail?id_booking=<?php echo $d['id_booking']; ?>"
                        <button type="button" class="btn btn-warning">Detail</a><br><br>
                      </div>
                    </td>
                  </tr>
                  <?php 
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
          </div>
        </div><!-- /.row -->
<br><br><?php include "../copyright.php";?>
      </div><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->
    <?php include "views/footer.php"; ?>