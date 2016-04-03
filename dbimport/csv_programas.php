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

	while (($data = fgetcsv($handle, 8192, ';' , '"' , '"'  )) !== FALSE) {
        $row++;
		if ( $row == 1)
			continue;
        $num = count($data);
		if ( $num != 32)
			die("Numero de Colunas inesperado (" . $num . ") na linha (" . $row . ")" );

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



	