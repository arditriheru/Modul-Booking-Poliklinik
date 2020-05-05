<?php include "readme.php";?>
<?php
    $id_dokter  = $_POST['id_dokter'];
    $awal       = $_POST['awal'];
    $akhir      = $_POST['akhir'];
    $id_sesi    = $_POST['id_sesi'];
    header("Content-type: application/ms-excel");
    header("Content-Disposition: attachment; filename=laporan-booking-per-dokter ".date('d-m-Y').".xls");
?>
<html>
    <body>
    <table align="center" border="1">
        <h2 align="center">Laporan Per Dokter</h2>
        <h3 align="center">Tanggal : <?php echo $awal ?> - <?php echo $akhir ?></h3>
        <tr>
                    <th><center>Cek</th>
                    <th><center>No</th>
                    <th><center>No.RM</th>
                    <th><center>Nama</th>
                    <th><center>Alamat</th>
                    <th><center>Kontak</th>
                    <th><center>Dokter</th>
                    <th><center>Booking</th>
                    <th><center>Sesi</th>
                    <th><center>Status</th>
                   </tr>
        <?php 
            include '../koneksi.php';
            $no = 1;
            date_default_timezone_set("Asia/Jakarta");
            $tanggalHariIni=date('Y-m-d');
            $data = mysqli_query($koneksi,
            "SELECT *, dokter.nama_dokter, sesi.nama_sesi,
                      IF (booking.status='1', 'Datang', 'Belum Datang') AS status
                      FROM booking, dokter, sesi
                      WHERE booking.id_dokter=dokter.id_dokter
                      AND booking.id_sesi=sesi.id_sesi
                      AND booking.booking_tanggal BETWEEN '$awal' AND '$akhir'
                      AND booking.id_sesi = '$id_sesi'
                      AND booking.id_dokter='$id_dokter' ORDER BY booking.id_booking ASC;");
            while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
                    <td></td>
                    <td><center><?php echo $no++; ?></td>
                    <td><center><?php echo $d['id_catatan_medik']; ?></td>
                    <td><center><?php echo $d['nama']; ?></td>
                    <td><center><?php echo $d['alamat']; ?></td>
                    <td><center><?php echo $d['kontak']; ?></td>
                    <td><center><?php echo $d['nama_dokter']; ?></td>
                    <td><center><?php echo $d['booking_tanggal']; ?></td>
                    <td><center><?php echo $d['nama_sesi']; ?></td>
                    <td><center><?php echo $d['status']; ?></td>
                  </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>