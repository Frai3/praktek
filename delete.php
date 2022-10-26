<?php
include 'koneksi.php';

$namaBarang = $_GET["namaBarang"];

$querySelect = "SELECT * FROM barang WHERE namaBarang='$namaBarang'";
$result = mysqli_query($connect, $querySelect);
$row = mysqli_fetch_array($result);

unlink('gambar/'.$row['fotoBarang']);

$queryDelete = "DELETE FROM barang WHERE namaBarang = '$namaBarang'";
$resultDelete = mysqli_query($connect, $queryDelete);
if(!$resultDelete){
    die ("Query gagal dijalankan: ".mysqli_errno($connect).
    " - ".mysqli_error($connect));
}else{
    echo "<script>alert('Data ".$namaBarang." Telah Dihapus');
	window.location='./';
	</script>";
}
?>