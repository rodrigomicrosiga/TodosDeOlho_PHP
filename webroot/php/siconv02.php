<html lang="pt-BR">
<head>
<?php 
require_once('headmetas.php'); 
require_once('dbconn.php'); 

ob_start();

$cMunID = filter_input(INPUT_GET, 'MUN');

if (  is_null($cMunID) ) 
{
	$cErrorMSG = "Município não informado.";
	$cErrorHLP = 'A busca por propostas e convênios não recebeu corretamente o município a ser pesquisado. ' . 
					'Retorne para a tela anterior e tente novamente, ou volte ao início do site.' ;
    require 'sicerror.php';
	return;	
}

$conn = MySQLConnect();

$stmt = mysqli_prepare($conn, "Select CODIGO,NOME,UF from MUNICIPIOS where CODIGO = ?");
mysqli_stmt_bind_param($stmt,'s',$cMunID);

if ( mysqli_stmt_execute ( $stmt ) )
{
	mysqli_stmt_bind_result ( $stmt , $dbCODIGO , $dbNOME , $dbUF );
	if (mysqli_stmt_fetch($stmt))
    {
		$cMunicipio = ucfirst(mb_convert_case($dbNOME,MB_CASE_LOWER));
		$cUF = $dbUF;
    }
	else
	{
		$cErrorMSG = "Município não encontrado.";
		$cErrorHLP = 'A busca pelo código do município não identificou o município informado. ' . 
					'Retorne para a tela anterior e tente novamente, ou volte ao início do site.' ;
		require 'sicerror.php';
		return;	
	}

	mysqli_stmt_close($stmt);
	
	$stmt = NULL;
}

?>
<style>
input, textarea {
  max-width: 100%;
}
h1, h3 {
  text-align:center;
}
p, td {
  text-align:center;
  font-size: 100%;
}

table {
  width: 100%;
}

#tdodd {
  background:#ccc; 
}

a {
    padding:5px 15px; 
    border:0 none;
    cursor:pointer;
    font-size: 130%;
}

select, input {
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
function Propostas(cCod)
{
	window.open("/php/siconv03.php?MUN=<?php echo $cMunID ?>&CCD="+cCod+"&PAGE=1&ORD=D","_self");
}
function Voltar()
{
	window.open("/php/siconvmun.php?UF=<?php echo $cUF?>","_self");
}
function Home()
{
	window.open("/","_self");
}
function ShowHelp()
{
   var helpdiv = window.document.getElementById('_HELP');
   var showhelpbtn = window.document.getElementById('_SHOWHELP');
   var hidehelpbtn = window.document.getElementById('_HIDEHELP');
   helpdiv.style.display = 'inline';
   showhelpbtn.style.display = 'none'
   hidehelpbtn.style.display = 'inline';
}
function HideHelp()
{
   var helpdiv = window.document.getElementById('_HELP');
   var showhelpbtn = window.document.getElementById('_SHOWHELP');
   var hidehelpbtn = window.document.getElementById('_HIDEHELP');
   helpdiv.style.display = 'none'
   showhelpbtn.style.display = 'inline';
   hidehelpbtn.style.display = 'none'
}
</script>
</head>
<body onload="javascript:HideHelp();">
<table>
<tr><td colspan="5">
<?php require_once('ptitle.php'); ?>
</td></tr>
<tr><td colspan="5">
<h3><?php echo $cMunicipio ?> / <?php echo $cUF ?> - Propostas e Convênios</h3>
</td></tr>
<tr><td colspan="5">
<div id="_HELP" style="display: none">
<hr>
<h3>Ajuda</h3>
<p>Esta consulta mostra uma lista das propostas realizadas e convênios firmados com o município, 
separados por Órgão Concedente do Governo, ordenados pelos maiores valores conveniados.</p>
<p>A primeira coluna da tabela mostra um link com o nome do órgão, basta clicar sobre  
ele para consultar as propostas ou convênios relacionadas ao órgão em questão. A tabela 
possui as seguintes informações:</p>
<p>
<ul> 
<li><b>Órgão Concedente:</b> Nome do órgão ou ministério responsável por conceder o benefício / repasse.</li>
<li><b>Propostas:</b> Quantidade de propostas realizadas e registradas para este concedente no sistema de convênios.</li>
<li><b>Valor Proposto:</b> Soma do valor global de todas as propostas do órgão em questão.</li>
<li><b>Convênios firmados:</b> Corresponde ao número de propostas que se tornaram convênios.</li>
<li><b>Valor Conveniado:</b> Soma do valor global de repasse de todos os convênios firmados para o órgão em questão.</li>
</ul>
</p>
<hr>
</div>
<p>
<span id="_SHOWHELP">
<input type="button" value="Ajuda" onclick="javascript:ShowHelp();">
&nbsp;&nbsp;&nbsp;
</span>
<span id="_HIDEHELP" style="display: none">
<input type="button" value="Ocultar Ajuda" onclick="javascript:HideHelp();">
&nbsp;&nbsp;&nbsp;
</span>
<input type="button" value="Voltar" onclick="javascript:Voltar()"></p>
<td></tr>
<tr>
<th stype="max-width: 100%;">Órgão Concedente</th>
<th>Propostas<br>Enviadas</th>
<th>Valor das<br>Propostas</th>
<th>Propostas<br>Aprovadas<br>(Convênios)</th>
<th>Valor do<br>Investimento</th>
</tr>
<?php 

ob_flush();

$cQuery = "select CD_ORGAO_CONCEDENTE , NM_ORGAO_CONCEDENTE , ";
$cQuery = $cQuery . "round(sum(VL_GLOBAL)/1000000,2) AS GLOBAL, ";
$cQuery = $cQuery . "count(*) as QTD from PROPOSTAS ";
$cQuery = $cQuery . "where ID_MUNICIPIO_PROPONENTE = ? ";
$cQuery = $cQuery . "group by CD_ORGAO_CONCEDENTE , NM_ORGAO_CONCEDENTE ";
$cQuery = $cQuery . "order by 3 desc";

$stmt = mysqli_prepare($conn, $cQuery);
mysqli_stmt_bind_param($stmt,'s',$cMunID);

$aResumo = array();

if ( mysqli_stmt_execute ( $stmt ) )
{
	mysqli_stmt_bind_result ( $stmt , $dbIdOrgao, $dbNomeOrgao , $dbVlGlobal , $dbQuantidade );

	while (mysqli_stmt_fetch($stmt))
	{
		$aOrgao[] = $dbIdOrgao;
		$aResumo[] = array($dbIdOrgao , $dbNomeOrgao , $dbVlGlobal ,  $dbQuantidade , 0 , 0 );
	}

	mysqli_stmt_close($stmt);
	
	$stmt = NULL;
}

$cQuery = "select CD_ORGAO_CONCEDENTE , NM_ORGAO_CONCEDENTE , ";
$cQuery = $cQuery . "round(sum(VL_GLOBAL)/1000000,2) AS GLOBAL, ";
$cQuery = $cQuery . "count(*) as QTD from CONVENIOS ";
$cQuery = $cQuery . "where ID_MUNICIPIO_PROPONENTE = ? ";
$cQuery = $cQuery . "group by CD_ORGAO_CONCEDENTE , NM_ORGAO_CONCEDENTE ";
$cQuery = $cQuery . "order by 3 desc";

$stmt = mysqli_prepare($conn, $cQuery);
mysqli_stmt_bind_param($stmt,'s',$cMunID);
 
echo "<hr>";

if ( mysqli_stmt_execute ( $stmt ) )
{
	mysqli_stmt_bind_result ( $stmt , $dbIdOrgao , $dbNomeOrgao , $dbVlGlobal , $dbQuantidade );

	while (mysqli_stmt_fetch($stmt))
	{
		$nPos = array_search ( $dbIdOrgao , array_column($aResumo,0) );
		$aResumo[$nPos][4] += $dbVlGlobal ;
		$aResumo[$nPos][5] += $dbQuantidade ;
	}

	mysqli_stmt_close($stmt);
	
	$stmt = NULL;
}

function cmp_sort($a, $b)
{
    if ($a[4] == $b[4]) {
        return 0;
    }
    return ($a[4] > $b[4]) ? -1 : 1;
}

usort($aResumo, "cmp_sort");

for ( $nI = 0 ; $nI < count($aResumo) ; $nI++)
{
	echo '<tr>';

	echo '<td' . ( $nI % 2 == 0 ? ' id="tdodd"' : '' ) . '>';
	echo '<a href="javascript:Propostas(' . "'" . $aResumo[$nI][0] . "'" . ');"' . '>';
	echo ucfirst(mb_convert_case($aResumo[$nI][1],MB_CASE_LOWER));
	echo '</a>';
	echo '</td>';

	echo '<td' . ( $nI % 2 == 0 ? ' id="tdodd"' : '' ) . '>';
	echo $aResumo[$nI][3];
	echo '</td>';

	echo '<td' . ( $nI % 2 == 0 ? ' id="tdodd"' : '' ) . '>';
	echo $aResumo[$nI][2] === 0  ? '---' : $aResumo[$nI][2] . ' mi';
	echo '</td>';

	echo '<td' . ( $nI % 2 == 0 ? ' id="tdodd"' : '' ) . '>';
	echo $aResumo[$nI][5] === 0  ? '---' : $aResumo[$nI][5] ;
	echo '</td>';

	echo '<td' . ( $nI % 2 == 0 ? ' id="tdodd"' : '' ) . '>';
	echo $aResumo[$nI][4] === 0  ? '---' : $aResumo[$nI][4] . ' mi ';
	echo '</td>';

	echo '</tr>';
}

ob_flush();

?>


<tr><td colspan="5">
&nbsp;
</td></tr>
<tr><td colspan="5">
</td></tr>
<tr><td colspan="5">
<p>    
<input type="button" value="Voltar" onclick="javascript:Voltar()">
&nbsp;&nbsp;&nbsp;
<input type="button" value="Retornar ao Início" onclick="javascript:Home()">
</p>
</td></tr>
</table>
<br>
<?php require_once('footer.php'); ?>
</body>
<script>
</script>
</html>
<?php 
ob_end_flush(); 
?>
