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

echo "Importando arquivo [19_CronogramaFisicoPT.csv]\n";

if (($handle = fopen("19_CronogramaFisicoPT.csv", "r")) !== FALSE) {

	$starttime = microtime(true);
	$conn = MySQLConnect();

	$stmt = mysqli_prepare($conn,"INSERT INTO CRONOGRAMA_FISICO (ANO_PROPOSTA,NR_PROPOSTA," . 
	"TX_SITUACAOPROPOSTA,TX_MODALIDADE,ANO_CONVENIO,NR_CONVENIO,CD_ORGAO_CONCEDENTE," . 
	"NM_ORGAO_CONCEDENTE,CD_IDENT_PROPONENTE,NM_IDENT_PROPONENTE,TP_IDENT_PROPONENTE," . 
	"TX_ESFERA_ADM_PROPONENTE,NM_MUNICIPIO_PROPONENTE,UF_PROPONENTE,TX_REGIAO_PROPONENTE," . 
	"TX_ESPECIFICACAO,DT_INICIO,DT_TERMINO,VL_META,ID_CONVENIO,ID_PROPOSTA) " .
	"VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

	if ( false === $stmt )
	{
		die( "Prepare Error: " . mysqli_error ( $conn ));
	}

	mysqli_real_query ( $conn , "SET autocommit = 0;" );

	while (($data = fgetcsv($handle, 8192, ';' , '"' , '"' )) !== FALSE) {
        $row++;
		if ( $row == 1)
			continue;
        $num = count($data);

		while ($num < 21 )
		{
			$nextdata = fgetcsv($handle, 8192, ';' , '"' , '"' );
			$nextnum = count($nextdata);

			$data[$num-1] += ' ' . $nextdata[0];
			for ($c=1; $c < $nextnum; $c++)
				$data[] = $nextdata[$c];
			$num = count($data);
		}
		if ( $num != 21 )
		{
			for ($c=0; $c < $num; $c++)
				echo '[' .  $c . '] ' . $data[$c] . "\n";
			die("Numero de Colunas inesperado (" . $num . ") na linha (" . $row . ")" );
		}


		$data[16] = DTOS($data[16]);
		$data[17] = DTOS($data[17]);
		$data[18] = VAL2FLOAT($data[18]);

		$refarg = array($stmt, 'isssisisssssssssssiii');
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

