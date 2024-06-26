<?php
$query="SELECT * FROM karyawan";
$karyawan=mysqli_query($conn,$qry) or die(mysqli_error($conn));
$row_karyawan=mysqli_fetch_assoc($karyawan);
?>
<div class="alert alert-success alert-dismissable">
<a href="?page=act_karyawan&act=tambah"><button type="button" class="btn btn-primary">Tambah Data</button></a>
</div>
<div class="table-responsive">
  <table class="table table-bordered table-hover tablesorter">
    <thead>
      <tr>
        <th>No <i class="fa fa-sort"></i></th>
        <th>Nama  <i class="fa fa-sort"></i></th>
        <th>Jenis Kelamin <i class="fa fa-sort"></i></th>
        <th>Alamat<i class="fa fa-sort"></i></th>
        <th>Kota<i class="fa fa-sort"></i></th>
        <th>Status<i class="fa fa-sort"></i></th>
        <th>Telepon</th>
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
        <td><?php echo $row_karyawan['nama']; ?></td>
        <td><?php if ($row_karyawan['jenis_kelamin']=='L') {echo "Laki-laki";} else {echo "Perempuan";} ?></td>
        <td><?php echo $row_karyawan['alamat']; ?></td>
        <td><?php echo $row_karyawan['kota']; ?></td>
        <td><?php if ($row_karyawan['status']=='tidak') {echo "Pegawai Tidak Tetap";} else {echo "Pegawai Tetap";} ?></td>
        <td><?php echo $row_karyawan['telepon']; ?></td>
        <td><a href="?page=act_karyawan&id=<?php echo $row_karyawan['id_karyawan'];?>&act=edit">
          <button type="button" class="btn btn-warning">Edit</button>
        </a><a href="?page=act_karyawan&id=<?php echo $row_karyawan['id_karyawan'];?>&act=del" onclick="return confirm('Apakah Anda yakin menghapus data ini ?')">
          <button type="button" class="btn btn-danger">Delete</button>
        </a></td>
      </tr>
      <?php } while($row_karyawan=mysqli_fetch_assoc($karyawan));?>
    </tbody>
  </table>
</div>