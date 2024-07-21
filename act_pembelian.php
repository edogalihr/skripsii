<?php 
$query1="SELECT * FROM barang";
$barang=mysqli_query($conn,$query) or die(mysqli_error($conn));
$row_barang=mysqli_fetch_assoc($barang);
$query2="SELECT * FROM supplier";
$supplier=mysqli_query($conn,$query) or die(mysqli_error($conn));
$row_supplier=mysqli_fetch_assoc($supplier);
$query3="SELECT * FROM karyawan";
$karyawan=mysqli_query($conn,$query) or die(mysqli_error($conn));
$row_karyawan=mysqli_fetch_assoc($karyawan);
if ((isset($_POST["aksi"])) && ($_POST["aksi"] == "tambah")) {
	$faktur=$_POST['no_faktur'];
	$tgl=$_POST['tanggal'];
	$karyawan=$_POST['karyawan'];
	$supplier=$_POST['supplier'];
	$barang=$_POST['barang'];
	$jumlah=$_POST['jumlah'];
	$harga=$_POST['harga'];
	$pajak=$_POST['pajak'];
	$total=$_POST['total'];
	$query="INSERT INTO pembelian VALUES ('$faktur','$tgl','$karyawan','$supplier','$barang','$jumlah','$harga','$pajak','$total')";
	$tambah=mysqli_query($conn,$query) or die(mysqli_error($conn));
	if ($tambah) {
 	exit("<script>location.href='?page=pembelian'</script>");
	}
} else if ((isset($_POST["aksi"])) && ($_POST["aksi"] == "edit")) {
	$faktur=$_POST['no_faktur'];
	$tgl=$_POST['tanggal'];
	$karyawan=$_POST['karyawan'];
	$supplier=$_POST['supplier'];
	$barang=$_POST['barang'];
	$jumlah=$_POST['jumlah'];
	$harga=$_POST['harga'];
	$pajak=$_POST['pajak'];
	$total=$_POST['total'];
	$query="UPDATE INTO pembelian SET tanggal='$tgl', id_karyawan='$karyawan', id_supplier='$supplier', id_barang='$barang', jumlah='$jumlah', harga='$harga', pajak='$pajak', total='$total' WHERE no_faktur='$faktur'";
	$update=mysqli_query($conn,$query) or die(mysqli_error($conn));
	if ($update) {
 	exit("<script>location.href='?page=pembelian'</script>");
	}
} else if ((isset($_GET["act"])) && ($_GET["act"] == "edit")) {
	$faktur=$_GET['no_faktur'];
	$query="SELECT * FROM pembelian WHERE no_faktur='$faktur'";
	$edit=mysqli_query($conn,$query) or die(mysqli_error($conn));
	$row_edit=mysqli_fetch_assoc($edit);
} else if ((isset($_GET["act"])) && ($_GET["act"] == "del")) {
	$faktur=$_GET['no_faktur'];
	$query="DELETE FROM pembelian WHERE no_faktur='$faktur'";
	$del=mysqli_query($conn,$query) or die(mysqli_error($conn));
	if ($del) {
 	exit("<script>location.href='?page=pembelian'</script>");
	}
}

?>
<div class="row">
<div class="col-lg-6">

<form role="form" method="post">
<div class="form-group">
<label>No Faktur</label>
  <input class="form-control" type="text" name="no_faktur" value="<?php if(isset($row_edit['no_faktur'])){echo $row_edit['no_faktur']; echo "readonly=readonly";} ?>" placeholder="FAK-0000">
</div>
<div class="form-group">
<label>Tanggal Pembelian</label>
<input class="form-control" type="text" name="tanggal" id="picker" value="<?php if(isset($row_edit['tanggal'])){echo $row_edit['tanggal'];} else {echo "0000-00-00";}?>" />
<p class="help-block">Format tanggal yyyy-mm-dd</p>
</div>
<div class="form-group">
<label>Nama Karyawan</label>
  <select class="form-control" name="karyawan">
 <?php do {?>
        <option value="<?php echo $row_karyawan['id_karyawan']; ?>"><?php echo $row_karyawan['nama']; ?></option>
        <?php } while($row_karyawan=mysqli_fetch_assoc($karyawan))?>
  </select>
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
<label>Nama barang</label>
  <select class="form-control" name="barang" id="barang">
 <?php do {?>
        <option value="<?php echo $row_barang['id_barang']; ?>"><?php echo $row_barang['nama']; ?></option>
        <?php } while($row_barang=mysqli_fetch_assoc($barang))?>
  </select>
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label>Qty</label>
  <input class="form-control" type="text" name="jumlah" id="qty" value="<?php if(isset($row_edit['jumlah_barang'])){echo $row_edit['jumlah_barang'];} ?>">
</div>
<div class="form-group">
<label>Harga </label>
  <input class="form-control" type="text" name="harga" id="harga" readonly="readonly" value="<?php if(isset($row_edit['harga'])){echo $row_edit['harga'];} ?>">
</div>
<div class="form-group">
<label>Pajak</label>
<input type="text" class="form-control" name="pajak" id="pajak" readonly="readonly" value="<?php if(isset($row_edit['pajak'])){echo $row_edit['pajak'];} ?>">
</div>
<div class="form-group">
<label>Total Bayar</label>
   <input type="text" class="form-control" name="total" id="total" readonly="readonly" value="<?php if(isset($row_edit['total_bayar'])){echo $row_edit['total_bayar'];} ?>">
</div>
<input type="submit" class="btn btn-primary" name="aksi" value="<?php if (isset($_GET['act'])) {echo $_GET['act'];} ?>">
<input type="reset" class="btn btn-default" onclick="self.history.back()" value="batal">
</form>
</div>
</div>

