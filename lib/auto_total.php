<?php
$qty=$_POST['qty'];
$hrg=$_POST['harga'];
$pajak=$_POST['pajak'];
$total=($qty*$hrg)+$pajak;

echo round($total,2);
?>