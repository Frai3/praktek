<?php  
//index.php
$connect = mysqli_connect("localhost", "root", "", "toko");
$query = "SELECT * FROM barang ORDER BY namaBarang DESC";
$result = mysqli_query($connect, $query);
 ?>  
<!DOCTYPE html>  
<html>  
 <head>  
  <title>Tutorial Popup Input Data Dengan PHP | www.sistemit.com </title>  
  <script src="jquery.min.js"></script>  
  <link rel="stylesheet" href="bootstrap.min.css" />  
  <script src="bootstrap.min.js"></script>  
 </head>  
 <body>  
 
  <div class="container" style="width:700px;">
   <div class="table-responsive">
    <div>
     <button type="button" data-toggle="modal" data-target="#popupInsert" class="btn btn-warning">Tambah Data Karyawan</button>
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
          <input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-warning btn-xs edit_data" />
          ||
          <input type="button" name="delete" value="Hapus" id="<?php echo $row["id"]; ?>" class="btn btn-danger btn-xs hapus_data" />
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
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Input Data Dengan Menggunakan Modal Bootstrap</h4>
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
   </div>
   <!-- <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div> -->
  </div>
 </div>
</div>

<div id="dataModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Detail Data Karyawan</h4>
   </div>
   <div class="modal-body" id="detail_karyawan">
    
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>


<div id="editModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit Data Karyawan</h4>
   </div>
   <div class="modal-body" id="form_edit">
    
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>

<script>  
$(document).ready(function(){

//Begin Tampil Detail Karyawan
 $(document).on('click', '.view_data', function(){
  var employee_id = $(this).attr("id");
  $.ajax({
   url:"select.php",
   method:"POST",
   data:{employee_id:employee_id},
   success:function(data){
    $('#detail_karyawan').html(data);
    $('#dataModal').modal('show');
   }
  });
 });
//End Tampil Detail Karyawan
 
//Begin Tampil Form Edit
  $(document).on('click', '.edit_data', function(){
  var employee_id = $(this).attr("id");
  $.ajax({
   url:"edit.php",
   method:"POST",
   data:{employee_id:employee_id},
   success:function(data){
    $('#form_edit').html(data);
    $('#editModal').modal('show');
   }
  });
 });
//End Tampil Form Edit

//Begin Aksi Delete Data
 $(document).on('click', '.hapus_data', function(){
  var employee_id = $(this).attr("id");
  $.ajax({
   url:"delete.php",
   method:"POST",
   data:{employee_id:employee_id},
   success:function(data){
   $('#employee_table').html(data);  
   }
  });
 });
}); 
//End Aksi Delete Data
 </script>