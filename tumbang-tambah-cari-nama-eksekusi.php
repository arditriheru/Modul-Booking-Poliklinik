          <h3 align="center">Tumbuh Kembang</h3>
            <?php 
              include '../koneksi.php';
              $id_catatan_medik = $_POST['id_catatan_medik'];
              $data = mysqli_query($koneksi,
                  "SELECT * FROM mr_pasien WHERE id_register=$id_register;");
              while($d = mysqli_fetch_array($data)){
            ?>
            <?php
              if(isset($_POST['tumbangsubmit'])){
                include '../koneksi.php';
                date_default_timezone_set("Asia/Jakarta");
                $tanggal=date('Y-m-d');
                $jam=date("h:i:sa");
                // menangkap data yang di kirim dari form
                $id_catatan_medik = $_POST['id_catatan_medik'];
                $nama             = $_POST['nama'];
                $alamat           = $_POST['alamat'];
                $kontak           = $_POST['kontak'];
                $id_petugas       = $_POST['id_petugas'];
                $jadwal           = $_POST['jadwal'];
                $sesi             = $_POST['sesi'];
                $tanggal          = $tanggal;
                $jam              = $jam;
                $status           = '0';
                $keterangan       = $_POST['keterangan'];
                // cek selisih hari
                $tglsekarang  = new DateTime();
                $cekjadwal     = new DateTime("$jadwal");
                $hasil      = $tglsekarang->diff($cekjadwal)->format("%a");
                $selisih    = $hasil;
                // cek antrian
                $a = mysqli_query($koneksi,
                  "SELECT COUNT(*) AS antrian
                  FROM tumbang
                  WHERE id_petugas='$id_petugas'
                  AND jadwal='$jadwal'
                  AND sesi='$sesi';");
                  while($b = mysqli_fetch_array($a)){

                $antrian       =  $b['antrian']+1;

                $error=array();
                if (empty($nama)){
                  $error['nama']='Nama Harus Diisi!!!';
                }if (empty($alamat)){
                  $error['alamat']='Alamat Harus Diisi!!!';
                }if (empty($kontak)){
                  $error['kontak']='Kontak Harus Diisi!!!';
                }if (empty($id_petugas)){
                  $error['id_petugas']='Petugas Harus Diisi!!!';
                }if (empty($jadwal)){
                  $error['jadwal']='Tanggal Harus Diisi!!!';
                }if (empty($sesi)){
                  $error['sesi']='Sesi Harus Diisi!!!';
                }if($selisih>30){
                echo "<script>alert('GAGAL!!! Lebih dari 30 Hari!');document.location='booking-tambah'</script>";
                  break;
                }if(empty($error)){
                  $simpan=mysqli_query($koneksi,"INSERT INTO tumbang (id_tumbang, id_catatan_medik, id_petugas, nama, alamat, kontak, jadwal, sesi, tanggal, jam, status, keterangan)
                    VALUES('','$id_catatan_medik','$id_petugas','$nama','$alamat','$kontak','$jadwal','$sesi','$tanggal','$jam','$status','$keterangan')");
                if($simpan){
                echo "<script>
                    setTimeout(function() {
                        swal({
                            title: 'Antrian $antrian',
                            text: 'Mendaftar Tumbuh Kembang',
                            type: 'success'
                        }, function() {
                            window.location = 'booking-tambah';
                        });
                    }, 10);
                </script>";
                }else{
                echo "<script>
                    setTimeout(function() {
                        swal({
                            title: 'Gagal!!!',
                            text: 'Hilangkan Tanda Petik di Nama Pasien',
                            type: 'error'
                        }, function() {
                            window.location = 'booking-tambah';
                        });
                    }, 10);
                </script>";
                  }
                }
              }
            }
          ?>
            <form method="post" action="" role="form">
              <div class="form-group">
                <label>Nomor Rekam Medik</label>
                <input class="form-control" type="text" name="id_catatan_medik"
                value="<?php echo $d['id_catatan_medik']; ?>" readonly>
                <p style="color:red;"><?php echo ($error['id_catatan_medik']) ? $error['id_catatan_medik'] : ''; ?></p>
              </div>
              <div class="form-group">
                <label>Nama Pasien</label>
                <input class="form-control" type="text" name="nama"
                value="<?php echo $d['nama']; ?>" readonly>
                <p style="color:red;"><?php echo ($error['nama']) ? $error['nama'] : ''; ?></p>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input class="form-control" type="text" name="alamat"
                value="<?php echo $d['alamat']; ?>" required="">
                <p style="color:red;"><?php echo ($error['alamat']) ? $error['alamat'] : ''; ?></p>
              </div>
              <div class="form-group">
                <label>Kontak</label>
                <input class="form-control" type="text" name="kontak"
                value="<?php echo $d['telp']; ?>" required="">
                <p style="color:red;"><?php echo ($error['kontak']) ? $error['kontak'] : ''; ?></p>
              </div>
              <div class="form-group">
                <label>Petugas</label>
                <select class="form-control" type="text" name="id_petugas" required="">
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
                <p style="color:red;"><?php echo ($error['jadwal']) ? $error['jadwal'] : ''; ?></p>
              </div>
              <div class="form-group">
                <label>Sesi</label>
                 <input class="form-control" type="text" name="sesi">
                <p style="color:red;"><?php echo ($error['sesi']) ? $error['sesi'] : ''; ?></p>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input class="form-control" type="text" name="keterangan" placeholder="Masukkan..">
              </div>
              <button type="submit" name="tumbangsubmit" class="btn btn-success">Tambah</button>
              <button type="reset" class="btn btn-warning">Reset</button>  
            </form><?php } ?>