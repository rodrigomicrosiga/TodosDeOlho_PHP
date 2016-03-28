<html lang="pt-BR">
<head>
<?php 
require_once('headmetas.php'); 
require_once('dbconn.php'); 

// -------------------------------------------------------
// Pesquisa dos municípios mais próximos por coordenadas geográficas
// -------------------------------------------------------

$cLAT = filter_input(INPUT_GET, 'LAT');
$cLONG = filter_input(INPUT_GET, 'LONG');

if ( is_null($cLAT) || is_null($cLONG) ) 
{
	$cErrorMSG = 'Coordenadas geográficas não recebidas.';
	$cErrorHLP = 'A busca por sua localização atual não recebeu corretamente as informações de localização. ' .
				 'Certifique-se de aceitar o uso de sua localiação para utilizar esta opção. ' .
				 'Retorne para a tela anterior e tente novamente, ou volte ao início do site.' ;
    require 'sicerror.php';
	return;	
}

?>
<style>
input, textarea {
  max-width:100%;
}
h1, h3 {
  text-align:center;
}
p {
  text-align:center;
  font-size: 100%;
}
a, select, input {
    padding:5px 15px; 
    background:#ccc; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
    font-size: 130%;
}
</style>
<script type = 'text/javascript'>
function ConsultaMUN(cCod,cUF) 
{
	localStorage.setItem('UF',cUF);
	localStorage.setItem('MUN',cCod);
	window.open("/php/siconv02.php?MUN="+cCod,"_self");
}
function Voltar()
{
	window.open("/php/siconvuf.php","_self");
}
</script>
</head>
<body onload="javascript:SelectLastUF()">
<?php require_once('ptitle.php'); ?>
<h3>Municípios Próximos</h3>
<br>
<?php 
$conn = MySQLConnect();

$cQuery = 	'select CODIGO,NOME,UF,' .
			' abs ( LATITUDE - ? ) + abs ( LONGITUDE - ? ) as DIF '.
			' from MUNICIP MUN ' .
			' where (abs ( LATITUDE - ? )  + abs ( LONGITUDE - ? )) < 0.2 ' . 
			' order by 4';

$stmt = mysqli_prepare($conn, $cQuery);

mysqli_stmt_bind_param($stmt,'dddd',$cLAT,$cLONG,$cLAT,$cLONG);

if (mysqli_stmt_execute ( $stmt ))
{
	$nShow = 0;

	mysqli_stmt_bind_result ( $stmt , $dbCODIGO , $dbNOME , $dbUF , $nDist );
	while (mysqli_stmt_fetch($stmt))
    {
		echo '<p><input type="button" value="' . htmlspecialchars($dbNOME) . ' / ' . $dbUF. '" ' .
				'onclick="javascript:ConsultaMUN(\''. $dbCODIGO. '\',\''. $dbUF. '\')"></p>' ;
		$nShow++;
    }

	if ( $nShow == 0 )
	{
		echo '<p>Latitude: ' .$cLAT. '<br>Longitude: ' .$cLONG. '</p>';
		echo '<p>Não foi identificado nenhum município próximo a sua localização atual. Volte para a página anterior ' . 
				'e selecione manualmente um Estado e Município para realizar a consulta.</p>' ;
	}

}

MySQLDisconnect( $conn );
?>

<p><input type="button" value="Voltar" onclick="javascript:Voltar()"></p>
<br>
<br>
<?php require_once('footer.php'); ?>
</body>
<script>
</script>
</html>

