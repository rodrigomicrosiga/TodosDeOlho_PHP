﻿<?php

require_once("dbconn.php");

function DTOS( $sDate )
{
	$sDate = trim($sDate);
	if( strlen($sDate) == 0 )
		return null;
	$myDate = explode("/",$sDate,3);
	return sprintf("%d-%d-%d",$myDate[2],$myDate[1],$myDate[0]);
}

function VAL2FLOAT( $cVal )
{
	$cVal = str_replace("R$","",$cVal);
	$cVal = str_replace(" ","",$cVal);
	$cVal = str_replace(".","",$cVal);
	$cVal = str_replace(",",".",$cVal);
	return $cVal;
} 

$row = 0;

if (($handle = fopen("21_PlanoAplicacaoPT.csv", "r")) !== FALSE) {

	$starttime = microtime(true);
	$conn = MySQLConnect();

	$stmt = mysqli_prepare($conn,"INSERT INTO PLANOAP (TP_DESPESA,TX_NATUREZAAQUISICAO,TX_DESCRICAODESPESA,CD_NATUREZADESPESA," .
	"NM_NATUREZADESPESA,QD_NATUREZADESPESA,VL_UNITARIO,VL_TOTAL,TX_UNIDADEFORNECIMENTO,TX_SITUACAODESPESA,ID_CONVENIO,ID_PROPOSTA) " .
	"VALUES (?,?,?,?,?,?,?,?,?,?,?,?) ");

	mysqli_real_query ( $conn , "SET autocommit = 0;" );

	while (($data = fgetcsv($handle, 8192, ';' , '"' , '"' )) !== FALSE) {
        $row++;
		if ( $row == 1)
			continue;
        $num = count($data);
		while ( $num < 32)
		{
			$nextdata = fgetcsv($handle, 8192, ';' , '"' , '"' );
			$nextnum = count($nextdata);

			$data[$num-1] += ' ' . $nextdata[0];
			for ($c=1; $c < $nextnum; $c++)
				$data[] = $nextdata[$c];
			$num = count($data);
		}
		if ( $num != 32 )
		{
			for ($c=0; $c < $num; $c++)
				echo '[' .  $c . '] ' . $data[$c] . "\n";
			die("Numero de Colunas inesperado (" . $num . ") na linha (" . $row . ")" );
		}
		$data[21] = VAL2FLOAT($data[21]);
		$data[22] = VAL2FLOAT($data[22]);
		
		$ok = mysqli_stmt_bind_param($stmt, 'ssssssiissii', 
			$data[15],          $data[16],		    $data[17],			$data[18],          
			$data[19],          $data[20],          $data[21],			$data[22],
			$data[23],         	$data[29],			$data[30],          $data[31] );

		if (!$ok)
		{
			die( "Bind Error: " . mysqli_stmt_error ( $stmt ));
		}
		if ( !mysqli_stmt_execute($stmt) )
		{
			die("Execute : " . mysqli_stmt_error ( $stmt ));
		}

		$timediff = microtime(true) - $starttime;
		if ( $timediff > 1 )
		{
			$starttime = microtime(true);
			printf("%d Row(s) processed.\n" ,$row);
			mysqli_real_query ( $conn , "COMMIT;" );
			mysqli_real_query ( $conn , "SET autocommit = 0;" );
		}

    }

	printf("%d Row(s) processed - DONE\n" ,$row);

	mysqli_real_query ( $conn , "COMMIT;" );
	MySQLDisconnect($conn);

    fclose ($handle);

}

?>

