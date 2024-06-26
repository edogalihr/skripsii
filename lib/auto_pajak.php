<?php
$harga=$_POST['harga'];
$pajak=(10/100)*$harga;

echo round($pajak,2);
?>