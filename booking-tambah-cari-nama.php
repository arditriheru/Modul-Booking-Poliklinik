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
      <h1>Daftar <small>Poliklinik</small></h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="booking-tambah"><i class="fa fa-plus"></i> Tambah</a></li>
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
                <th><center>No. RM</th>
                  <th><center>Nama Pasien</th>
                    <th><center>T.T.L</th>
                      <th><center>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      include '../koneksi.php';
                      $no = 1;
                      $nama = $_POST['nama'];
                      $data = mysqli_query($koneksi,"SELECT * FROM mr_pasien WHERE nama LIKE '%' '$nama' '%';");
                      while($d = mysqli_fetch_array($data)){
                        $tgl_lahir = $d['tgl_lahir'];
                        ?>
                        <tr>
                          <td><center><?php echo $no++; ?></td>
                            <td><center><?php echo $d['id_catatan_medik']; ?></td>
                              <td><center><?php echo $d['nama']; ?></td>
                                <td><center><?php echo $d['tempat']; ?>, <?php echo date("d F Y", strtotime($tgl_lahir)); ?></td>
                                  <td>
                                    <div align="center">
                                      <a href="booking-tambah-cari-nama-eksekusi?id_register=<?php echo $d['id_register']; ?>"
                                        <button type="button" class="btn btn-success">Daftar</a><br><br>
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