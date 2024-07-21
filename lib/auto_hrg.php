<?php
require_once('config.php'); // Ensure you have the connection object

$id_obat = isset($_POST['id_obat']) ? $_POST['id_obat'] : null;

if ($id_obat !== null) {
    $query = "SELECT harga FROM obat WHERE id_obat = '$id_obat'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo $row['harga'];
    } else {
        echo "Error executing query: " . mysqli_error($connection);
    }
} else {
    echo "ID Obat is not set.";
}
?>
