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

if(empty($namaBarang) || empty($hargaBeli) || empty($hargaJual) || empty($stok) || empty($nama1)){
    echo "<script>alert('Harap Masukkan Data dengan Lengkap!');
        window.location='./';
        </script>";
}else{
    cekData($namaBarang);

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
    
        echo "<script>alert('Data ".$namaBarang." Telah Ditambahkan');
        window.location='./';
        </script>";
    }else{
        echo "<script>alert('Ekstensi File yang Diunggah Tidak Diperbolehkan! Unggah File dengan Ekstensi: jpg, png');
        window.location='./';
        </script>";
    }
}

function cekData($namaBarang){
    include 'koneksi.php';

    $querySelect = "SELECT * FROM barang WHERE namaBarang='$namaBarang'";
    $result = mysqli_query($connect, $querySelect);
    $row = mysqli_fetch_array($result);

    if($row > 0){
        echo "<script>alert('Data ".$namaBarang." Sudah Ada');
        window.location='./';
        </script>";
    }
}

?>