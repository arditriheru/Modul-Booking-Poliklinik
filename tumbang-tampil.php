        <h3 align="center">Tumbuh Kembang</h3><br>
          <div class="col-lg-8">
            <form method="post" action="laporan-tumbang-hari-ini-export" role="form">
              <button type="submit" class="btn btn-success">EXPORT</button>
              <div class="btn-group">
                  <button type="button" class="btn btn-primary">Per Petugas</button>
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li disabled selected><a>All</a></li>
                    <?php 
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,
                      "SELECT *, tumbang_petugas.nama_petugas
                      FROM tumbang, tumbang_petugas
                      WHERE tumbang.id_petugas=tumbang_petugas.id_petugas
                      AND tumbang.jadwal='$tanggalHariIni'
                      GROUP BY tumbang.id_petugas;");
                    while($d = mysqli_fetch_array($data)){
                    echo "<li><a href='tumbang-tab?id_petugas=".$d['id_petugas']."'>".$d['nama_petugas']."</a></li>";
                    }
                  ?>
                  </ul>
                </div><!-- /btn-group -->
            </form>
          </div>
          <div align="right" class="col-lg-4">
              <?php 
                    include '../koneksi.php';
                    $data = mysqli_query($koneksi,
                      "SELECT COUNT(id_tumbang) AS total
                      FROM tumbang
                      WHERE tumbang.jadwal='$tanggalHariIni';");
                    while($d = mysqli_fetch_array($data)){
                  ?>
              <h1><small>Total <?php echo $d['total']; }?> Pasien</small></h1>
            </div>
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr>
                    <th><center>No</th>
                    <th><center>No. RM</th>
                    <th><center>Nama Pasien</th>
                    <th><center>Petugas</th>
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
                    $data = mysqli_query($koneksi,
                      "SELECT *, tumbang_petugas.nama_petugas,
                      IF (tumbang.status='1', 'Datang', 'Belum Datang') AS status
                      FROM tumbang, tumbang_petugas
                      WHERE tumbang.id_petugas=tumbang_petugas.id_petugas
                      AND tumbang.jadwal='$tanggalHariIni'
                      ORDER BY tumbang.nama ASC;");
                    while($d = mysqli_fetch_array($data)){
                  ?>
                  <tr>
                  	<td><center><?php echo $no++; ?></td>
                    <td><center><?php echo $d['id_catatan_medik']; ?></td>
                    <td><center><?php echo $d['nama']; ?></td>
                    <td><center><?php echo $d['nama_petugas']; ?></td>
                    <td><center><?php echo $d['sesi']; ?></td>
                    <td><center><?php echo $d['status']; ?></td>
                    <td><center><?php echo $d['keterangan']; ?></td>
                    <td>
                      <div align="center">
                        <a href="tumbang-datang-proses?id_tumbang=<?php echo $d['id_tumbang']; ?>"
                           onclick="javascript: return confirm('Sudah Datang?')"
                        <button type="button" class="btn btn-success">Datang</a><br><br>
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