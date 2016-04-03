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

if (($handle = fopen("17_Pagamento_OBTV.csv", "r")) !== FALSE) {

	$starttime = microtime(true);
	$conn = MySQLConnect();

	$stmt = mysqli_prepare($conn,"INSERT INTO PAGAMENTO_OBTV (ANO_CONVENIO,NR_CONVENIO,TX_MODALIDADE," . 
	"TX_SITUACAO,NM_BANCO_CONVENIO,CD_AGENCIA_CONVENIO,NR_CONTA_CORRENTE_CONVENIO,TX_SITUACAO_CONTA_CORRENTE," . 
	"CD_ORGAO_CONCEDENTE,NM_ORGAO_CONCEDENTE,CD_IDENT_CONVENENTE,NM_IDENT_CONVENENTE,TX_ESFERA_ADM_CONVENENTE," . 
	"NM_MUNICIPIO_CONVENENTE,UF_CONVENENTE,TX_REGIAO_CONVENENTE,IN_PAGAMENTO_PARCIAL_SN,NR_MOVIMENTACAO_FINANCEIRA," . 
	"NR_OBTV_SIAFI,TX_TIPO_MOVIMENTACAO,TX_SITUACAO_MOVIMENTACAO,DT_INCLUSAO_MOV_FINANCEIRA,DT_AUT_GESTOR_FINANCEIRO," . 
	"CPF_GESTOR_FINANCEIRO,NM_GESTOR_FINANCEIRO,DT_AUT_ORDENADOR_DESPESA,CPF_ORDENADOR_DESPESA,NM_ORDENADOR_DESPESA," . 
	"DT_CANC_MOV_FINANCEIRA,NM_EVENTO,NM_RESPONSAVEL_EVENTO,NR_OBTV_CANCELAMENTO,VL_PAGAMENTO," . 
	"ID_CONVENIO,ID_DOCLIQUIDACAO) " . 
	" VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

	mysqli_real_query ( $conn , "SET autocommit = 0;" );

	while (($data = fgetcsv($handle, 8192, ';' , '"' , '"' )) !== FALSE) {
        $row++;
		if ( $row == 1)
			continue;
        $num = count($data);
		if ( $num != 35)
		{
			for ($c=0; $c < $num; $c++)
				echo '[' .  $c . '] ' . $data[$c] . "\n";
			die("Numero de Colunas inesperado (" . $num . ") na linha (" . $row . ")" );
		}
	
	        $data[21] = DTOS($data[21]);
        	$data[22] = DTOS($data[22]);
	        $data[25] = DTOS($data[25]);
	        $data[28] = DTOS($data[28]);

		$data[32] = VAL2FLOAT($data[32]);

		$refarg = array($stmt, 'iissssssisssssssssssssssssssssssiii');
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

