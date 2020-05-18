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
            <h1>Tambah <small>Dokter</small></h1>
            <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-plus"></i> Dokter</li>
            </ol>
            <?php include "../notifikasi1.php"?>
          </div>
        </div><!-- /.row -->
        <div class="row">
          <div class="col-lg-6">
            <?php
              if (isset($_POST['tambah'])) {
echo "<script>
setTimeout(function () {
swal({
title: 'Success',
text: 'Anda Berhasil',
type: 'success',
});
},10);
</script>";
}
            ?>
            <form method="post" action="" role="form">
              <div class="form-group">
                <label>Nama Dokter</label>
                <input class="form-control" type="text" name="nama_dokter" placeholder="Contoh : Sulchan Sofoewan, Ph.D, Sp.OG (K). Prof. dr.">
                <p style="color:blue">Tuliskan nama dokter sesuai di SIMRS!!!
                <p style="color:red;"><?php echo ($error['nama_dokter']) ? $error['nama_dokter'] : ''; ?></p>
              </div>
              <div class="form-group">
                <label>Spesialis</label>
                <select class="form-control" type="text" name="id_unit" required="">
                <p style="color:red;"><?php echo ($error['id_unit']) ? $error['id_unit'] : ''; ?></p>
                  <option disabled selected>Pilih</option>
                  <option value='1'>Dokter Anak</option>
                  <option value='2'>Dokter Kandungan</option>"
                </select>
              </div>
              <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
              <button type="reset" class="btn btn-warning">Reset</button>  
            </form>
          </div>
        </div><!-- /.row -->
      </div><br><br><?php include "../copyright.php";?><br><br><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->
  <?php include "views/footer.php"; ?> 