<?php

function MySQLConnect()
{
	// Database Connection Info ( MYSQL ) 
	$servername = "localhost";
	$username = "ubuntu";
	$password = "avelinos";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password , 'conveniomysql');

	// Check connection
	if (!$conn) {
		die("SGDB Connection failed: " . mysqli_connect_error());
	}

	return $conn;
}

function MySQLDisconnect( $conn )
{
	if ( !is_null ( $conn ))
		mysqli_close($conn);
}

?>
