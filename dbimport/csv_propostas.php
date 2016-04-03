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

if (($handle = fopen("05_PropostasPrograma.csv", "r")) !== FALSE) {

	$starttime = microtime(true);
	$conn = MySQLConnect();

	$stmt = mysqli_prepare($conn,"INSERT INTO PROPOSTAS ( ANO_PROPOSTA,NR_PROPOSTA,ANO_CONVENIO,NR_CONVENIO,TX_MODALIDADE," .
	"TX_SITUACAO,TX_SUBSITUACAO,CD_PROGRAMA,CD_ACAO_PROGRAMA,CD_IDENTIF_PROPONENTE,NM_PROPONENTE," .
	"TX_ESFERA_ADM_PROPONENTE,TX_REGIAO_PROPONENTE,UF_PROPONENTE,NM_MUNICIPIO_PROPONENTE,DT_PROPOSTA," .
	"DT_INICIO_VIGENCIA,DT_FIM_VIGENCIA,DT_ASSINATURA,ANO_ASSINATURA,MES_ASSINATURA,DT_PUBLICACAO," .
	"VL_GLOBAL,VL_REPASSE,VL_REPASSE_EXERC_ATUAL,VL_CONTRAPARTIDA,VL_CONTRAPARTIDA_FINANC,VL_CONTRAPARTIDA_BENS_SERV," .
	"TX_QUALIFIC_PROPONENTE,IN_PARECER_GESTOR_SN,IN_PARECER_JURIDICO_SN,IN_PARECER_TECNICO_SN,NM_RESPONS_PROPONENTE," .
	"CD_RESPONS_PROPONENTE,NM_RESPONS_CONCEDENTE,CD_RESPONS_CONCEDENTE,NM_BANCO,TX_OBJETO_CONVENIO," .
	"TX_JUSTIFICATIVA,ID_PROPOSTA,ID_CONVENIO,ID_PROP_PROGRAMA) " .
	"VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");

	mysqli_real_query ( $conn , "SET autocommit = 0;" );

	while (($data = fgetcsv($handle, 8192, ';' , '"' , '"' )) !== FALSE) {
        $row++;
		if ( $row == 1)
			continue;
        $num = count($data);
		if ( $num != 47)
		{
			for ($c=0; $c < $num; $c++)
				echo '[' .  $c . '] ' . $data[$c] . "\n";
			die("Numero de Colunas inesperado (" . $num . ") na linha (" . $row . ")" );
		}
	
		$data[20] = DTOS($data[20]);
        $data[21] = DTOS($data[21]);
        $data[22] = DTOS($data[22]);
        $data[23] = DTOS($data[23]);
        $data[26] = DTOS($data[26]);

		$data[27] = VAL2FLOAT($data[27]);
		$data[28] = VAL2FLOAT($data[28]);
		$data[29] = VAL2FLOAT($data[29]);
		$data[30] = VAL2FLOAT($data[30]);
		$data[31] = VAL2FLOAT($data[31]);
		$data[32] = VAL2FLOAT($data[32]);

		
		$ok = mysqli_stmt_bind_param($stmt, 'iiiisssssssssssssssiisiiiiiisssssssssssiii', 
			$data[00],			$data[01],			$data[02],			$data[03],
			$data[04],			$data[05],			$data[06],			$data[07],			$data[08],
			$data[14],          $data[15],          $data[16],		    $data[17],
			$data[18],          $data[19],          $data[20],          $data[21],
			$data[22],          $data[23],          $data[24],          $data[25],
			$data[26],          $data[27],          $data[28],          $data[29],
			$data[30],          $data[31],          $data[32],          $data[33],
			$data[34],          $data[35],          $data[36],          $data[37],
			$data[38],          $data[39],          $data[40],          $data[41],
			$data[42],          $data[43],          $data[44],          $data[45],			$data[46] );

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

