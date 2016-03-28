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

function ShowData( $data )
{
	
	echo $data[0] . " [CD_PROGRAMA]\n";
	echo $data[1] . " [NM_PROGRAMA]\n";
	echo $data[2] . " [TX_ACAO_PPA]\n";
	echo $data[3] . " [TX_DESCRICAO_PROGRAMA]\n";
	echo $data[4] . " [TX_SITUACAO_PROGRAMA]\n";
	echo $data[5] . " [CD_ORG_SUPERIOR]\n";
	echo $data[7] . " [CD_ORG_CONCEDENTE]\n";
	echo $data[9] . " [DT_DISPONIBILIZACAO]\n";
	echo $data[10] . " [ANO_DISPONIBILIZACAO]\n";
	echo $data[11] . " [MES_DISPONIBILIZACAO]\n";
	echo $data[12] . " [DT_INC_VIGENCIA]\n";
	echo $data[13] . " [ANO_INC_VIGENCIA]\n";
	echo $data[14] . " [MES_INC_VIGENCIA]\n";
	echo $data[15] . " [DT_FIM_VIGENCIA]\n";
	echo $data[16] . " [ANO_FIM_VIGENCIA]\n";
	echo $data[17] . " [MES_FIM_VIGENCIA]\n";
	echo $data[18] . " [CD_MANDATARIA]\n";
	echo $data[19] . " [NM_MANDATARIA]\n";
	echo $data[20] . " [CD_EXECUTOR]\n";
	echo $data[22] . " [IN_CRITERIO_SELECAO]\n";
	echo $data[23] . " [IN_CHAMA_PUBLICO]\n";
	echo $data[24] . " [IN_REQUER_BENS_SERV]\n";
	echo $data[25] . " [IN_REQUER_CRONO_DESEMB]\n";
	echo $data[26] . " [IN_ACEITA_PROP_SEM_CADASTRO]\n";
	echo $data[27] . " [IN_REQUER_PLANO_TRABALHO]\n";
	echo $data[28] . " [IN_EMENDA_PARLAMENTAR]\n";
	echo $data[29] . " [ID_PROGRAMA_CONVENIO]\n";
	echo $data[30] . " [QT_PROPOSTA			]\n";
	echo $data[31] . " [QT_CONVENIO]\n";

}

$row = 0;

if (($handle = fopen("14_Programas.csv", "r")) !== FALSE) {

	$starttime = microtime(true);
	$conn = MySQLConnect();

	$stmt = mysqli_prepare($conn,"Insert into PROGRAMAS (CD_PROGRAMA,NM_PROGRAMA,TX_ACAO_PPA,TX_DESCRICAO_PROGRAMA,TX_SITUACAO_PROGRAMA," .
	"CD_ORG_SUPERIOR,CD_ORG_CONCEDENTE,DT_DISPONIBILIZACAO,ANO_DISPONIBILIZACAO,MES_DISPONIBILIZACAO,DT_INC_VIGENCIA,ANO_INC_VIGENCIA," .
	"MES_INC_VIGENCIA,DT_FIM_VIGENCIA,ANO_FIM_VIGENCIA,MES_FIM_VIGENCIA,CD_MANDATARIA,NM_MANDATARIA,CD_EXECUTOR,IN_CRITERIO_SELECAO," . 
	"IN_CHAMA_PUBLICO,IN_REQUER_BENS_SERV,IN_REQUER_CRONO_DESEMB,IN_ACEITA_PROP_SEM_CADASTRO,IN_REQUER_PLANO_TRABALHO,IN_EMENDA_PARLAMENTAR," . 
	"ID_PROGRAMA_CONVENIO,QT_PROPOSTA,QT_CONVENIO ) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

	mysqli_real_query ( $conn , "SET autocommit = 0;" );

	while (($data = fgetcsv($handle, 8192, ";" , "\"")) !== FALSE) {
        $row++;
		if ( $row == 1)
			continue;
        $num = count($data);
		if ( $num != 32)
			die("Numero de Colunas inesperado (" . $num . ") na linha (" . $row . ")" );

		// --- Conversoes -----
		// VErificar se meu DB está CP1252 ou UTF-8
		
		//$data[1] = iconv("UTF-8","CP1252//IGNORE",$data[1]);
		//$data[3] = iconv("UTF-8","CP1252//IGNORE",$data[3]);
		$data[9] = DTOS($data[9]);
        $data[12] = DTOS($data[12]);
        $data[15] = DTOS($data[15]);
		
		$ok = mysqli_stmt_bind_param($stmt, 'sssssiisiisiisiiisisssssssiii', 
			$data[0],			$data[1],			$data[2],			$data[3],
			$data[4],			$data[5],			$data[7],			$data[9],
			$data[10],          $data[11],          $data[12],          $data[13],
			$data[14],          $data[15],          $data[16],		    $data[17],
			$data[18],          $data[19],          $data[20],          $data[22],
			$data[23],          $data[24],          $data[25],          $data[26],
			$data[27],          $data[28],          $data[29],          $data[30],
			$data[31] );

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



	