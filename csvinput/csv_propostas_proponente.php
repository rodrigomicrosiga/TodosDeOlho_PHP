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

if (($handle = fopen("09_PropostasDadosProponente.csv", "r")) !== FALSE) {

	$starttime = microtime(true);
	$conn = MySQLConnect();

	$stmt = mysqli_prepare($conn,"INSERT INTO PROPOSTAS_PROPONENTE ( ANO_PROPOSTA,NR_PROPOSTA," . 
		"ANO_CONVENIO,NR_CONVENIO,TX_MODALIDADE,TX_SITUACAO,TX_SUBSITUACAO,CD_ORGAO_SUPERIOR," . 
		"NM_ORGAO_SUPERIOR,CD_ORGAO_CONCEDENTE,NM_ORGAO_CONCEDENTE,CD_IDENTIF_PROPONENTE," . 
		"NM_PROPONENTE,TX_ESFERA_ADM_PROPONENTE,TX_REGIAO_PROPONENTE,UF_PROPONENTE," . 
		"NM_MUNICIPIO_PROPONENTE,DT_PROPOSTA,TX_ENDERECO_PROPONENTE,NM_BAIRRO_PROPONENTE," . 
		"NR_CEP_PROPONENTE,TX_EMAIL_PROPONENTE,NR_TELEFONE_PROPONENTE,NR_FAX_PROPONENTE," . 
		"TX_INSC_ESTADUAL_PROPONENTE,TX_INSC_MUNICIPAL_PROPONENTE,TX_NAT_JURIDICA_PROPONENTE," . 
		"CD_RESP_PROPONENTE,NM_RESP_PROPONENTE,CD_RESP_CONCEDENTE,NM_RESP_CONCEDENTE,ID_PROPOSTA," . 
		"ID_CONVENIO,CD_MUNICIPIO_PROPONENTE ) " . 
		"VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

	mysqli_real_query ( $conn , "SET autocommit = 0;" );

	while (($data = fgetcsv($handle, 8192, ';' , '"' , '"' )) !== FALSE) {
        $row++;
		if ( $row == 1)
			continue;
        $num = count($data);

		while ($num < 34 )
		{
			$nextdata = fgetcsv($handle, 8192, ';' , '"' , '"' );
			$nextnum = count($nextdata);

			$data[$num-1] += ' ' . $nextdata[0];
			for ($c=1; $c < $nextnum; $c++)
				$data[] = $nextdata[$c];
			$num = count($data);
		}
		if ( $num != 34 )
		{
			for ($c=0; $c < $num; $c++)
				echo '[' .  $c . '] ' . $data[$c] . "\n";
			die("Numero de Colunas inesperado (" . $num . ") na linha (" . $row . ")" );
		}

	        $data[17] = DTOS($data[17]);

		$refarg = array($stmt, 'isissssisisssssssssssssssssssssiii');
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

