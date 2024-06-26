<?php
# FileName="Connection_php_mysqli.htm"
# Type="mysqli"
# HTTP="true"
$hostname_least_square = "localhost";
$database_least_square = "least_square";
$username_least_square = "root";
$password_least_square = "123456";
$least_square = mysqli_pconnect($hostname_least_square, $username_least_square, $password_least_square) or trigger_error(mysqli_error(),E_USER_ERROR); 
mysqli_select_db("least_square");
//home URL
$url = "http://localhost/least_square/";
?>