<?php
 
    $connect = mysqli_connect("localhost", "root", "", "toko");

    $namaBarang = $_POST["namaBarang"];
    $hargaBeli = $_POST['hargaBeli'];
    $hargaJual = $_POST['hargaJual'];
    $stok = $_POST['stok'];

    //Gambar 1
    $nama1 = $_FILES['dokumentasisatu']['name'];

    $query = "SELECT * FROM barang WHERE namaBarang='$namaBarang'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);

    if(empty($nama1)){
        $nama1 = $row['fotoBarang'];
    }else{
        unlink('gambar/'.$row['fotoBarang']);
    }

    $x = explode('.', $nama1);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['dokumentasisatu']['size'];
    $file_tmp1 = $_FILES['dokumentasisatu']['tmp_name'];
    $ekstensi_diperbolehkan	= array('jpg', 'png');

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		
		if(!empty($nama1)){
            move_uploaded_file($file_tmp1, 'gambar/'.$nama1);
		}

        $queryUpdate = "UPDATE barang SET hargaBeli = '$hargaBeli', hargaJual = '$hargaJual', stok = '$stok', fotoBarang = '$nama1' WHERE namaBarang = '$namaBarang'";
        $resultEdit = mysqli_query($connect, $queryUpdate);
        if(!$resultEdit){
        die ("Query gagal dijalankan: ".mysqli_errno($connect).
        " - ".mysqli_error($connect));
        }

        echo "<script>alert('Data ".$namaBarang." Telah Dirubah');
		window.location='./';
		</script>";
	}else{
        echo "<script>alert('Ekstensi File yang Diunggah Tidak Diperbolehkan! Unggah File dengan Ekstensi: jpg, png');
		window.location='./';
		</script>";
    }

?>