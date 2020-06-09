<?php include "readme.php";?>
<?php
  date_default_timezone_set("Asia/Jakarta");
  $tanggalHariIni=date('Y-m-d');
?>
<div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <ul class="nav nav-pills" style="margin-bottom: 15px;">
            <li class="active"><a href="#1" data-toggle="tab">Poliklinik</a></li>
            <li><a href="#2" data-toggle="tab">Tumbuh Kembang</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="1">
            <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">
            <h3 align="center">Poliklinik</h3><br>
            <div class="col-lg-8">
            <form method="post" action="laporan-booking-hari-ini-export" role="form">
              <button type="submit" class="btn btn-success">EXPORT</button>
              <div class="btn-group">
                  <button type="button" class="btn btn-primary">Per Dokter</button>
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li disabled selected><a>All</a></li>
                    <?php 
                    include '../koneksi.php';
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
                </div><!-- /btn-group -->
            </form>
          </div>
          <div align="right" class="col-lg-4">
              <?php 
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,
                      "SELECT COUNT(id_booking) AS total
                      FROM booking
                      WHERE booking.booking_tanggal='$tanggalHariIni';");
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
                      ORDER BY booking.id_sesi, booking.nama ASC;");
                    while($d = mysqli_fetch_array($data)){
                  ?>
                  <tr>
                    <td><center><?php echo $no++; ?></td>
                    <td><center><?php echo $d['id_catatan_medik']; ?></td>
                    <td><center><?php echo $d['nama']; ?></td>
                    <td><center><?php echo $d['nama_dokter']; ?></td>
                    <td><center><?php echo $d['nama_sesi']; ?></td>
                    <td><center><?php echo $d['status']; ?></td>
                    <td><center><?php echo $d['keterangan']; ?></td>
                    <td>
                      <div align="center">
                        <a href="booking-datang-proses?id_booking=<?php echo $d['id_booking']; ?>"
                           onclick="javascript: return confirm('Sudah Datang?')"
                        <button type="button" class="btn btn-success">Datang</a><br><br>
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
      <div class="tab-pane fade in" id="2">
            <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">
              <?php include "tumbang-tampil.php";?>
            </div>
            </div>
            </div>
            </div>
    </div>
  </div>
</div><!-- /.row -->