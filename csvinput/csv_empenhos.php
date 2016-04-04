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

echo "Importando arquivo [03_Empenhos.csv]\n";

if (($handle = fopen("03_Empenhos.csv", "r")) !== FALSE) {

	$starttime = microtime(true);
	$conn = MySQLConnect();

	$stmt = mysqli_prepare($conn,"INSERT INTO EMPENHOS (NR_EMPENHO,TX_SITUACAO_EMPENHO,TX_TIPO_NOTA_EMPENHO,".
		"VL_NOTA_EMPENHO,IN_MINUTA_EMPENHO_SN,CD_GESTAO_EMITENTE,CD_UG_EMITENTE,NR_EMPENHO_REFERENCIA,".
		"DT_EMISSAO_EMPENHO,ANO_MES_EMISSAO,CD_FONTE_RECURSO,TX_ESFERA_ORCAMENTO,CD_PTRES,CD_PLANO_INTERNO,".
		"CD_UGR,DT_PAGAMENTO,TX_MUNICIPIO_BENEFICIADO,TX_UF,NR_LISTA,CD_UG_REFERENCIA,CD_GESTAO_REFERENCIA,".
		"ANO_NOTA_EMPENHO,CD_NATUREZA_DESPESA,CD_ERRO_SIAFI,TX_ERRO_SIAFI,CD_ORGAO_SUPERIOR_EMPENHO,".
		"NM_ORGAO_SUPERIOR_EMPENHO,CD_ORGAO_CONCEDENTE_EMPENHO,NM_ORGAO_CONCEDENTE_EMPENHO,TX_OBS_EMPENHO,".
		"CD_FAVORECIDO,TX_CONV_NR_NOTA_EMPENHO,TX_TITULO_UG,ANO_CONVENIO,NR_CONVENIO,ANO_PROPOSTA,NR_PROPOSTA,".
		"TX_MODALIDADE,TX_SITUACAO,TX_SUBSITUACAO,CD_ORGAO_SUPERIOR,NM_ORGAO_SUPERIOR,CD_ORGAO_CONCEDENTE,".
		"NM_ORGAO_CONCEDENTE,TX_ESFERA_ADM_PROPONENTE,TX_REGIAO_PROPONENTE,UF_PROPONENTE,NM_MUNICIPIO_PROPONENTE,".
		"CD_IDENTIF_PROPONENTE,NM_PROPONENTE,DT_INCLUSAO_PROPOSTA,ID_CONVENIO,ID_PROP) ".
		" VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

	mysqli_real_query ( $conn , "SET autocommit = 0;" );

	while (($data = fgetcsv($handle, 8192, ';' , '"' , '"' )) !== FALSE) {
        $row++;
		if ( $row == 1)
			continue;
        $num = count($data);

		while ($num < 53 )
		{
			$nextdata = fgetcsv($handle, 8192, ';' , '"' , '"' );
			$nextnum = count($nextdata);

			$data[$num-1] += ' ' . $nextdata[0];
			for ($c=1; $c < $nextnum; $c++)
				$data[] = $nextdata[$c];
			$num = count($data);
		}
		if ( $num != 53 )
		{
			for ($c=0; $c < $num; $c++)
				echo '[' .  $c . '] ' . $data[$c] . "\n";
			die("Numero de Colunas inesperado (" . $num . ") na linha (" . $row . ")" );
		}

        	$data[8] = DTOS($data[8]);
	        $data[15] = DTOS($data[15]);
        	$data[50] = DTOS($data[50]);

		$data[03] = VAL2FLOAT($data[03]);

		$refarg = array($stmt, 'sssisssssisssssssssssisssisisssssiiiisssisissssssssii');
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

