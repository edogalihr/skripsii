<?php
if ((isset($_POST["aksi"])) && ($_POST["aksi"] == "tambah")) {
 $nama_karyawan=$_POST['nama_karyawan'];
 $gender=$_POST['gender'];
 $alamat=$_POST['alamat'];
 $kota=$_POST['kota'];
 $status=$_POST['status'];
 $telepon=$_POST['telepon'];
 $qry="INSERT INTO karyawan VALUES('','$nama_karyawan','$alamat','$kota','$gender','$status','$telepon')";
 $tambah=mysqli_query($conn,$qry) or die(mysqli_error($conn));
 if ($tambah) {
 	exit("<script>location.href='?page=karyawan'</script>");
	}
} else if ((isset($_POST["aksi"])) && ($_POST["aksi"] == "edit")) {
  $id_karyawan=$_POST['id_karyawan'];
  $nama_karyawan=$_POST['nama_karyawan'];
  $gender=$_POST['gender'];
  $alamat=$_POST['alamat'];
  $kota=$_POST['kota'];
  $status=$_POST['status'];
  $telepon=$_POST['telepon'];
  $qry="UPDATE karyawan SET nama='$nama_karyawan', jenis_kelamin='$gender', alamat='$alamat', kota='$kota', status='$status', telepon='$telepon' WHERE id_karyawan='$id_karyawan'";
  $ubah=mysqli_query($conn,$qry) or die(mysqli_error($conn));
  if ($ubah) {
 	exit("<script>location.href='?page=karyawan'</script>");
	}
} else if ((isset($_GET["act"])) && ($_GET["act"] == "edit")) {
  $id=$_GET['id'];
  $qry="SELECT * FROM karyawan WHERE id_karyawan='$id'";
  $edit=mysqli_query($conn,$qry) or die(mysqli_error($conn));
  $row_edit=mysqli_fetch_assoc($edit);
  
} else if ((isset($_GET["act"])) && ($_GET["act"] == "del")) {
  $id=$_GET['id'];
  $qry="DELETE FROM karyawan WHERE id_karyawan='$id'";
  $del=mysqli_query($conn,$qry) or die(mysqli_error($conn));
  if ($del) {
 	exit("<script>location.href='?page=karyawan'</script>");
	}
}

?>
<div class="row">
  <div class="col-lg-6">
    <form role="form" method="post">
      <div class="form-group">
        <label>Nama Karyawan</label>
        <input class="form-control" type="text" name="nama_karyawan" value="<?php if(isset($row_edit['nama'])){echo $row_edit['nama'];} ?>">
      </div>
      <div class="form-group">
        <label>Jenis Kelamin</label>
        <div class="radio">
          <label>
            <input type="radio" name="gender" id="gender" value="L" <?php if (!(strcmp($row_edit['jenis_kelamin'],"L"))) {echo "CHECKED";} ?>>
            Laki-laki </label>
        </div>
        <div class="radio">
          <label>
          <input type="radio" name="gender" id="gender" value="P" <?php if (!(strcmp($row_edit['jenis_kelamin'],"P"))) {echo "CHECKED";} ?>>
            Perempuan </label>
        </div>
      </div>
      <div class="form-group">
        <label>Alamat </label>
        <textarea class="form-control" rows="3" name="alamat"><?php if(isset($row_edit['alamat'])){echo $row_edit['alamat'];} ?></textarea>
      </div>
      <div class="form-group">
        <label>Kota</label>
        <input type="text" class="form-control" name="kota" value="<?php if(isset($row_edit['kota'])){echo $row_edit['kota'];} ?>">
      </div>
      <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control" id="status">
          <option value="tetap" <?php if (!(strcmp($row_edit['status'],"tetap"))) {echo "selected";} ?>>Tetap</option>
          <option value="tidak" s<?php if (!(strcmp($row_edit['status'],"tidak"))) {echo "selected";} ?>>Tidak Tetap</option>
                </select>
        <div class="radio">
        <label></label>
        </div>
         </div>
      <div class="form-group">
        <label>Telepon</label>
        <input type="text" class="form-control" name="telepon" value="<?php if(isset($row_edit['telepon'])){echo $row_edit['telepon'];} ?>">
      </div>
      <div class="form-group">
        <label>
          <input type="hidden" name="id_karyawan" value="<?php if(isset($row_edit['id_karyawan'])){echo $row_edit['id_karyawan'];} ?>" />
        </label>
      </div>
      <input type="submit" class="btn btn-primary" name="aksi" value="<?php if (isset($_GET['act'])) {echo $_GET['act'];} ?>">
      <input type="reset" class="btn btn-default" onclick="self.history.back()" value="batal">
    </form>
  </div>
</div>
