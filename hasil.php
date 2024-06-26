<?php 
//lihat prediksi berdasarkan trend
$tahun=$_POST['tahun'];
$x=$_POST['x_next'];
$a=$_POST['a'];
$b=$_POST['b'];
$peramalan=$a+($b*$x);
//lihat data peramalan yang tersimpan
$qry="SELECT * FROM peramalan";
$ramal=mysqli_query($conn,$qry) or die(mysqli_error($conn));
$row_ramal=mysqli_fetch_assoc($ramal);
//simpan data hasil peramalan
if ((isset($_POST["aksi"])) && ($_POST["aksi"] == "simpan")) {
$tahun=$_POST['tahun'];
$peramalan=$_POST['peramalan'];
$qry_simpan="INSERT INTO peramalan VALUES ('','$tahun','$peramalan')";
$simpan=mysqli_query($conn,$qry_simpan) or die(mysqli_error($conn));
?><script language="javascript">document.location.href='?page=hasil' </script> <?php
} else if ((isset($_GET["aksi"])) && ($_GET["aksi"] == "del")) {
$id=$_GET['id'];
$qry_del="DELETE FROM peramalan WHERE id_peramalan='$id'";
$del=mysqli_query($conn,$qry_del) or die(mysqli_error($conn));
?><script language="javascript">document.location.href='?page=hasil' </script> <?php
}

?>
<div class="row">
<div class="col-lg-6">
<h4>Prediksi Tahun <?php echo $tahun; ?></h4>
<table class="table table-bordered table-hover table-striped tablesorter">
    <thead>
    <tr>
    <th>Tahun Y <i class="fa fa-sort"></i></th>
    <th>Prediksi <i class="fa fa-sort"></i></th>
    </tr>
   </thead>
   <tbody>
   <tr>
   <td><strong><?php echo $tahun; ?></strong></td>
   <td><strong><?php echo round($peramalan,2);?></strong></td>
   </tr>
   </tbody>
  </table> 
<form role="form" method="post">
  <div class="form-group">
  <input type="hidden" name="tahun" value="<?php echo $tahun; ?>" />
  <input type="hidden" name="peramalan" value="<?php echo round($peramalan,2); ?>" />
</div>
<input type="submit" class="btn btn-primary" name="aksi" value="simpan">
<input type="reset" class="btn btn-default" onclick="self.history.back()" value="Lagi" />
</form>
</div>
<div class="col-lg-6">
<h4>Data Peramalan Tersimpan</h4>
<table class="table table-bordered table-hover table-striped tablesorter">
    <thead>
    <tr>
    <th>No  <i class="fa fa-sort"></i></th>
    <th>Tahun  <i class="fa fa-sort"></i></th>
    <th>Prediksi <i class="fa fa-sort"></i></th>
    <th>&nbsp;</th>
    </tr>
   </thead>
   <tbody>
   <?php 
   $no=0;
   do { $no++;
   ?>
   <tr>
   <td><?php echo $no; ?></td>
   <td><?php echo $row_ramal['tahun']; ?></td>
   <td><?php echo $row_ramal['peramalan']; ?></td>
   <td><a href="?page=hasil&id=<?php echo $row_ramal['id_peramalan'];?>&aksi=del" onclick="return confirm('Apakah Anda yakin menghapus data ini ?')"><button type="button" class="btn btn-danger">Delete</button>
        </a></td>
   </tr>
   <?php } while($row_ramal=mysqli_fetch_assoc($ramal));?>
   </tbody>
  </table>
  </div>
</div>
</div>