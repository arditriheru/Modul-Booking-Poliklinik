<?php include "readme.php";?>
<?php
	session_start();
	include '../koneksi.php';
		date_default_timezone_set("Asia/Jakarta");
		$_SESSION['tanggal'] = date('Y-m-d');
		$id_jadwal = $_GET['id_jadwal'];
		$hapus=mysqli_query($koneksi,"DELETE FROM jadwal WHERE id_jadwal='$id_jadwal'");
		if($hapus){
			echo "<script>alert('Berhasil Dihapus!!!');document.location='jadwal-dokter'</script>";
		    }else{
		    echo "<script>alert('Gagal Hapus!!!');document.location='jadwal-edit?id_jadwal=$id_jadwal'</script>";
		    }
?>
