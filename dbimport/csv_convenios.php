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

if (($handle = fopen("01_ConveniosProgramas.csv", "r")) !== FALSE) {

	$starttime = microtime(true);
	$conn = MySQLConnect();

	$stmt = mysqli_prepare($conn,"INSERT INTO CONVENIOS (" . 
	"ANO_CONVENIO,NR_CONVENIO,ANO_PROPOSTA,NR_PROPOSTA,TX_MODALIDADE,TX_SITUACAO," . 
	"TX_SUBSITUACAO,CD_ORGAO_SUPERIOR,NM_ORGAO_SUPERIOR,CD_ORGAO_CONCEDENTE,TX_ESFERA_ADM_PROPONENTE," . 
	"TX_REGIAO_PROPONENTE,UF_PROPONENTE,NM_MUNICIPIO_PROPONENTE,CD_IDENTIF_PROPONENTE,NM_PROPONENTE," . 
	"NM_ORGAO_CONCEDENTE,DT_INCLUSAO_PROPOSTA,CD_PROGRAMA,NM_PROGRAMA,CD_ACAO_PPA,DT_INICIO_VIGENCIA," . 
	"DT_FIM_VIGENCIA,DT_ASSINATURA_CONVENIO,MES_ASSINATURA_CONVENIO,ANO_ASSINATURA_CONVENIO," . 
	"MES_PUBLICACAO_CONVENIO,ANO_PUBLICACAO_CONVENIO,DT_PUBLICACAO,DT_ULTIMO_EMPENHO," . 
	"DT_ULTIMO_PGTO,VL_GLOBAL,VL_REPASSE,VL_CONTRAPARTIDA_TOTAL,VL_CONTRAPARTIDA_FINANC," . 
	"VL_CONTRAPARTIDA_BENS_SERV,VL_DESEMBOLSADO,VL_EMPENHADO,TX_OBJETO_CONVENIO,TX_JUSTIFICATIVA," . 
	"TX_ENDERECO_PROPONENTE,TX_BAIRRO_PROPONENTE,NR_CEP_PROPONENTE,NM_RESPONS_PROPONENTE," . 
	"CD_RESPONS_PROPONENTE,TX_CARGO_RESPONS_PROPONENTE,NM_RESPONS_CONCEDENTE,CD_RESPONS_CONCEDENTE," . 
	"TX_CARGO_RESPONS_CONCEDENTE,TX_SITUACAO_PUBLICACAO,NR_PROCESSO_CONVENIO,NR_INTERNO_CONVENIO," . 
	"IN_ASSINADO_SN,IN_ADITIVO_SN,IN_PUBLICADO_SN,IN_EMPENHADO_SN,IN_PRORROGA_OFICIO_SN," . 
	"IN_PERMITE_AJUSTE_CRON_FISICO,QT_EMPENHOS,QT_ADITIVOS,QT_PRORROGAS,TX_QUALIFIC_PROPONENTE," . 
	"ID_CONVENIO,ID_PROP,ID_PROP_PROGRAMA)" . 
	" VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

	mysqli_real_query ( $conn , "SET autocommit = 0;" );

	while (($data = fgetcsv($handle, 8192, ';' , '"' , '"' )) !== FALSE) {
        $row++;
		if ( $row == 1)
			continue;
        $num = count($data);
		if ( $num != 65)
		{
			for ($c=0; $c < $num; $c++)
				echo '[' .  $c . '] ' . $data[$c] . "\n";
			die("Numero de Colunas inesperado (" . $num . ") na linha (" . $row . ")" );
		}
	
		$data[17] = DTOS($data[17]);
        $data[21] = DTOS($data[21]);
        $data[22] = DTOS($data[22]);
        $data[23] = DTOS($data[23]);
        $data[28] = DTOS($data[28]);
        $data[29] = DTOS($data[29]);
        $data[30] = DTOS($data[30]);

		$data[31] = VAL2FLOAT($data[31]);
		$data[32] = VAL2FLOAT($data[32]);
		$data[33] = VAL2FLOAT($data[33]);
		$data[34] = VAL2FLOAT($data[34]);
		$data[35] = VAL2FLOAT($data[35]);
		$data[36] = VAL2FLOAT($data[36]);
		$data[37] = VAL2FLOAT($data[37]);

		$refarg = array($stmt, 'iiiisssisissssssssssssssiiiisssiiiiiiissssssssssssssssssssiiisiii');
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

