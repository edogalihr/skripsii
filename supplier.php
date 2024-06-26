<?php
$query="SELECT * FROM supplier";
$supp=mysqli_query($conn,$qry) or die(mysqli_error($conn));
$row_supp=mysqli_fetch_assoc($supp);
$num_supp=mysqli_num_rows($supp);
?>
<div class="alert alert-success alert-dismissable">
<a href="?page=act_supplier&act=tambah">
<button type="button" class="btn btn-primary">Tambah Data</button></a>
</div>
<div class="table-responsive">
<table class="table table-bordered table-hover tablesorter">
    <thead>
      <tr>
        <th>No <i class="fa fa-sort"></i></th>
        <th>Nama Supplier<i class="fa fa-sort"></i></th>
        <th>Alamat <i class="fa fa-sort"></i></th>
        <th>Kota<i class="fa fa-sort"></i></th>
        <th>Telepon<i class="fa fa-sort"></i></th>
        <th>Aksi <i class="fa fa-sort"></i></th>
      </tr>
    </thead>
    <tbody>
    <?php 
  $no=0;
   do { $no++;
  ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $row_supp['nama_supplier']; ?></td>
        <td><?php echo $row_supp['alamat']; ?></td>
        <td><?php echo $row_supp['kota']; ?></td>
        <td><?php echo $row_supp['telepon']; ?></td>
        <td><a href="?page=act_supplier&id=<?php echo $row_supp['id_supplier'];?>&act=edit">
          <button type="button" class="btn btn-warning">Edit</button>
        </a><a href="?page=act_supplier&id=<?php echo $row_supp['id_supplier'];?>&act=del" onclick="return confirm('Apakah Anda yakin menghapus data ini ?')">
          <button type="button" class="btn btn-danger">Delete</button>
        </a></td>
      </tr>
      <?php } while($row_supp=mysqli_fetch_assoc($supp));?>
    </tbody>
  </table>
</div>
