<?php include "readme.php";?>
<?php
	include "views/header.php";
	$m = 31;
	$n = 7;
	$nextN = mktime(0, 0, 0, date("m"), date("d") + $m, date("Y"));
	$prevN = mktime(0, 0, 0, date("m"), date("d") - $n, date("Y"));
	$mak   = date("Y-m-d", $nextN);
	$min   = date("Y-m-d", $prevN);

	function format_mak($mak)
                    {
                        $bulan = array (1 =>   'Januari',
                                    'Februari',
                                    'Maret',
                                    'April',
                                    'Mei',
                                    'Juni',
                                    'Juli',
                                    'Agustus',
                                    'September',
                                    'Oktober',
                                    'November',
                                    'Desember'
                                );
                        $split = explode('-', $mak);
                        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
                    }
                  function format_min($min)
                    {
                        $bulan = array (1 =>   'Januari',
                                    'Februari',
                                    'Maret',
                                    'April',
                                    'Mei',
                                    'Juni',
                                    'Juli',
                                    'Agustus',
                                    'September',
                                    'Oktober',
                                    'November',
                                    'Desember'
                                );
                        $split = explode('-', $min);
                        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
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
            <h1>Pencarian <small> Registrasi</small></h1>
            <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-search"></i> Cari</li>
            </ol>
            <?php include "../notifikasi1.php"?>
            <div class="alert alert-warning alert-dismissable">
			    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			    <font size='3'>Pencarian data registrasi minimal tanggal <b><?php echo format_min($min).'</b> dan maksimal tanggal <b>'.format_mak($mak);?></font></b>
			</div>
          </div>
        </div><!-- /.row -->
        <div class="row">
          <div class="col-lg-12">
          <div class="table-responsive">
            <form method="post" action="laporan-per-dokter-tampil" role="form">
            <div class="col-lg-6">
            	<div class="form-group">
                <label>Dokter</label>
                <select class="form-control" type="text" name="id_dokter">
                <p style="color:red;"><?php echo ($error['id_dokter']) ? $error['id_dokter'] : ''; ?></p>
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
                <label>Dari Tanggal</label>
                <input class="form-control" type="date" name="awal">
              </div>
              <div class="form-group">
                <label>Sampai Tanggal</label>
                <input class="form-control" type="date" name="akhir">
              </div>
              <div class="form-group">
                <label>Sesi</label>
                <select class="form-control" type="text" name="id_sesi">
                <p style="color:red;"><?php echo ($error['id_sesi']) ? $error['id_sesi'] : ''; ?></p>
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
            </div>
            </form>
            <div class="col-lg-6">
            <form method="post" action="booking-cari-rm" role="form">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Nomor RM</label>
                <input class="form-control" type="text" name="id_catatan_medik" placeholder="Nomor Rekam Medik">
              </div><button type="submit" class="btn btn-success">Cari</button>
            </div>
          </form><br>
          <form method="post" action="booking-cari-nama" role="form">
          <div class="col-lg-12">
              <div class="form-group">
                <label>Nama Pasien</label>
                <input class="form-control" type="text" name="nama" placeholder="Nama Pasien"">
              </div><button type="submit" class="btn btn-success">Cari</button>
            </div>
            </form>
          </div>
          </div>
        </div><!-- /.row -->
      </div><br><br><?php include "../copyright.php";?><br><br><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->
    <?php include "views/footer.php"; ?>