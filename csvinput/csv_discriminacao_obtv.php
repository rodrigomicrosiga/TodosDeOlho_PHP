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

echo "Importando arquivo [18_Discriminacao_OBTV.csv]\n";

if (($handle = fopen("18_Discriminacao_OBTV.csv", "r")) !== FALSE) {

	$starttime = microtime(true);
	$conn = MySQLConnect();

	$stmt = mysqli_prepare($conn,"INSERT INTO DISCRIMINACAO_OBTV (ANO_CONVENIO,NR_CONVENIO,TX_MODALIDADE," . 
	"TX_SITUACAO,NM_BANCO_CONVENIO,CD_AGENCIA_CONVENIO,NR_CONTA_CORRENTE_CONVENIO,TX_SITUACAO_CONTA_CORRENTE," . 
	"CD_ORGAO_CONCEDENTE,NM_ORGAO_CONCEDENTE,CD_IDENT_CONVENENTE,NM_IDENT_CONVENENTE,TX_ESFERA_ADM_CONVENENTE," . 
	"NM_MUNICIPIO_CONVENENTE,UF_CONVENENTE,TX_REGIAO_CONVENENTE,NR_MOVIMENTACAO_FINANCEIRA,VL_PAGAMENTO," . 
	"ID_CONVENIO,TX_FORMA_PAGAMENTO,TX_SITUACAO_DISCRIMINACAO,NR_DOCUMENTO_ITEM,DT_EMISSAO,DT_PAGAMENTO," . 
	"TP_IDENTIF_FAVORECIDO,NR_IDENTIF_FAVORECIDO,NM_FAVORECIDO,TX_TIPO_AQUISICAO,TX_DESCRICAO_ITEM," . 
	"TX_TIPO_DOCUMENTO_ITEM) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

	mysqli_real_query ( $conn , "SET autocommit = 0;" );

	while (($data = fgetcsv($handle, 8192, ';' , '"' , '"' )) !== FALSE) {
        $row++;
		if ( $row == 1)
			continue;
        $num = count($data);

		while ($num < 30 )
		{
			$nextdata = fgetcsv($handle, 8192, ';' , '"' , '"' );
			$nextnum = count($nextdata);

			$data[$num-1] += ' ' . $nextdata[0];
			for ($c=1; $c < $nextnum; $c++)
				$data[] = $nextdata[$c];
			$num = count($data);
		}
		if ( $num != 30 )
		{
			for ($c=0; $c < $num; $c++)
				echo '[' .  $c . '] ' . $data[$c] . "\n";
			die("Numero de Colunas inesperado (" . $num . ") na linha (" . $row . ")" );
		}
	
        	$data[22] = DTOS($data[22]);
	        $data[23] = DTOS($data[23]);

		$data[17] = VAL2FLOAT($data[17]);

		$refarg = array($stmt, 'issssississssssssiisssssssssss');
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

