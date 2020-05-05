<?php include "readme.php";?>
<?php include "views/header.php"; ?>
<?php $id_dokter = $_GET['id_dokter']; ?>
<?php
	include '../koneksi.php';
	$a=mysqli_query($koneksi,
        "SELECT nama_dokter
        FROM dokter
        WHERE id_dokter = '$id_dokter';");
        while($b = mysqli_fetch_array($a)){
        	$nama_dokter = $b['nama_dokter'];
        }
?>
  <nav>
    <div id="wrapper">
      <?php include "menu.php"; ?>
        </div><!-- /.navbar-collapse -->
      </nav>
      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1>Jadwal <small><?php include 'tanggal-sekarang.php';?></small></h1>
            <ol class="breadcrumb">
              <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-list"></i> Dokter <?php echo $nama_dokter ?> </li>
            </ol>  
            <?php include "../notifikasi1.php"?>
          </div>
        </div><!-- /.row -->
        <div class="row">
          <div class="col-lg-12">
          <div class="table-responsive">
              <div class="btn-group">
                  <button type="button" class="btn btn-primary">Per Dokter</button>
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li disabled selected><a href="dashboard">All</a></li>
                    <?php 
                    include '../koneksi.php';
                    date_default_timezone_set("Asia/Jakarta");
                    $tanggalHariIni=date('Y-m-d');
                    $data = mysqli_query($koneksi,
                      "SELECT *, dokter.nama_dokter
                      FROM booking, dokter
                      WHERE booking.id_dokter=dokter.id_dokter
                      AND booking.booking_tanggal='$tanggalHariIni'
                      GROUP BY booking.id_dokter;");
                    while($d = mysqli_fetch_array($data)){
                    echo "<li><a href='booking-tab?id_dokter=".$d['id_dokter']."'>".$d['nama_dokter']."</a></li>";
                    }
                  ?>
                  </ul>
                </div><br><br><!-- /btn-group -->
            <div class="row">
        <div class="col-lg-12">
          <ul class="nav nav-tabs" style="margin-bottom: null;">
                  <li class="active"><a href="#0" data-toggle="tab">All</a></li>
                  <li><a href="#1" data-toggle="tab">Pagi</a></li>
                  <li><a href="#2" data-toggle="tab">Siang</a></li>
                  <li><a href="#3" data-toggle="tab">Sore</a></li>
                  <li><a href="#4" data-toggle="tab">Malam</a></li>
               </ul>
            <div id="myTabContent" class="tab-content">
          <div class="tab-pane fade active in" id="0">
          <div class="row">
          <div class="col-lg-12">
          <div class="table-responsive">
            <div align="right">
              <?php 
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,
                      "SELECT COUNT(*) AS total
                      FROM booking
                      WHERE booking.id_dokter='$id_dokter'
                      AND booking.booking_tanggal='$tanggalHariIni';");
                    while($d = mysqli_fetch_array($data)){
                  ?>
              <h1><small>Total <?php echo $d['total']; }?> Pasien</small></h1>
            </div>
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr>
                    <th><center>No</th>
                    <th><center>No. RM</th>
                    <th><center>Nama Pasien</th>
                    <th><center>Kontak</th>
                    <th><center>Dokter</th>
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
                    $data = mysqli_query($koneksi,
                      "SELECT *, dokter.nama_dokter, sesi.nama_sesi,
                      IF (booking.status='1', 'Datang', 'Belum Datang') AS status
                      FROM booking, dokter, sesi
                      WHERE booking.id_dokter=dokter.id_dokter
                      AND booking.id_sesi=sesi.id_sesi
                      AND booking.booking_tanggal='$tanggalHariIni'
                      AND booking.id_dokter='$id_dokter'
                      ORDER BY booking.id_sesi, booking.id_booking ASC;");
                    while($d = mysqli_fetch_array($data)){
                  ?>
                  <tr>
                    <td><center><?php echo $no++; ?></td>
                    <td><center><?php echo $d['id_catatan_medik']; ?></td>
                    <td><center><?php echo $d['nama']; ?></td>
                    <td><center><?php echo $d['kontak']; ?></td>
                    <td><center><?php echo $d['nama_dokter']; ?></td>
                    <td><center><?php echo $d['nama_sesi']; ?></td>
                    <td><center><?php echo $d['status']; ?></td>
                    <td><center><?php echo $d['keterangan']; ?></td>
                    <td>
                      <div align="center">
                      	<form method="post" action="booking-datang-proses-tab" role="form">
                      		<input type="text" name="id_booking"
                			value="<?php echo $d['id_booking']; ?>" hidden>
                			<input type="text" name="id_dokter"
                			value="<?php echo $id_dokter ?>" hidden>
                        	<button onclick="javascript: return confirm('Sudah Datang?')" 
                        	type="submit" class="btn btn-success">Datang</button>
                        </form><br>
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
        </div>
      </div>
          <div class="tab-pane fade" id="1">
          <div class="row">
          <div class="col-lg-12">
          <div class="table-responsive">
            <div align="right" class="col-lg-12">
              <?php 
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,
                      "SELECT COUNT(*) AS total
                      FROM booking
                      WHERE booking.id_dokter='$id_dokter'
                      AND booking.id_sesi='1'
                      AND booking.booking_tanggal='$tanggalHariIni';");
                    while($d = mysqli_fetch_array($data)){
                  ?>
              <h1><small>Total <?php echo $d['total']; }?> Pasien</small></h1>
            </div>
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr>
                    <th><center>No</th>
                    <th><center>No. RM</th>
                    <th><center>Nama Pasien</th>
                    <th><center>Kontak</th>
                    <th><center>Dokter</th>
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
                    $data = mysqli_query($koneksi,
                      "SELECT *, dokter.nama_dokter, sesi.nama_sesi,
                      IF (booking.status='1', 'Datang', 'Belum Datang') AS status
                      FROM booking, dokter, sesi
                      WHERE booking.id_dokter=dokter.id_dokter
                      AND booking.id_sesi=sesi.id_sesi
                      AND booking.booking_tanggal='$tanggalHariIni'
                      AND booking.id_dokter='$id_dokter'
                      AND booking.id_sesi='1'
                      ORDER BY booking.id_sesi, booking.id_booking ASC;");
                    while($d = mysqli_fetch_array($data)){
                  ?>
                  <tr>
                    <td><center><?php echo $no++; ?></td>
                    <td><center><?php echo $d['id_catatan_medik']; ?></td>
                    <td><center><?php echo $d['nama']; ?></td>
                    <td><center><?php echo $d['kontak']; ?></td>
                    <td><center><?php echo $d['nama_dokter']; ?></td>
                    <td><center><?php echo $d['nama_sesi']; ?></td>
                    <td><center><?php echo $d['status']; ?></td>
                    <td><center><?php echo $d['keterangan']; ?></td>
                    <td>
                      <div align="center">
                        <form method="post" action="booking-datang-proses-tab" role="form">
                      		<input type="text" name="id_booking"
                			value="<?php echo $d['id_booking']; ?>" hidden>
                			<input type="text" name="id_dokter"
                			value="<?php echo $id_dokter ?>" hidden>
                        	<button onclick="javascript: return confirm('Sudah Datang?')" 
                        	type="submit" class="btn btn-success">Datang</button>
                        </form><br>
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
          </div>
    </div>
    <div class="tab-pane fade" id="2">
          <div class="row">
          <div class="col-lg-12">
          <div class="table-responsive">
             <div align="right" class="col-lg-12">
              <?php 
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,
                      "SELECT COUNT(*) AS total
                      FROM booking
                      WHERE booking.id_dokter='$id_dokter'
                      AND booking.id_sesi='2'
                      AND booking.booking_tanggal='$tanggalHariIni';");
                    while($d = mysqli_fetch_array($data)){
                  ?>
              <h1><small>Total <?php echo $d['total']; }?> Pasien</small></h1>
            </div>
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr>
                    <th><center>No</th>
                    <th><center>No. RM</th>
                    <th><center>Nama Pasien</th>
                    <th><center>Kontak</th>
                    <th><center>Dokter</th>
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
                    $data = mysqli_query($koneksi,
                      "SELECT *, dokter.nama_dokter, sesi.nama_sesi,
                      IF (booking.status='1', 'Datang', 'Belum Datang') AS status
                      FROM booking, dokter, sesi
                      WHERE booking.id_dokter=dokter.id_dokter
                      AND booking.id_sesi=sesi.id_sesi
                      AND booking.booking_tanggal='$tanggalHariIni'
                      AND booking.id_dokter='$id_dokter'
                      AND booking.id_sesi='2'
                      ORDER BY booking.id_sesi, booking.id_booking ASC;");
                    while($d = mysqli_fetch_array($data)){
                  ?>
                  <tr>
                    <td><center><?php echo $no++; ?></td>
                    <td><center><?php echo $d['id_catatan_medik']; ?></td>
                    <td><center><?php echo $d['nama']; ?></td>
                    <td><center><?php echo $d['kontak']; ?></td>
                    <td><center><?php echo $d['nama_dokter']; ?></td>
                    <td><center><?php echo $d['nama_sesi']; ?></td>
                    <td><center><?php echo $d['status']; ?></td>
                    <td><center><?php echo $d['keterangan']; ?></td>
                    <td>
                      <div align="center">
                        <form method="post" action="booking-datang-proses-tab" role="form">
                      		<input type="text" name="id_booking"
                			value="<?php echo $d['id_booking']; ?>" hidden>
                			<input type="text" name="id_dokter"
                			value="<?php echo $id_dokter ?>" hidden>
                        	<button onclick="javascript: return confirm('Sudah Datang?')" 
                        	type="submit" class="btn btn-success">Datang</button>
                        </form><br>
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
        </div>
    </div>
    <div class="tab-pane fade" id="3">
          <div class="row">
          <div class="col-lg-12">
          <div class="table-responsive">
             <div align="right" class="col-lg-12">
              <?php 
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,
                      "SELECT COUNT(*) AS total
                      FROM booking
                      WHERE booking.id_dokter='$id_dokter'
                      AND booking.id_sesi='3'
                      AND booking.booking_tanggal='$tanggalHariIni';");
                    while($d = mysqli_fetch_array($data)){
                  ?>
              <h1><small>Total <?php echo $d['total']; }?> Pasien</small></h1>
            </div>
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr>
                    <th><center>No</th>
                    <th><center>No. RM</th>
                    <th><center>Nama Pasien</th>
                    <th><center>Kontak</th>
                    <th><center>Dokter</th>
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
                    $data = mysqli_query($koneksi,
                      "SELECT *, dokter.nama_dokter, sesi.nama_sesi,
                      IF (booking.status='1', 'Datang', 'Belum Datang') AS status
                      FROM booking, dokter, sesi
                      WHERE booking.id_dokter=dokter.id_dokter
                      AND booking.id_sesi=sesi.id_sesi
                      AND booking.booking_tanggal='$tanggalHariIni'
                      AND booking.id_dokter='$id_dokter'
                      AND booking.id_sesi='3'
                      ORDER BY booking.id_sesi, booking.id_booking ASC;");
                    while($d = mysqli_fetch_array($data)){
                  ?>
                  <tr>
                    <td><center><?php echo $no++; ?></td>
                    <td><center><?php echo $d['id_catatan_medik']; ?></td>
                    <td><center><?php echo $d['nama']; ?></td>
                    <td><center><?php echo $d['kontak']; ?></td>
                    <td><center><?php echo $d['nama_dokter']; ?></td>
                    <td><center><?php echo $d['nama_sesi']; ?></td>
                    <td><center><?php echo $d['status']; ?></td>
                    <td><center><?php echo $d['keterangan']; ?></td>
                    <td>
                      <div align="center">
                        <form method="post" action="booking-datang-proses-tab" role="form">
                      		<input type="text" name="id_booking"
                			value="<?php echo $d['id_booking']; ?>" hidden>
                			<input type="text" name="id_dokter"
                			value="<?php echo $id_dokter ?>" hidden>
                        	<button onclick="javascript: return confirm('Sudah Datang?')" 
                        	type="submit" class="btn btn-success">Datang</button>
                        </form><br>
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
        </div>
    </div>
    <div class="tab-pane fade" id="4">
          <div class="row">
          <div class="col-lg-12">
          <div class="table-responsive">
             <div align="right" class="col-lg-12">
              <?php 
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,
                      "SELECT COUNT(*) AS total
                      FROM booking
                      WHERE booking.id_dokter='$id_dokter'
                      AND booking.id_sesi='4'
                      AND booking.booking_tanggal='$tanggalHariIni';");
                    while($d = mysqli_fetch_array($data)){
                  ?>
              <h1><small>Total <?php echo $d['total']; }?> Pasien</small></h1>
            </div>
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr>
                    <th><center>No</th>
                    <th><center>No. RM</th>
                    <th><center>Nama Pasien</th>
                    <th><center>Kontak</th>
                    <th><center>Dokter</th>
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
                    $data = mysqli_query($koneksi,
                      "SELECT *, dokter.nama_dokter, sesi.nama_sesi,
                      IF (booking.status='1', 'Datang', 'Belum Datang') AS status
                      FROM booking, dokter, sesi
                      WHERE booking.id_dokter=dokter.id_dokter
                      AND booking.id_sesi=sesi.id_sesi
                      AND booking.booking_tanggal='$tanggalHariIni'
                      AND booking.id_dokter='$id_dokter'
                      AND booking.id_sesi='4'
                      ORDER BY booking.id_sesi, booking.id_booking ASC;");
                    while($d = mysqli_fetch_array($data)){
                  ?>
                  <tr>
                    <td><center><?php echo $no++; ?></td>
                    <td><center><?php echo $d['id_catatan_medik']; ?></td>
                    <td><center><?php echo $d['nama']; ?></td>
                    <td><center><?php echo $d['kontak']; ?></td>
                    <td><center><?php echo $d['nama_dokter']; ?></td>
                    <td><center><?php echo $d['nama_sesi']; ?></td>
                    <td><center><?php echo $d['status']; ?></td>
                    <td><center><?php echo $d['keterangan']; ?></td>
                    <td>
                      <div align="center">
                        <form method="post" action="booking-datang-proses-tab" role="form">
                      		<input type="text" name="id_booking"
                			value="<?php echo $d['id_booking']; ?>" hidden>
                			<input type="text" name="id_dokter"
                			value="<?php echo $id_dokter ?>" hidden>
                        	<button onclick="javascript: return confirm('Sudah Datang?')" 
                        	type="submit" class="btn btn-success">Datang</button>
                        </form><br>
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
        </div>
      </div>
    </div><!-- /.row -->
                </div>
          </div>
        </div><!-- /.row -->
        <br><br><?php include "../copyright.php";?>
      </div><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->
    <?php include "views/footer.php"; ?>