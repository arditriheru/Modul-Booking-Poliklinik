          <h3 align="center">Tumbuh Kembang</h3>
          <?php
          if(isset($_POST['tambah'])){
            include '../koneksi.php';
                // menangkap data yang di kirim dari form
            $nama_petugas = $_POST['nama_petugas'];
            $status = '1';
                //$id_unit = $_POST['id_unit'];
                //$aktif = '0';
                //$ket = '0';

            $error=array();
            if (empty($nama_petugas)){
              $error['nama_petugas']='Nama Petugas Harus Diisi!!!';
            }if(empty($error)){
              $simpan=mysqli_query($koneksi,"INSERT INTO tumbang_petugas (id_petugas, nama_petugas, status)
                VALUES('','$nama_petugas','$status')");
              if($simpan){
                echo '<script>
                setTimeout(function() {
                  swal({
                    title: "Sukses!!!",
                    text: "Berhasil Menambah Petugas",
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
                          <input class="form-control" type="text" name="nama_petugas" placeholder="Contoh : Heru Sarmuji, S.Kom">
                          <p style="color:blue">Tuliskan nama petugas sesuai di SIMRS!!!
                            <p style="color:red;"><?php echo ($error['nama_petugas']) ? $error['nama_petugas'] : ''; ?></p>
                          </div>
                          <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
                          <button type="reset" class="btn btn-warning">Reset</button>  
                        </form>
                      </div>
                      <div class="col-lg-9">
                        <table class="table table-bordered table-hover table-striped tablesorter">
                          <thead>
                            <tr>
                              <th><center>No</th>
                                <th><center>Nama Petugas</th>
                                  <th><center>Status</th>
                                    <th><center>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                    include '../koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi,
                                      "SELECT *,  IF (status='1', 'Aktif', 'Nonaktif') AS status FROM tumbang_petugas;");
                                    while($d = mysqli_fetch_array($data)){
                                      $status = $d['status'];
                                      ?>
                                      <tr>
                                        <td><center><?php echo $no++; ?></td>
                                          <td><left><?php echo $d['nama_petugas']; ?></td>
                                           <td><center>
                                            <?php
                                            if($status='1'){
                                              echo $d['status'];
                                            }else{
                                              echo $d['nama_petugas'];
                                            }
                                            ?>
                                            
                                          </td>
                                          <td>
                                            <div align="center">
                                              <a href="petugas-edit?id=<?php echo $d['id_petugas']; ?>"
                                                <button type="button" class="btn btn-warning">Edit</a>
                                                  <a href="petugas-hapus?id=<?php echo $d['id_petugas']; ?>"
                                                   onclick="javascript: return confirm('Anda yakin hapus?')"
                                                   <button type="button" name="hapus" class="btn btn-danger">Hapus</a><br><br>
                                                   </div>
                                                 </td>
                                               </tr>
                                               <?php 
                                             }
                                             ?>
                                           </tbody>
                                         </table>