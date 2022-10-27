<?php 
if(isset($_POST["namaBarang"]))
{
    include 'koneksi.php';
    
    $namaBarang = $_POST["namaBarang"];

    $query = "SELECT * FROM barang WHERE namaBarang = '$namaBarang'";

    $result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
?>
    <form method="post" action="update.php" enctype="multipart/form-data">
        <label>Nama Barang</label>
        <input type="text" name="namaBarang" id="namaBarang" value="<?php echo $row['namaBarang']; ?>" class="form-control" readonly/>
        <br />
        <label>Harga Beli</label>
        <br />
        <input type="number" name="hargaBeli" id="hargaBeli" value="<?php echo $row['hargaBeli']; ?>" class="form-control"/>
        <br />
        <label>Harga Jual</label>
        <br />
        <input type="number" name="hargaJual" id="hargaJual" value="<?php echo $row['hargaJual']; ?>" class="form-control"/>
        <br />
        <label>Stok</label>
        <br />
        <input type="number" name="stok" id="stok" value="<?php echo $row['stok']; ?>" class="form-control"/>
        <br />
        <label>Foto Barang</label>
        <br />
        <input type="file" class="form-control" id="dokumentasi1" name="dokumentasisatu" value="<?php echo $rot['fotoBarang']; ?>" />
        <br />
        <button type="submit" class="btn btn-secondary" style="width: 150px">Submit</button>
    </form>
<?php
}
?>
