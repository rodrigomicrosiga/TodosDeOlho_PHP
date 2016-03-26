<?php
$servername = "localhost";
$username = "ubuntu";
$password = "avelinos";

// Create connection
$conn = mysqli_connect($servername, $username, $password , 'conveniomysql');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";


?>

