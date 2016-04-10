<?php 

// Grava um log de acesso ao site 

require_once('dbconn.php'); 

$conn = MySQLConnect();

$stmt = mysqli_prepare($conn, "INSERT INTO LOGSITE(ACESSO,SESSION,CLIENTIP," . 
	"HOST,URL,USERAGENT,LANGUAGE,QUERYSITE) VALUES (NOW(),?,?,?,?,?,?,?)");

if ( $stmt === false )
        die('MySQL Error: ' . mysqli_error($conn));

$cSESSION  	= session_id();
$cCLIENTIP	= $_SERVER['REMOTE_ADDR'];
$cHOST          = $_SERVER['HTTP_HOST'];
$cURL 		= $_SERVER['REQUEST_URI'];
$cUSERAGENT 	= $_SERVER['HTTP_USER_AGENT'];
$cLANGUAGE  	= $_SERVER['HTTP_ACCEPT_LANGUAGE'];
$cQUERYSITE     = $_SERVER['QUERY_STRING'];

mysqli_stmt_bind_param($stmt,'sssssss',$cSESSION,$cCLIENTIP,$cHOST,$cURL,$cUSERAGENT,$cLANGUAGE,$cQUERYSITE);

mysqli_stmt_execute( $stmt );

mysqli_stmt_close($stmt);

MySQLDisconnect( $conn );

?>
