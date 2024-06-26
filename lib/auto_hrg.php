<?php 
require_once('config.php');
$id_obat=$_POST['id_obat'];
$sql=mysqli_query("SELECT harga FROM obat WHERE id_obat='$id_obat'");
$row_data=mysqli_fetch_assoc($sql);
$harga=$row_data['harga'];

echo $harga;
?>