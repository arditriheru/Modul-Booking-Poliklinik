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
            <h1>Lihat <small> Antrian</small></h1>
            <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-search"></i> Cari</li>
            </ol>
            <?php include "../notifikasi1.php"?>
          </div>
                  <div class="col-lg-12">
        <div class="table-responsive">
          <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li><a href="#1" data-toggle="tab">Poliklinik</a></li>
            <li><a href="#2" data-toggle="tab">Tumbuh Kembang</a></li>
          </ul>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="1">
            <div class="row">
            <div class="col-lg-6">
            <div class="table-responsive">
              <h3 align="center">Poliklinik</h3><br>
              <form method="post" action="booking-filter-tampil" role="form">
              <div class="form-group">
                <label>Nama Dokter</label>
                <select class="form-control" type="text" name="id_dokter">
                <p style="color:red;"><?php echo ($error['dokter']) ? $error['dokter'] : ''; ?></p>
                  <option disabled selected>Pilih</option>
                  <?php 
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,
                      "SELECT * FROM dokter WHERE status=1;");
                    while($d = mysqli_fetch_array($data)){
                    echo "<option value='".$d['id_dokter']."'>".$d['nama_dokter']."</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Jadwal</label>
                <input class="form-control" type="date" name="tanggal">
              </div>
              <div class="form-group">
                <label>Sesi</label>
                <select class="form-control" type="text" name="id_sesi">
                <p style="color:red;"><?php echo ($error['sesi']) ? $error['sesi'] : ''; ?></p>
                  <option disabled selected>Pilih</option>
                  <?php 
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,
                      "SELECT * FROM sesi;");
                    while($d = mysqli_fetch_array($data)){
                    echo "<option value='".$d['id_sesi']."'>".$d['nama_sesi']."</option>";
                    }
                  ?>
                </select>
              </div>
              <button type="submit" class="btn btn-success">Cari</button>
              </form>
            </div>
            </div>
            </div>
            </div>

            <div class="tab-pane fade in" id="2">
            <div class="row">
            <div class="col-lg-6">
            <div class="table-responsive">
              <h3 align="center">Tumbuh Kembang</h3><br>
                <form method="post" action="tumbang-filter-tampil" role="form">
              <div class="form-group">
                <label>Nama Petugas</label>
                <select class="form-control" type="text" name="id_petugas">
                <p style="color:red;"><?php echo ($error['id_petugas']) ? $error['id_petugas'] : ''; ?></p>
                  <option disabled selected>Pilih</option>
                  <?php 
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,
                      "SELECT * FROM tumbang_petugas WHERE status=1;");
                    while($d = mysqli_fetch_array($data)){
                    echo "<option value='".$d['id_petugas']."'>".$d['nama_petugas']."</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Jadwal</label>
                <input class="form-control" type="date" name="jadwal">
              </div>
              <div class="form-group">
                <label>Sesi</label>
                <input class="form-control" type="text" name="sesi">
              </div>
              <button type="submit" class="btn btn-success">Cari</button>
              </form>
            </div>
            </div>
            </div>
            </div>
          </div>
        </div>
        </div>
        </div><!-- /.row -->
      <br><br><?php include "../copyright.php";?><br><br><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->
    <?php include "views/footer.php"; ?>