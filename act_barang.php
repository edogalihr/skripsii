<?php
$query="SELECT * FROM supplier";
$supplier=mysqli_query($conn,$qry) or die(mysqli_error($conn));
$row_supplier=mysqli_fetch_assoc($supplier);
if ((isset($_POST["aksi"])) && ($_POST["aksi"] == "tambah")) {
 $tanggal=$_POST['tanggal'];
 $nama_barang=$_POST['nama_barang'];
 $jenis=$_POST['jenis'];
 $hrg=$_POST['harga'];
 $stok=$_POST['stok'];
 $supplier=$_POST['supplier'];
 $qry="INSERT INTO barang VALUES('','$nama_barang','$jenis','$hrg','$stok','$tanggal','$supplier')";
 $tambah=mysqli_query($conn,$qry) or die(mysqli_error($conn)); 
 if ($tambah) {
 	exit("<script>location.href='?page=barang'</script>");
	}
} else if ((isset($_POST["aksi"])) && ($_POST["aksi"] == "edit")) {
  $id_barang=$_POST['id_barang'];
  $tanggal=$_POST['tanggal'];
  $nama_barang=$_POST['nama_barang'];
  $jenis=$_POST['jenis'];
  $hrg=$_POST['harga'];
  $stok=$_POST['stok'];
  $supplier=$_POST['supplier'];
  $qry="UPDATE barang SET nama='$nama_barang', jenis='$jenis', tanggal='$tanggal', harga='$hrg', stok='$stok', id_supplier='$supplier' WHERE id_barang='$id_barang'";
  $ubah=mysqli_query($conn,$qry) or die(mysqli_error($conn));
  if ($ubah) {
 	exit("<script>location.href='?page=barang'</script>");
	}
} else if ((isset($_GET["act"])) && ($_GET["act"] == "edit")) {
  $id_barang=$_GET['id_barang'];
  $qry="SELECT * FROM barang WHERE id_barang='$id_barang'";
  $edit=mysqli_query($conn,$qry) or die(mysqli_error($conn));
  $row_edit=mysqli_fetch_assoc($edit);
  
} else if ((isset($_GET["act"])) && ($_GET["act"] == "del")) {
  $id_barang=$_GET['id_barang'];
  $qry="DELETE FROM barang WHERE id_barang='$id_barang'";
  $del=mysqli_query($conn,$qry) or die(mysqli_error($conn));
  if ($del) {
 	exit("<script>location.href='?page=barang'</script>");
	}
}

?>
<link rel="stylesheet" href="css/flora.datepicker.css">
    <script type="text/javascript" src="js/jquery-1.4.js"></script>
    <script type="text/javascript" src="js/ui.core.js"></script>
    <script type="text/javascript" src="js/ui.datepicker.js"></script>
    <!-- Initiate Date Picker -->
			<script language="javascript">
				$(document).ready(function(){
					$("#picker").datepicker({
					dateFormat:"yy-mm-dd"
						});
				});
			</script>
<div class="row">
<div class="col-lg-6">

<form role="form" method="post">
<div class="form-group">
<label>Tanggal Masuk</label>
<input class="form-control" type="text" name="tanggal" id="picker" value="<?php if(isset($row_edit['tanggal'])){echo $row_edit['tanggal'];} else {echo "0000-00-00";}?>" />
<p class="help-block">Format tanggal yyyy-mm-dd</p>
</div>
<div class="form-group">
<label>Nama barang</label>
  <input class="form-control" type="text" name="nama_barang" value="<?php if(isset($row_edit['nama'])){echo $row_edit['nama'];} ?>">
</div>
<div class="form-group">
<label>Jenis barang</label>
  <input class="form-control" type="text" name="jenis" value="<?php if(isset($row_edit['jenis'])){echo $row_edit['jenis'];} ?>">
</div>
<div class="form-group">
<label>Harga </label>
  <input class="form-control" type="text" name="harga" value="<?php if(isset($row_edit['harga'])){echo $row_edit['harga'];} ?>">
</div>
<div class="form-group">
<label>Stok (Qty)</label>
   <input type="text" class="form-control" name="stok" value="<?php if(isset($row_edit['stok'])){echo $row_edit['stok'];} ?>">
</div>
<div class="form-group">
<label>Nama Supplier</label>
  <select class="form-control" name="supplier">
 <?php do {?>
        <option value="<?php echo $row_supplier['id_supplier']; ?>"><?php echo $row_supplier['nama_supplier']; ?></option>
        <?php } while($row_supplier=mysqli_fetch_assoc($supplier))?>
  </select>
</div>
<div class="form-group">
<label><input type="hidden" name="id_barang" value="<?php if(isset($row_edit['id_barang'])){echo $row_edit['id_barang'];} ?>" /></label>
</div>
<input type="submit" class="btn btn-primary" name="aksi" value="<?php if (isset($_GET['act'])) {echo $_GET['act'];} ?>">
<input type="reset" class="btn btn-default" onclick="self.history.back()" value="batal">
</form>

</div>
</div>