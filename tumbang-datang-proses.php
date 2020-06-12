<?php include "readme.php";?>
<?php 
include '../koneksi.php';
$id_tumbang = $_GET['id_tumbang'];
mysqli_query($koneksi,"UPDATE tumbang SET status = '1' WHERE id_tumbang='$id_tumbang'");
header("location:dashboard");
?>