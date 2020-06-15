<?php include "readme.php";?>
<?php include "views/header.php"; ?>
<?php 
$id_petugas  = $_POST['id_petugas'];
$jadwal      = $_POST['jadwal'];
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
      $a = mysqli_query($koneksi,
        "SELECT COUNT(id_tumbang) AS total
        FROM tumbang
        WHERE jadwal = '$jadwal'
        AND sesi = '$sesi'
        AND id_petugas='$id_petugas';");
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
    </div><!-- /.row -->
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
                          <th><center>Petugas</th>
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
                                    $data = mysqli_query($koneksi,
                                      "SELECT *, tumbang_petugas.nama_petugas, sesi.nama_sesi,
                                      IF (tumbang.status='1', 'Datang', 'Belum Datang') AS status
                                      FROM tumbang, tumbang_petugas, sesi
                                      WHERE tumbang.id_petugas=tumbang_petugas.id_petugas
                                      AND tumbang.id_sesi=sesi.id_sesi
                                      AND tumbang.jadwal = '$jadwal'
                                      AND tumbang.id_petugas='$id_petugas' ORDER BY tumbang.id_tumbang ASC;");
                                    while($d = mysqli_fetch_array($data)){
                                      ?>
                                      <tr>
                                        <td><center><?php echo $no++; ?></td>
                                          <td><center><?php echo $d['id_catatan_medik']; ?></td>
                                            <td><center><?php echo $d['nama']; ?></td>
                                              <td><center><?php echo $d['alamat']; ?></td>
                                                <td><center><?php echo $d['kontak']; ?></td>
                                                  <td><center><?php echo $d['nama_petugas']; ?></td>
                                                    <td><center><?php echo $d['jadwal']; ?></td>
                                                      <td><center><?php echo $d['nama_sesi']; ?></td>
                                                        <td><center><?php echo $d['status']; ?></td>
                                                          <td><center><?php echo $d['keterangan']; ?></td>
                                                            <td>
                                                              <div align="center">
                                                                <a href="tumbang-detail?id_tumbang=<?php echo $d['id_tumbang']; ?>"
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
