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

if (($handle = fopen("07_PropostasDadosBancarios.csv", "r")) !== FALSE) {

	$starttime = microtime(true);
	$conn = MySQLConnect();

	$stmt = mysqli_prepare($conn,"INSERT INTO PROPOSTAS_BANCOS (ANO_PROPOSTA,NR_PROPOSTA,ANO_CONVENIO,NR_CONVENIO," .
		"TX_MODALIDADE,TX_SITUACAO,TX_SUBSITUACAO,CD_ORGAO_SUPERIOR,NM_ORGAO_SUPERIOR,CD_ORGAO_CONCEDENTE,NM_ORGAO_CONCEDENTE," .
		"CD_IDENTIF_PROPONENTE,NM_PROPONENTE,TX_ESFERA_ADM_PROPONENTE,TX_REGIAO_PROPONENTE,UF_PROPONENTE,NM_MUNICIPIO_PROPONENTE," .
		"DT_PROPOSTA,NM_BANCO,CD_AGENCIA,DV_AGENCIA,NR_CONTA_CORRENTE,TX_CONTA_CORRENTE,DT_ULTIMA_MODIFICACAO,ID_PROPOSTA," .
		"ID_CONVENIO) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

	mysqli_real_query ( $conn , "SET autocommit = 0;" );

	while (($data = fgetcsv($handle, 8192, ';' , '"' , '"' )) !== FALSE) {
        $row++;
		if ( $row == 1)
			continue;
        $num = count($data);

		while ($num < 26 )
		{
			$nextdata = fgetcsv($handle, 8192, ';' , '"' , '"' );
			$nextnum = count($nextdata);

			$data[$num-1] += ' ' . $nextdata[0];
			for ($c=1; $c < $nextnum; $c++)
				$data[] = $nextdata[$c];
			$num = count($data);
		}
		if ( $num != 26 )
		{
			for ($c=0; $c < $num; $c++)
				echo '[' .  $c . '] ' . $data[$c] . "\n";
			die("Numero de Colunas inesperado (" . $num . ") na linha (" . $row . ")" );
		}

	        $data[17] = DTOS($data[17]);
        	$data[23] = DTOS($data[23]);

		$refarg = array($stmt, 'isissssisissssssssssssssii');
		for ($c=0; $c < $num; $c++)
            		$refarg[] =& $data[$c];
		
		$ok = call_user_func_array("mysqli_stmt_bind_param", $refarg);

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

