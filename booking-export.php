<?php include "readme.php";?>
<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Booking ".date('dmY').".xls");
?>
<?php 
include "koneksi.php";
$awal = $_POST['awal'];
$akhir = $_POST['akhir'];
?>
<?php include "views/header.php"; ?>
<body>
	<table align="center" border="1">
		<h2 align="center">Rekap Data Booking</h2>
		<h3 align="center">Tanggal : <?php echo $awal ?> - <?php echo $akhir ?></h3>
		<tr>
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
            "SELECT *, IF (status='1', 'Datang', 'Belum Datang') AS status FROM booking
            WHERE booking_tanggal BETWEEN '$awal' AND '$akhir';");
            while($d = mysqli_fetch_array($data)){
        ?>
		<tr>
                    <td><center><?php echo $no++; ?></td>
                    <td><center><?php echo $d['id_catatan_medik']; ?></td>
                    <td><center><?php echo $d['nama']; ?></td>
                    <td><center><?php echo $d['alamat']; ?></td>
                    <td><center><?php echo $d['kontak']; ?></td>
                    <td><center><?php echo $d['dokter']; ?></td>
                    <td><center><?php echo $d['booking_tanggal']; ?></td>
                    <td><center><?php echo $d['sesi']; ?></td>
                    <td><center><?php echo $d['status']; ?></td>
                  </tr>
		<?php
		}
		?>
	</table>
</body>
<?php include "views/footer.php"; ?>