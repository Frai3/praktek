<?php  
include 'koneksi.php';

$query = "SELECT * FROM barang ORDER BY namaBarang DESC";
$result = mysqli_query($connect, $query);
 ?>  
<!DOCTYPE html>  
<html>  
 <head>  
  <title>Praktek PHP Programming || Nutech Integrasi</title>  
  <script src="jquery.min.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css" />  
  <script src="bootstrap.min.js"></script>  
 </head>  
 <body>  
 
  <div class="container" style="width:700px;">
   <div class="table-responsive">
    <div>
     <button type="button" data-toggle="modal" data-target="#popupInsert" class="btn btn-warning">Tambah Barang</button>
    </div>
    <br />
    <div id="employee_table">
     <table class="table table-bordered">
      <tr>
       <th width="20%">Nama Barang</th>  
       <th width="15%">Harga Jual</th>
       <th width="15%">Harga Beli</th>
       <th width="15%">Foto</th>
       <th width="10%">Stok</th>
       <th width="25%">Keterangan</th>
      </tr>
      <?php
      while($row = mysqli_fetch_array($result))
      {
      ?>
      <tr>
        <td><?php echo $row["namaBarang"]; ?></td>
        <td><?php echo $row["hargaBeli"]; ?></td>
	      <td><?php echo $row["hargaJual"]; ?></td>
        <td><img class="card-img-top" src="gambar/<?php echo $row["fotoBarang"]; ?>" alt="Card image cap" width="150"        ></td>
	      <td><?php echo $row["stok"]; ?></td>
        <td>
          <input type="button" name="edit" value="Edit" id="<?php echo $row["namaBarang"]; ?>" class="btn btn-warning btn-xs formEdit" />
          ||
          <a href="delete.php?namaBarang=<?php echo $row['namaBarang'] ?>" type="button" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Data <?php echo $row['namaBarang']; ?>?')">Hapus</a>
        </td>
      </tr>
      <?php
      }
      ?>
     </table>
    </div>
   </div>
  </div>
 </body>  
</html>  

<!-- Form Popup -->
<div id="popupInsert" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Input Data Barang</h4>
   </div>
   <div class="modal-body">
    <form method="post" action="insert.php" enctype="multipart/form-data">
     <label>Nama Barang</label>
     <input type="text" name="namaBarang" id="namaBarang" class="form-control" />
     <br />
     <label>Harga Beli</label>
     <input type="number" name="hargaBeli" id="hargaBeli" class="form-control" />
     <br />
     <label>Harga Jual</label>
     <input type="number" name="hargaJual" id="hargaJual" class="form-control" />
     <br />  
     <label>Stok</label>
     <input type="number" name="stok" id="stok" class="form-control" />
     <br />  
     <label>Foto Barang</label>
     <input type="file" class="form-control" id="dokumentasi1" name="dokumentasisatu">
     <br />
     <button type="submit" class="btn btn-secondary" style="width: 150px">Submit</button>
    </form>
    <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
   </div>
  </div>
 </div>
</div>


<div id="editModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit Data Barang</h4>
   </div>
   <div class="modal-body" id="edit">
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>

<script>  
$(document).ready(function(){
$(document).on('click', '.formEdit', function(){
  var namaBarang = $(this).attr("id");
  $.ajax({
   url:"edit.php",
   method:"POST",
   data:{namaBarang:namaBarang},
   success:function(data){
    $('#edit').html(data);
    $('#editModal').modal('show');
   }
  });
 });
});
 </script>