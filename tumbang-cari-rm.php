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
      <h1>Hasil <small>Pencarian</small></h1>
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
        <table class="table table-bordered table-hover table-striped tablesorter">
          <thead>
            <tr>
              <th><center>No</th>
                <th><center>Nomor RM</th>
                  <th><center>Nama</th>
                    <th><center>Petugas</th>
                      <th><center>Jadwal</th>
                        <th><center>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        include '../koneksi.php';
                        $no = 1;
                        $id_catatan_medik = $_POST['id_catatan_medik'];
                        $data = mysqli_query($koneksi,
                          "SELECT tumbang_petugas.nama_petugas, tumbang.id_tumbang,
                          tumbang.id_catatan_medik, tumbang.nama,
                          tumbang.jadwal
                          FROM tumbang, tumbang_petugas
                          WHERE tumbang.id_petugas = tumbang_petugas.id_petugas
                          AND tumbang.id_catatan_medik = $id_catatan_medik
                          ORDER BY tumbang.jadwal DESC;");
                        while($d = mysqli_fetch_array($data)){
                          $jadwal = $d['jadwal'];
                          ?>
                          <tr>
                            <td><center><?php echo $no++; ?></td>
                              <td><center><?php echo $d['id_catatan_medik']; ?></td>
                                <td><center><?php echo $d['nama']; ?></td>
                                  <td><center><?php echo $d['nama_petugas']; ?></td>
                                    <td><center><?php echo date("d/m/Y", strtotime($jadwal)); ?></td>
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
                          </div><br><br><?php include "../copyright.php";?><br><br><!-- /#page-wrapper -->
                        </div><!-- /#wrapper -->
                        <?php include "views/footer.php"; ?>