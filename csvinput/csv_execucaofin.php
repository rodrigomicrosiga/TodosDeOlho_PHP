<?php

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

echo "Importando arquivo [04_ExecucaoFinanceira.csv]\n";

if (($handle = fopen("04_ExecucaoFinanceira.csv", "r")) !== FALSE) {

	$starttime = microtime(true);
	$conn = MySQLConnect();

	$stmt = mysqli_prepare($conn,"INSERT INTO EXECUCAOFIN (CD_UG_EMITENTE,CD_GESTAO_EMITENTE,TX_TIPO_DOCUMENTO,DT_DESEMBOLSO," .
		"MES_DESEMBOLSO,ANO_DESEMBOLSO,VL_DESEMBOLSADO,NR_INTERNO,NR_SIAFI,NR_CANCELAMENTO,ID_CONVENIO,ID_PROP) " .
		"VALUES (?,?,?,?,?,?,?,?,?,?,?,?) ");
	
	mysqli_real_query ( $conn , "SET autocommit = 0;" );

	while (($data = fgetcsv($handle, 8192, ';' , '"' , '"' )) !== FALSE) {
        $row++;
		if ( $row == 1)
			continue;
        $num = count($data);
		if ( $num != 30 )
		{
			for ($c=0; $c < $num; $c++)
				echo '[' .  $c . '] ' . $data[$c] . "\n";
			die("Numero de Colunas inesperado (" . $num . ") na linha (" . $row . ")" );
		}

		$data[21] = DTOS($data[21]);
		$data[24] = VAL2FLOAT($data[24]);
		
		$ok = mysqli_stmt_bind_param($stmt, 'ssssiiisssii', 
			$data[18],		$data[19],          	$data[20],          	$data[21],	    
			$data[22],		$data[23],       	$data[24],		$data[25],
		        $data[26], 		$data[27],         	$data[28],		$data[29] );

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

