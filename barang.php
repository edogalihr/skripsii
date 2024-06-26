<?php
$query="SELECT barang.id_barang AS id, barang.nama AS nama, barang.jenis AS jenis, barang.tanggal AS tanggal, barang.harga AS harga, barang.stok AS stok, supplier.nama_supplier AS supplier  FROM barang, supplier WHERE barang.id_supplier=supplier.id_supplier";
$barang=mysqli_query($conn,$qry) or die(mysqli_error($conn));
$row_barang=mysqli_fetch_assoc($barang);
$num_barang=mysqli_num_rows($barang);
?>
<div class="alert alert-success alert-dismissable">
<a href="?page=act_barang&act=tambah"><button type="button" class="btn btn-primary">Tambah Data</button></a>
</div>
<div class="table-responsive">
  <table class="table table-bordered table-hover tablesorter">
    <thead>
      <tr>
        <th>No <i class="fa fa-sort"></i></th>
        <th>Nama barang <i class="fa fa-sort"></i></th>
        <th>Jenis barang <i class="fa fa-sort"></i></th>
        <th>Tgl Masuk<i class="fa fa-sort"></i></th>
        <th>Harga <i class="fa fa-sort"></i></th>
        <th>Qty <i class="fa fa-sort"></i></th>
        <th>Supplier <i class="fa fa-sort"></i></th>
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
        <td><?php echo $row_barang['nama']; ?></td>
        <td><?php echo $row_barang['jenis']; ?></td>
        <td><?php echo $row_barang['tanggal']; ?></td>
        <td><?php echo $row_barang['harga']; ?></td>
        <td><?php echo $row_barang['stok']; ?></td>
        <td><?php echo $row_barang['supplier']; ?></td>
        <td><a href="?page=act_barang&id_barang=<?php echo $row_barang['id'];?>&act=edit">
          <button type="button" class="btn btn-warning">Edit</button>
        </a><a href="?page=act_barang&id_barang=<?php echo $row_barang['id'];?>&act=del" onclick="return confirm('Apakah Anda yakin menghapus data ini ?')">
          <button type="button" class="btn btn-danger">Delete</button>
        </a></td>
      </tr>
      <?php } while($row_barang=mysqli_fetch_assoc($barang));?>
    </tbody>
  </table>
</div>
