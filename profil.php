<?php
$id_admin=$_SESSION['id_admin'];
$admin="SELECT * FROM admin WHERE id_admin='$id_admin'";
$edit=mysqli_query($conn,$id_admin) or die(mysqli_error($conn));
$row_edit=mysqli_fetch_assoc($edit);
if ((isset($_POST["aksi"])) && ($_POST["aksi"] == "ubah")) {
	$id=$_SESSION['id_admin'];
	$nama=$_POST['nama'];
	$user=$_POST['username'];
	$pass1=$_POST['password1'];
	$pass2=$_POST['password2'];
		if (($pass1==$pass2) && (!empty($pass1))) {
		    $pass=md5($pass2);
			$qry="UPDATE admin SET nama='$nama', username='$user', password='$pass' WHERE id_admin='$id'";
			$ubah=mysqli_query($conn,$qry) or die(mysqli_error($conn));
			 if ($ubah) {
 				?><script language="javascript"> alert("Data Berhasil Diubah..!!");document.location.href='?page=profil' </script><?php	
				}
		} else {
		  ?><script language="javascript"> alert("Password Tidak sama..");document.location.href='?page=profil' </script><?php
		}
}
?>
<div class="row">
  <div class="col-lg-6">
   <form role="form" method="post">
      <div class="form-group">
      <label>Nama </label>
        <input class="form-control" type="text" name="nama" value="<?php if(isset($row_edit['nama'])){echo $row_edit['nama'];} ?>">
      </div>
      <div class="form-group">
      <label>Username </label>
        <input class="form-control" type="text" name="username" value="<?php if(isset($row_edit['username'])){echo $row_edit['username'];} ?>">
      </div>
      <div class="form-group">
      <label>Password </label>
        <input class="form-control" type="password" name="password1" >
      </div>
      <div class="form-group">
      <label>Ulangi </label>
        <input class="form-control" type="password" name="password2">
      </div>
      <input type="submit" class="btn btn-primary" name="aksi" value="ubah">
      <input type="reset" class="btn btn-default" onclick="self.history.back()" value="batal" />
    </form>
  </div>
  </div>
