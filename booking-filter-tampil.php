<?php include "readme.php";?>
<?php include "views/header.php"; ?>
<?php 
    $id_dokter    = $_POST['id_dokter'];
    $tanggal      = $_POST['tanggal'];
    $id_sesi      = $_POST['id_sesi'];
?>
  <nav>
  <div id="wrapper">
    <?php include "menu.php"; ?>
  </div><!-- /.navbar-collapse -->
  </nav>
  <div id="page-wrapper">
    <div class="row">
    <div class="col-lg-12">
      <?php
        include '../koneksi.php';
        $a = mysqli_query($koneksi,"SELECT COUNT(*) AS total
        FROM booking
        WHERE booking_tanggal = '$tanggal'
        AND id_sesi = '$id_sesi'
        AND id_dokter='$id_dokter';");
        while($b = mysqli_fetch_array($a)){
        $total = $b['total'];
      ?>
      <h1>Antrian <small> <?php echo $total;}?> Pasien</small></h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a href="booking-filter"><i class="fa fa-search"></i> Cari</a></li>
          <li class="active"><i class="fa fa-list"></i> List</li>
        </ol>  
      <?php include "../notifikasi1.php"?>
    </div>
    </div>
  <div class="row">
  <div class="col-lg-12">
  <div class="table-responsive">
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
          <th><center>Keterangan</th>
          <th><center>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          include '../koneksi.php';
          $no = 1;
          date_default_timezone_set("Asia/Jakarta");
          $tanggalHariIni=date('Y-m-d');
          $data = mysqli_query($koneksi,"SELECT *, dokter.nama_dokter, sesi.nama_sesi,
          IF (booking.status='1', 'Datang', 'Belum Datang') AS status
          FROM booking, dokter, sesi
          WHERE booking.id_dokter=dokter.id_dokter
          AND booking.id_sesi=sesi.id_sesi
          AND booking.booking_tanggal = '$tanggal'
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
          <td><center><?php echo $d['keterangan']; ?></td>
          <td>
            <div align="center">
              <a href="booking-detail?id_booking=<?php echo $d['id_booking']; ?>"
              <button type="button" class="btn btn-warning">Detail</a><br><br>
            </div>
          </td>
        </tr><?php } ?>
      </tbody>
    </table>
  </div>
  </div>
  </div><!-- /.row -->
  </div><!-- /#wrapper -->
  <?php include "views/footer.php"; ?>
