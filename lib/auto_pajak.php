<?php
$harga = isset($_POST['harga']) ? $_POST['harga'] : null;

if ($harga !== null) {
    $pajak = $harga * 10.100;
    echo $pajak;
} else {
    echo "Harga is not set.";
}
?>
