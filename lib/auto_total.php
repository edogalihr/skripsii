<?php
$qty = isset($_POST['qty']) ? $_POST['qty'] : null;
$harga = isset($_POST['harga']) ? $_POST['harga'] : null;
$pajak = isset($_POST['pajak']) ? $_POST['pajak'] : null;

if ($qty !== null && $harga !== null && $pajak !== null) {
    // Continue processing $qty, $harga, and $pajak
    $total = ($qty * $harga) + $pajak;
    echo "Total: $total";
} else {
    // Handle the case where one or more keys are not set
    echo "One or more required fields are not set.";
}
?>