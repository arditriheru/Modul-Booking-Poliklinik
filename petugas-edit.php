<?php include "readme.php";?>
<?php include "views/header.php"; ?>
<?php  $id_petugas = $_GET['id']; ?>
    <nav>
    <div id="wrapper">
      <?php include "menu.php"; ?>   
        </div><!-- /.navbar-collapse -->
      </nav>
      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1>Form <small>Edit</small></h1>
            <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-pencil"></i> Edit</li>
            </ol>
            <?php include "../notifikasi1.php"?>
          </div>
        </div><!-- /.row -->
        <div class="row">
          <div class="col-lg-6">
        <?php 
          include '../koneksi.php';
          $data = mysqli_query($koneksi,
              "SELECT * FROM tumbang_petugas WHERE id_petugas='$id_petugas';");
          while($d = mysqli_fetch_array($data)){
        ?>
            <?php
              if(isset($_POST['submit'])){
                include '../koneksi.php';
                $nama_petugas 	= $_POST['nama_petugas'];
                $status 		  = $_POST['status'];

                $error=array();
                if (empty($nama_petugas)){
                  $error['nama_petugas']='Nama Petugas Harus Diisi!!!';
                }if(empty($error)){
                  $simpan=mysqli_query($koneksi,"UPDATE tumbang_petugas 
                  	SET nama_petugas='$nama_petugas',status='$status'
                  	WHERE id_petugas='$id_petugas'");
                if($simpan){
                echo '<script>
                    setTimeout(function() {
                        swal({
                            title: "Sukses!!!",
                            text: "Berhasil Memperbarui",
                            type: "success"
                        }, function() {
                            window.location = "dokter-tambah";
                        });
                    }, 10);
                </script>';
                }else{
                echo '<script>
                    setTimeout(function() {
                        swal({
                            title: "Gagal!!!",
                            type: "error"
                        }, function() {
                            window.location = "dokter-tambah";
                        });
                    }, 10);
                </script>';
                  }
                }
              }
            ?>
            <form method="post" action="" role="form">
              <div class="form-group">
                <label>Nama Petugas</label>
                <input class="form-control" type="text" name="nama_petugas"
                value="<?php echo $d['nama_petugas']; ?>" required="">
                <p style="color:blue">Tuliskan nama dokter sesuai di SIMRS!!!
                <p style="color:red;"><?php echo ($error['nama_petugas']) ? $error['nama_petugas'] : ''; ?></p>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" type="text" name="status">
                <p style="color:red;"><?php echo ($error['status']) ? $error['status'] : ''; ?></p>
                <?php 
                  include '../koneksi.php';
                    $data = mysqli_query($koneksi,
                      "SELECT status, IF(status='1', 'Aktif', 'Nonaktif') AS nama_status
                      FROM tumbang_petugas WHERE id_petugas='$id_petugas';");
                    while($d = mysqli_fetch_array($data)){
                    echo "<option selected value='".$d['status']."'>".$d['nama_status']."</option>";
                    }
                    echo "<option disabled></option>";
                    echo "<option value='1'>Aktif</option>";
                    echo "<option value='0'>Nonaktif</option>";
                ?>
                </select>
              </div>
              <button type="submit" name="submit" class="btn btn-success">Perbarui</button>
              <button type="reset" class="btn btn-warning">Reset</button>  
            </form>
          </div>
        </div><!-- /.row -->
        <?php } ?>
      </div><br><br><?php include "../copyright.php";?><br><br><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->
  <?php include "views/footer.php"; ?> 