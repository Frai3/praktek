<?php
 
$connect = mysqli_connect("localhost", "root", "", "toko");

    $namaBarang = $_POST["namaBarang"];
    $hargaBeli = $_POST['hargaBeli'];
    $hargaJual = $_POST['hargaJual'];
    $stok = $_POST['stok'];
    // $fotoBarang = strtolower($_POST['fotoBarang']);
    // echo $fotoBarang;

    $ekstensi_diperbolehkan	= array('jpg', 'png');

    //Gambar 1
    $nama1 = $_FILES['dokumentasisatu']['name'];
    $x = explode('.', $nama1);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['dokumentasisatu']['size'];
    $file_tmp1 = $_FILES['dokumentasisatu']['tmp_name'];

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		
		// $structure = 'gambar/'.$namaBarang;
		// mkdir($structure, 0, true);
		
		if(!empty($foto)){
			$foto = $namaBarang;		
			move_uploaded_file($file_tmp1, $structure.'/'.$foto);
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
    
    // $query = "
    // INSERT INTO karyawan(nama, alamat, gender, umur)  
    //  VALUES('$name', '$alamat', '$gender', '$umur')
    // ";
    // if(mysqli_query($connect, $query))
    // {
    //  $output .= '<label class="text-success">Data Berhasil Masuk</label>';
    //  $select_query = "SELECT * FROM karyawan ORDER BY id DESC";
    //  $result = mysqli_query($connect, $select_query);
    //  $output .= '
    //   <table class="table table-bordered">  
    //                 <tr>  
    //                      <th width="55%">Nama Karyawan</th>  
    //                      <th width="15%">Lihat</th>  
    //                      <th width="15%">Edit</th>  
    //                      <th width="15%">Hapus</th>  
    //                 </tr>
    //  ';
    //  while($row = mysqli_fetch_array($result))
    //  {
    //   $output .= '
    //    <tr>  
    //                      <td>' . $row["nama"] . '</td>  
    //                      <td><input type="button" name="view" value="Lihat Detail" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
	// 					 <td><input type="button" name="edit" value="Edit" id="' . $row["id"] . '" class="btn btn-warning btn-xs edit_data" /></td> 		
    //                      <td><input type="button" name="delete" value="Hapus" id="' . $row["id"] . '" class="btn btn-danger btn-xs hapus_data" /></td>
 				 
    //                 </tr>
    //   ';
    //  }
    //  $output .= '</table>';
    // }else{
	// 	$output .= mysqli_error($connect);
	// }
    // echo $output;
?>