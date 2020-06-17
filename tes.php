<?php
include '../koneksi.php';
$booking_tanggal= date('Y-m-d');

$namahari = date('l', strtotime($booking_tanggal));
$data = mysqli_query($koneksi,
	"SELECT kuota_hari FROM dokter WHERE id_dokter='1';");
while($d = mysqli_fetch_array($data)){
	$kuota_hari = $d['kuota_hari'];
}
echo 'Jadwal = '.$namahari.'<br>'.'Kuota = '.$kuota_hari.'<br>';

$a1 = explode (", ",$kuota_hari);
$a2=array("$namahari");
$result=array_intersect($a1,$a2);
 // print_r($result);

if(!$namahari == $result){
	echo "Tidak Sama";
}else{
	echo "Sama";
}
?>
