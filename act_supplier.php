<?php
require_once 'config.php';


if ((isset($_POST["aksi"])) && ($_POST["aksi"] == "tambah")) {
 $nama_supplier=$_POST['nama_supplier'];
 $alamat=$_POST['alamat'];
 $kota=$_POST['kota'];
 $telepon=$_POST['telepon'];
 $qry="INSERT INTO supplier VALUES('','$nama_supplier','$alamat','$kota','$telepon')";
 $tambah=mysqli_query($conn,$qry) or die(mysqli_error($conn));
 if ($tambah) {
 	exit("<script>location.href='?page=supplier'</script>");
	}
} else if ((isset($_POST["aksi"])) && ($_POST["aksi"] == "edit")) {
  $id_supplier=$_POST['id_supplier'];
  $nama_supplier=$_POST['nama_supplier'];
  $alamat=$_POST['alamat'];
  $kota=$_POST['kota'];
  $telepon=$_POST['telepon'];
  $qry="UPDATE supplier SET nama_supplier='$nama_supplier', alamat='$alamat', kota='$kota', telepon='$telepon' WHERE id_supplier='$id_supplier'";
  $ubah=mysqli_query($conn,$qry) or die(mysqli_error($conn));
  if ($ubah) {
 	exit("<script>location.href='?page=supplier'</script>");
	}
} else if ((isset($_GET["act"])) && ($_GET["act"] == "edit")) {
  $id=$_GET['id'];
  $qry="SELECT * FROM supplier WHERE id_supplier='$id'";
  $edit=mysqli_query($conn,$qry) or die(mysqli_error($conn));
  $row_edit=mysqli_fetch_assoc($edit);
  
} else if ((isset($_GET["act"])) && ($_GET["act"] == "del")) {
  $id=$_GET['id'];
  $qry="DELETE FROM supplier WHERE id_supplier='$id'";
  $del=mysqli_query($conn,$qry) or die(mysqli_error($conn));
  if ($del) {
 	exit("<script>location.href='?page=supplier'</script>");
	}
}

?>
<div class="row">
<div class="col-lg-6">

<form role="form" method="post">
<div class="form-group">
<label>Nama Supplier</label>
  <input class="form-control" type="text" name="nama_supplier" value="<?php if(isset($row_edit['nama_supplier'])){echo $row_edit['nama_supplier'];} ?>">
</div>
<div class="form-group">
<label>Alamat</label>
<input class="form-control" type="text" name="alamat" value="<?php if(isset($row_edit['alamat'])){echo $row_edit['alamat'];} ?>">
</div>
<div class="form-group">
<label>Kota </label>
  <input class="form-control" type="text" name="kota" value="<?php if(isset($row_edit['kota'])){echo $row_edit['kota'];} ?>">
</div>
<div class="form-group">
<label>Telepon</label>
   <input type="text" class="form-control" name="telepon" value="<?php if(isset($row_edit['telepon'])){echo $row_edit['telepon'];} ?>">
</div>
<div class="form-group">
<label><input type="hidden" name="id_supplier" value="<?php if(isset($row_edit['id_supplier'])){echo $row_edit['id_supplier'];} ?>" /></label>
</div>
<input type="submit" class="btn btn-primary" name="aksi" value="<?php if (isset($_GET['act'])) {echo $_GET['act'];} ?>">
<input type="reset" class="btn btn-default" onclick="self.history.back()" value="batal">
</form>

</div>
</div>