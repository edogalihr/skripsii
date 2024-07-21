<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spk_least_square_master";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>