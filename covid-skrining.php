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
            <h1>Skrining <small>COVID-19</small></h1>
            <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="booking-tambah"><i class="fa fa-plus"></i> Tambah</a></li>
              <li class="active"><i class="fa fa-list"></i> Skrining</li>
            </ol>
            <?php include "../notifikasi1.php"?>
          </div>
        </div><!-- /.row -->
        <div class="row">
          <div class="col-lg-6">
            <?php
              if(isset($_POST['diagnosa'])){
                include '../koneksi.php';
                // menangkap data yang di kirim dari form
                $A1 = $_POST['a1'];
                $A2 = $_POST['a2'];
                $A3 = $_POST['a3'];
                $B1 = $_POST['b1'];
                $C1 = $_POST['c1'];
                $C2 = $_POST['c2'];
                $C3 = $_POST['c3'];

               if($A1==1 && $A2==1 && $A3==1 && $B1==1 && $C1==1 ||
                  $A1==1 && $A2==1 && $B1==1 && $C1==1 ||
                  $A1==1 && $A2==1 && $A3==1 && $B1==1 && $C2==1 ||
                  $A1==1 && $A2==1 && $B1==1 && $C2==1 ||
                  $A1==1 && $C3==1 ||
                  $A2==1 && $C3==1 ||
                  $A1==1 && $A2==1 && $A3==1 && $C3==1 ||
                  $A1==1 && $A2==1 && $C3==1 ||
                  $A1==1 && $A2==1 && $A3==1 && $B1==1){
                echo "<script>
                    setTimeout(function() {
                        swal({
                            title: 'P.D.P',
                            text: 'Curiga Pasien Dalam Pengawasan',
                            type: 'error'
                        }, function() {
                            window.location = 'booking-tambah';
                        });
                    }, 10);
                </script>";
           }elseif($A1==1 && $B1==1 && $C1==1 ||
                   $A2==1 && $B1==1 && $C1==1 ||
                   $A1==1 && $B1==1 && $C2==1 ||
                   $A1==2 && $B1==1 && $C2==1){
                echo "<script>
                    setTimeout(function() {
                        swal({
                            title: 'O.D.P',
                            text: 'Curiga Orang Dalam Pengawasan',
                            type: 'warning'
                        }, function() {
                            window.location = 'booking-tambah';
                        });
                    }, 10);
                </script>";
                }else{
                echo "<script>
                    setTimeout(function() {
                        swal({
                            title: 'Inshaallah Aman',
                            text: 'Pasien Aman',
                            type: 'success'
                        }, function() {
                            window.location = 'booking-tambah';
                        });
                    }, 10);
                </script>";
                }
              }
            ?>
            <form method="post" action="" role="form">
              <h5 class="bluetext"><b>A. Gejala</b></h5>
              <div class="form-group">
                <label>1.</label> Apakah pasien (termasuk 1 pendamping) merasa demam >38&deg;C / riwayat demam <14 hari?
                <select class="form-control" type="text" name="a1">
                  <option disabled selected>Pilih</option>
                  <option value='1'>Ya</option>
                  <option value='0'>Tidak</option>"
                </select>
              </div>
              <div class="form-group">
                <label>2.</label> Apakah pasien (pendamping) merasa batuk / pilek / sakit tenggorokan / sesak nafas <14 hari?
                <select class="form-control" type="text" name="a2">
                  <option disabled selected>Pilih</option>
                  <option value='1'>Ya</option>
                  <option value='0'>Tidak</option>"
                </select>
              </div>
              <div class="form-group">
                <label>3.</label> Apakah pasien (pendamping) merasakan nafas cepat / terasa berat <14 hari?<br>
                <select class="form-control" type="text" name="a3">
                  <option disabled selected>Pilih</option>
                  <option value='1'>Ya</option>
                  <option value='0'>Tidak</option>"
                </select>
              </div>
              <h5 class="bluetext"><b>B. Penyebab (Evaluasi DPJP)</b></h5>
              <div class="form-group">
                <label>1.</label> Tidak ada penyebab lain berdasarkan gambaran klinis yang meyakinkan
                <select class="form-control" type="text" name="b1">
                  <option value='1' selected >Ya (Otomatis)</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <h5 class="bluetext"><b>C. Faktor Risiko</b></h5>
              <div class="form-group">
                <label>1.</label> Apakah pasien (pendamping) memiliki riwayat perjalanan / tinggal di luar negeri dalam waktu 14 hari sebelum timbul gejala?
                <select class="form-control" type="text" name="c1">
                  <option disabled selected>Pilih</option>
                  <option value='1'>Ya</option>
                  <option value='0'>Tidak</option>"
                </select>
              </div>
               <div class="form-group">
                <label>2.</label> Apakah pasien (pendamping) memiliki riwayat bepergian dari area transmisi lokal di Indonesia / dari luar kota Yogyakarta / Indogrosir Yogyakarta, dalam waktu 14 hari sebelum timbul gejala?
                <select class="form-control" type="text" name="c2">
                  <option disabled selected>Pilih</option>
                  <option value='1'>Ya</option>
                  <option value='0'>Tidak</option>"
                </select>
              </div>
              <div class="form-group">
                <label>3.</label> Apakah pasien (pendamping) memiliki riwayat kontak erat dengan pasien yang diduga maupun yang positif COVID-19?<br>
                <select class="form-control" type="text" name="c3">
                  <option disabled selected>Pilih</option>
                  <option value='1'>Ya</option>
                  <option value='0'>Tidak</option>"
                </select>
              </div>
              <button type="submit" name="diagnosa" class="btn btn-success">Diagnosis</button>
              <!--<button type="reset" class="btn btn-warning">Reset</button>--> 
            </form>
          </div>
        </div><!-- /.row -->
      </div><br><br><?php include "../copyright.php";?><br><br><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->
  <?php include "views/footer.php"; ?> 