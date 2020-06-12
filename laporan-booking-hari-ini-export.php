<?php include "readme.php";?>
<?php
date_default_timezone_set("Asia/Jakarta");
$tanggalHariIni=date('Y-m-d');
header("Content-type: application/ms-excel");
header("Content-Disposition: attachment; filename=list-permintaan-rekam-medis ".date('d-m-Y').".xls");
?>
<html>
<body>
    <table align="center" border="1">
        <h2 align="center">List Permintaan Rekam Medis</h2>
        <h3 align="center"><?php include 'tanggal-sekarang.php';?></h3>
        <tr>
            <th><center>Cek</th>
                <th><center>No</th>
                    <th><center>No. RM</th>
                        <th><center>Nama Pasien</th>
                    <!--<th><center>Alamat</th>
                    <th><center>Kontak</th>
                    <th><center>Dokter</th>
                        <th><center>Reservasi</th>-->
                            <th><center>Sesi</th>
                                <th><center>Status</th>
                                </tr>
                                <?php
                                include '../koneksi.php';
                                $no = 1;
                                $data = mysqli_query($koneksi,
                                    "SELECT *, dokter.nama_dokter, sesi.nama_sesi,
                                    IF (booking.status='1', 'Datang', 'Belum Datang') AS status
                                    FROM booking, dokter, sesi
                                    WHERE booking.id_dokter=dokter.id_dokter
                                    AND booking.id_sesi=sesi.id_sesi
                                    AND booking.booking_tanggal='$tanggalHariIni'
                                    ORDER BY booking.id_sesi ASC;");
                                while($d = mysqli_fetch_array($data)){
                                    $tanggal = $d['tanggal'];
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><center><?php echo $no++; ?></td>
                                            <td><center><?php echo $d['id_catatan_medik']; ?></td>
                                                <td><center><?php echo $d['nama']; ?></td>
                    <!--<td><center><?php //echo $d['alamat']; ?></td>
                    <td><center><?php //echo $d['kontak']; ?></td>
                    <td><center><?php //echo $d['nama_dokter']; ?></td>
                        <td><center><?php //echo date("d/m/Y", strtotime($tanggal)); ?></td>-->
                            <td><center><?php echo $d['nama_sesi']; ?></td>
                                <td><center><?php echo $d['status']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </body>
                    </html>