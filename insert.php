<?php
 
include 'koneksi.php';

$namaBarang = $_POST["namaBarang"];
$hargaBeli = $_POST['hargaBeli'];
$hargaJual = $_POST['hargaJual'];
$stok = $_POST['stok'];

$ekstensi_diperbolehkan	= array('jpg', 'png');

//Gambar 1
$nama1 = $_FILES['dokumentasisatu']['name'];
$x = explode('.', $nama1);
$ekstensi = strtolower(end($x));
$ukuran	= $_FILES['dokumentasisatu']['size'];
$file_tmp1 = $_FILES['dokumentasisatu']['tmp_name'];

if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		
	if(!empty($nama1)){
		move_uploaded_file($file_tmp1, 'gambar/'.$nama1);
	}

    $queryInsert = "INSERT INTO barang VALUES ('$namaBarang', '$hargaBeli', '$hargaJual', '$stok', '$nama1')";
    $resultInput = mysqli_query($connect, $queryInsert);
    if(!$resultInput){
        die ("Query gagal dijalankan: ".mysqli_errno($connect).
        " - ".mysqli_error($connect));
    }

    echo "<script>alert('Data telah ditambahkan');
	window.location='./';
	</script>";
}else{
    echo "<script>alert('Ekstensi File yang Diunggah Tidak Diperbolehkan! Unggah File dengan Ekstensi: jpg, png');
	window.location='./';
	</script>";
}
?>