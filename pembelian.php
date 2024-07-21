<?php 
$query="SELECT pembelian.no_faktur AS no_faktur, pembelian.tanggal AS tanggal, karyawan.nama AS karyawan, supplier.nama_supplier AS supplier, barang.nama AS barang, pembelian.jumlah_barang AS jumlah, pembelian.harga AS harga, pembelian.pajak AS pajak, pembelian.total_bayar AS total FROM pembelian, karyawan, barang, supplier WHERE pembelian.id_karyawan=karyawan.id_karyawan AND
pembelian.id_supplier=supplier.id_supplier AND pembelian.id_barang=barang.id_barang";
$pemb=mysqli_query($conn,$query) or die(mysqli_error($conn));
$row_pemb=mysqli_fetch_assoc($pemb)
?>
<div class="alert alert-success alert-dismissable">
<a href="?page=act_pembelian&act=tambah"><button type="button" class="btn btn-primary">Tambah Data</button></a>
</div>
<div class="table-responsive">
  <table class="table table-bordered table-hover tablesorter">
    <thead>
      <tr>
        <th>No <i class="fa fa-sort"></i></th>
        <th>No Faktur <i class="fa fa-sort"></i></th>
        <th>Tanggal <i class="fa fa-sort"></i></th>
        <th>Karyawan <i class="fa fa-sort"></i></th>
        <th>Supplier <i class="fa fa-sort"></i></th>
        <th>barang <i class="fa fa-sort"></i></th>
        <th>Qty <i class="fa fa-sort"></i></th>
        <th>Harga <i class="fa fa-sort"></i></th>
        <th>Pajak <i class="fa fa-sort"></i></th>
        <th>Total <i class="fa fa-sort"></i></th>
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
        <td><?php echo $row_pemb['no_faktur']; ?></td>
        <td><?php echo $row_pemb['tanggal']; ?></td>
        <td><?php echo $row_pemb['karyawan']; ?></td>
        <td><?php echo $row_pemb['supplier']; ?></td>
        <td><?php echo $row_pemb['barang']; ?></td>
        <td><?php echo $row_pemb['jumlah']; ?></td>
        <td><?php echo $row_pemb['harga']; ?></td>
        <td><?php echo $row_pemb['pajak']; ?></td>
        <td><?php echo $row_pemb['total']; ?></td>
        <td><a href="?page=act_pembelian&no_faktur=<?php echo $row_pemb['no_faktur'];?>&act=edit">
          <button type="button" class="btn btn-warning">Edit</button>
        </a><a href="?page=act_pembelian&no_faktur=<?php echo $row_pemb['no_faktur'];?>&act=del" onclick="return confirm('Apakah Anda yakin menghapus data ini ?')">
          <button type="button" class="btn btn-danger">Delete</button>
        </a></td>
      </tr>
      <?php } while($row_pemb=mysqli_fetch_assoc($pemb));?>
    </tbody>
  </table>
</div>