<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php 

ob_start();

require_once('headmetas.php'); 
require_once('dbconn.php'); 
require_once('ufs.php');

// -------------------------------------------------------
// Pesquisa dos municípios dentro de um estado
// -------------------------------------------------------

$cUF = filter_input(INPUT_GET, 'UF');

if (  is_null($cUF) ) 
{
	$cErrorMSG = "Estado (UF) não informado.";
	$cErrorHLP = 'A busca por municípios não recebeu corretamente o estado a ser pesquisado. ' . 
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
    font-size: 120%;
}
</style>
<script type = 'text/javascript'>
function SelectLastMUN()
{
	if(typeof(Storage) !== "undefined") {
		var savedMUN = localStorage.getItem('MUN');
		if( savedMUN ) {
			var currentMUN = window.document.getElementById('MUN');
			currentMUN.value = savedMUN;
		}
	}
}
function Voltar()
{
	window.open("/php/siconvuf.php","_self");
}
function ConsultaMUN(cCod) 
{
	
	localStorage.setItem('MUN',cCod);
	window.open("/php/siconv02.php?MUN="+cCod,"_self");
}
function Home()
{
	window.open("/","_self");
}
function ConsultaGEO()
{                          
    if (navigator.geolocation) 
    {
        navigator.geolocation.getCurrentPosition(OpenGeo);
    } else { 
        alert("Localização atual não disponivel");
    }
}

function OpenGeo(position)
{
	var _lat = Math.round(position.coords.latitude*10000000) / 10000000;
	var _long = Math.round(position.coords.longitude*10000000) / 10000000;
	window.open("/php/siconvgeo.php?LAT="+_lat+
	            "&LONG="+_long,"_self");
}                                         
function FilterMun(oFilter,oSelect)
{
	var cFlt = oFilter.value.toUpperCase();
  oFilter.value = cFlt;   
	for ( var i=0 ; i < oSelect.options.length ; i++)
	{
		var cOpt = oSelect.options[i].text.toUpperCase();
		if ( cFlt == cOpt.substr(0,cFlt.length) )
		{             
		  oSelect.options[i].selected = true;
		  break;
		}
	}
}

</script>
</head>
<body onload="javascript:SelectLastMUN()">
<?php require_once('ptitle.php'); ?>
<h3>Estado: <?php echo UFName($cUF); ?></h3>
<p>Escolha um município para pesquisar. Você pode começar digitando as primeiras letras do nome do município no campo de busca abaixo.</p>
<p>
<input type="search" id="FLT" 
name="FLT" value="" 
size="15" maxsize="15" placeholder="Filtrar cidades" 
onkeyup="javascript:FilterMun(this,MUN)" 
autofocus></p>
<p>
<select id="MUN" name="MUN">
<?php 

ob_flush();

$conn = MySQLConnect();

$stmt = mysqli_prepare($conn, "Select CODIGO,NOME,UF from MUNICIPIOS where UF = ? ORDER BY UF,NOME");
mysqli_stmt_bind_param($stmt,'s',$cUF);

if (mysqli_stmt_execute ( $stmt ))
{
	mysqli_stmt_bind_result ( $stmt , $dbCODIGO , $dbNOME , $dbUF );
	while (mysqli_stmt_fetch($stmt))
    {
		echo '<option value="' . $dbCODIGO . '">' . $dbNOME . '</option>\n';
    }
}

mysqli_stmt_close($stmt);
MySQLDisconnect( $conn );

ob_flush();
?>
</select>
</p>
<p>
<input type="button" value="Buscar" onclick="javascript:ConsultaMUN(MUN.value)">
&nbsp;&nbsp;&nbsp;
<input type="button" value="Voltar" onclick="javascript:Voltar()">
</p>
<p><input type="button" value="Use sua localização" onclick="javascript:ConsultaGEO()"></p>
<p><input type="button" value="Retornar ao Início" onclick="javascript:Home()"></p>
<br>
<?php 
require_once('footer.php'); 
?>
</body>
</html>
<?php 
ob_end_flush(); 
?>
