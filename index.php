<?php  
include 'koneksi.php';
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
    <div class="row">
      <div class="table-responsive">
        <div class="col">
          <button type="button" data-toggle="modal" data-target="#popupInsert" class="btn btn-warning ">Tambah Barang</button>
        </div>
        <div class="col">
        </div>
        <div class="col">
          <form action="index.php" method="get">
            <label>Nama Barang :</label>
            <input type="text" name="cari">
            <input type="submit" value="Cari">
          </form>
      </div>
    </div>
    <br />
    <table class="table table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Nama Barang</th>
					<th>Harga Beli</th>
					<th>Harga Jual</th>
					<th>Stok</th>
					<th>Foto</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
        if(isset($_GET['cari'])){
          $cari = $_GET['cari'];
          if(!empty($cari)){
            $querySelect = "SELECT * FROM barang WHERE namaBarang='$cari'";
            $result = mysqli_query($connect, $querySelect);
            $row = mysqli_fetch_array($result);
            ?>
            <tr>
              <td><?php echo $row['namaBarang']; ?></td>
              <td><?php echo $row['hargaBeli']; ?></td>
              <td><?php echo $row['hargaJual']; ?></td>
              <td><?php echo $row['stok']; ?></td>
              <td><img class="card-img-top" src="gambar/<?php echo $row["fotoBarang"]; ?>" alt="Image Not Found" width="150"></td>
              <td>
                <input type="button" name="edit" value="Edit" id="<?php echo $row["namaBarang"]; ?>" class="btn btn-warning btn-xs formEdit" />
                ||
                <a href="delete.php?namaBarang=<?php echo $row['namaBarang'] ?>" type="button" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Data <?php echo $row['namaBarang']; ?>?')">Hapus</a>
              </td>
            </tr>
            <?php
          }else{
            read();
          }
        }else{
          read();
        }
      ?>
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

<?php

function read(){
  
  include 'koneksi.php';

  $max = 5;

  $page = isset($_GET['page'])?(int)$_GET['page'] : 1;
  $first = ($page>1) ? ($page * $max) - $max : 0;

  $previous = $page - 1;
  $next = $page + 1;
  
  $querySelect = "SELECT * FROM barang";
  $result = mysqli_query($connect, $querySelect);
  $jmlhRow = mysqli_num_rows($result);

  $maxPage = ceil($jmlhRow / $max);

  $query = mysqli_query($connect,"SELECT * FROM barang LIMIT $first, $max");
  
  $no = $first+1;
  
  while($row = mysqli_fetch_array($query)){
    ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <td><?php echo $row['namaBarang']; ?></td>
      <td><?php echo $row['hargaBeli']; ?></td>
      <td><?php echo $row['hargaJual']; ?></td>
      <td><?php echo $row['stok']; ?></td>
      <td><img class="card-img-top" src="gambar/<?php echo $row["fotoBarang"]; ?>" alt="Card image cap" width="150"></td>
      <td>
        <input type="button" name="edit" value="Edit" id="<?php echo $row["namaBarang"]; ?>" class="btn btn-warning btn-xs formEdit" />
        ||
        <a href="delete.php?namaBarang=<?php echo $row['namaBarang'] ?>" type="button" class="btn btn-danger btn-xs" onclick="return confirm('Hapus Data <?php echo $row['namaBarang']; ?>?')">Hapus</a>
      </td>
    </tr>
    <?php
  }
  ?>
</tbody>
</table>
<nav>
<ul class="pagination justify-content-center">
  <li class="page-item">
    <a class="page-link" <?php if($page > 1){ echo "href='?page=$previous'"; } ?>>Previous</a>
  </li>
  <?php 
  for($i=1;$i<=$maxPage;$i++){
    ?> 
    <li class="page-item"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i; ?></a></li>
    <?php
  }
  ?>				
  <li class="page-item">
    <a  class="page-link" <?php if($page < $maxPage) { echo "href='?page=$next'"; } ?>>Next</a>
  </li>
</ul>
</nav>
<?php
  }
?>