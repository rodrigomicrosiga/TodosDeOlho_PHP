<html lang="pt-BR">
<head>
<?php 
require_once('headmetas.php');
require_once('dbconn.php'); 

ob_start();

$cIDMun = filter_input(INPUT_GET, 'MUN');

if ( is_null($cIDMun) ) 
{
	$cErrorMSG = "Município não informado.";
	$cErrorHLP = 'A busca por propostas e convênios não recebeu corretamente o município a ser pesquisado. ' . 
					'Retorne para a tela anterior e tente novamente, ou volte ao início do site.' ;
    require 'sicerror.php';
	return;	
}

$cCodCCD = filter_input(INPUT_GET, 'CCD');

if (  is_null($cCodCCD) ) 
{
	$cErrorMSG = "òrgão não informado.";
	$cErrorHLP = 'A busca por propostas e convênios não recebeu corretamente o órgão concedente a ser pesquisado. ' . 
					'Retorne para a tela anterior e tente novamente, ou volte ao início do site.' ;
    require 'sicerror.php';
	return;	
}

$conn = MySQLConnect();

$stmt = mysqli_prepare($conn, "Select CODIGO,NOME,UF from MUNICIPIOS where CODIGO = ?");
mysqli_stmt_bind_param($stmt,'s',$cIDMun);

if ( mysqli_stmt_execute ( $stmt ) )
{
	mysqli_stmt_bind_result ( $stmt , $dbCODIGO , $dbNOME , $dbUF );
	if (mysqli_stmt_fetch($stmt))
    {
		$cMunic = ucfirst(mb_convert_case($dbNOME,MB_CASE_LOWER,"UTF-8"));
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

$stmt = mysqli_prepare($conn, "select NOME from ORGAO where ID = ?");
mysqli_stmt_bind_param($stmt,'i',$cCodCCD);

if ( mysqli_stmt_execute ( $stmt ) )
{
	mysqli_stmt_bind_result ( $stmt , $dbNOMECCD );
	if (mysqli_stmt_fetch($stmt))
    {
		$cOrgaoCCD = ucfirst(mb_convert_case($dbNOMECCD,MB_CASE_LOWER,"UTF-8"));
    }
	else
	{
		$cErrorMSG = "Órgão não encontrado.";
		$cErrorHLP = 'A busca pelo código não identificou o órgão concedente informado. ' . 
					'Retorne para a tela anterior e tente novamente, ou volte ao início do site.' ;
		require 'sicerror.php';
		return;	
	}

	mysqli_stmt_close($stmt);
	
	$stmt = NULL;
}

// Numero da pagina de pesquisa'	
$nPage = filter_input(INPUT_GET, 'PAGE');
if (  is_null($nPage) ) 
	$nPage = 1;

// ordem de visualização de dados
$cOrd = filter_input(INPUT_GET, 'ORD');
if (  is_null($cOrd) ) 
	$cOrd = 'D';

$nPageSize = 10;

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

table, td {
  text-align:left;
  font-size: 100%;
}

#normalbutton {
  text-align:center;
  font-size: 100%;
}

#tdcenter {
  text-align:center;
  font-size: 100%;
}

#tdgray {
  background:#eee; 
}

a, select, input {
    padding:5px 15px; 
    background:#ccc; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
    font-size: 130%;
    vertical-align: top;
}
#phelp {
  text-align:justify;
  font-size: 100%;
}
</style>
<script type = 'text/javascript'>
function Proposta(cCod)
{   
	window.open("/php/siconv04.php?IDPRO="+cCod,"_self");
}
function Convenio(cCod)
{
	window.open("/php/siconv05.php?IDCONV="+cCod,"_self");
}
function Voltar()
{
	window.open("/php/siconv02.php?MUN=<?php echo $cIDMun?>","_self");
}
function Home()
{
	window.open("/","_self");
}
function Pagina(nPage,cOrdem)
{
	window.open("/php/siconv03.php?MUN=<?php echo $cIDMun?>&CCD=<?php echo $cCodCCD?>&PAGE="+nPage+"&ORD="+cOrdem,"_self");
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
<body onload="javascript:HideHelp()">
<?php require_once('ptitle.php'); ?>
<h3><?php echo $cMunic ?> / <?php echo $cUF ?><br><?php echo $cOrgaoCCD?><br>( Página <?php echo $nPage ?> )</h3>

<div id="_HELP" style="display: none">
<hr>
<p>Esta consulta mostra as propostas e convênios realizados para o município em questão, 
mostrando apenas as informações relacionadas a <b><?php $cOrgaoCCD ?></b>. Para obter maiores 
detalhes sobre cada Proposta ou Convênio celebrado, basta clicar no botão de Consulta 
correspondente.</p>
<p id="phelp">Após escolher um órgão para consultar, serão apresentadas todas as propostas e convênios firmados com o órgão 
em questão para aquele minucípio, contendo apenas algumas informações da proposta, mostrando primeiro as propostas
recentemente enviadas. Ao escolher uma proposta ou convênio para detalhamento, serão mostradas as informações completas
sobre o item escolhido. </p>
<p id="phelp">&nbsp;&nbsp;&nbsp;Para tornar a visualização das informações mais intuitiva e dinâmica, foram utilizados alguns 
identificadores visuais para as situações e andamento das propostas e convênios, vide a seguir:</p>
<table>
<tr>
<td><img src="/images/logocancel.png" title="Cancelado"></td>
<td>A proposta foi cancelada.</td>
</tr>
<tr>
<td><img src="/images/logook.png" title="Aprovado"></td>
<td>Uma parte ou a íntegra da proposta foi aprovada.</td>
</tr>
<tr>
<td><img src="/images/logorejeitado.png" title="Rejeitado"></td>
<td>A proposta ou a prestação de contas foi rejeitada.</td>
</tr>
<tr>
<td><img src="/images/logoanalize.png" title="Em Análise"></td>
<td>A proposta ou convênio se encontra em uma etapa de análise.</td>
</tr>
<tr>
<td><img src="/images/logoemexec.png" title="Em Execução"></td>
<td>O convênio se encontra em execução.</td>
</tr>
<tr>
<td><img src="/images/redhourglass.png" title="Vigência da Proposta Expirada"></td>
<td>A proposta ou convênio possuem uma data final de vigência vencida.</td>
</tr>
<tr>
<td><img src="/images/greenflag.png" title="Vigência da Proposta em Dia"></td>
<td>A data final de vigência da proposta ou convênio ainda não expirou.</td>
</tr>
<tr>
<td><img src="/images/logoadm.png" title="Parecer do Administrador"></td>
<td>A proposta possui um laudo ou parecer do Gestor / Administrador.</td>
</tr>
<tr>
<td><img title="Parecer Jurídico" src="/images/logojur.png"></td>
<td>A proposta possui um parecer Jurídico anexado.</td>
</tr>
<tr>
<td><img title="Parecer Técnico" src="/images/logotec.png"></td>
<td>A proposta possui um parecer técnico anexado.</td>
</tr>
</table>
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
<input type="button" value="Voltar" onclick="javascript:Voltar()">
</p>
<?php 
echo '<p>';
If ($cOrd == 'V')
	echo '<input type="button" value="Ordenar por Data" onclick="javascript:Pagina('.$nPage.',\'D\')";">';
else
	echo '<input type="button" value="Ordenar por Valor" onclick="javascript:Pagina('.$nPage.',\'V\')";">';
echo '</p>';

If ( $nPage > 1 )
{
	echo '<p>';
	echo '<input type="button" value="Página Anterior" onclick="javascript:Pagina(' . ($nPage-1) .',\''.$cOrd.'\');">';
	echo '</p>';
}

ob_flush();

// Agora sim busca pelas propostas e convenios do municipio

If ( $cOrd == 'D' )
{
	// Data de proposta
	$cOrderBy = 'DT_PROPOSTA desc';
}
Else If ( $cOrd == 'V' )
{
	// Valor Gobal
	$cOrderBy = 'VL_GLOBAL desc';
}
Else
{
	// QQer outra coisa, vai data mesmo
	$cOrderBy = 'DT_PROPOSTA desc';
}

require_once('dbpagequery.php');
	
// Monga uma Query para paginação de dados

$cQuery = U_PageQry(
		"ID_CONVENIO,".
		"ID_PROPOSTA,".
		"TX_SITUACAO,".
		"DATE_FORMAT(DT_PROPOSTA,'%d/%m/%Y') as DT_PROPOSTA,".
		"DATE_FORMAT(DT_FIM_VIGENCIA,'%d/%m/%Y') as DT_FIM_VIGENCIA,".
		"IN_PARECER_GESTOR_SN,".
		"IN_PARECER_JURIDICO_SN,".
		"IN_PARECER_TECNICO_SN,".
		"VL_GLOBAL,".
		"CD_IDENTIF_PROPONENTE,".
		"NM_PROPONENTE,".
		"TX_OBJETO_CONVENIO", 
	"PROPOSTAS", 
	"ID_MUNICIPIO_PROPONENTE = $cIDMun and CD_ORGAO_CONCEDENTE = $cCodCCD",
	$cOrderBy,
	$nPage,
	$nPageSize);

$stmt = mysqli_prepare($conn, $cQuery);

if ( $stmt === false )
{
	die('MySQL Error: ' . mysqli_error($conn));
}

if ( mysqli_stmt_execute ( $stmt ) )
{
	echo "<table>";

	$nRows = 0;
	$result = mysqli_stmt_get_result($stmt);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$nRows++;
		echo '<tr><td colspan="2">';
		if ( $row['ID_CONVENIO'] > 0 )
		{
			echo '<input id="normalbutton" type="button" value="Consultar Convênio ' . $row['ID_CONVENIO'] . '" ' . 
				 'onclick="javascript:Convenio(\'' . $row['ID_CONVENIO'] . '\')">';
		}
		else
		{
			echo '<input id="normalbutton" type="button" value="Consultar Proposta ' . $row['ID_PROPOSTA'] . '" ' . 
				 'onclick="javascript:Proposta(\'' . $row['ID_PROPOSTA'] . '\')">';
		}
			
		echo '</tr>';

		$nCol = 0;
		foreach( $row as $rKey => $rValue)
		{
			$nCol++;
			if ( $nCol <= 2)
				continue;
			echo '<tr>';
			echo '<td>'.$rKey.'</td>';
			if ( substr($rKey,0,3) === 'VL_' )
				echo '<td> R$ ' . number_format ( $rValue , 2 , ',' , '.') .'</td>';
			else if ( substr($rKey,0,3) === 'NM_' )
				echo '<td>'. ucwords(mb_convert_case($rValue,MB_CASE_LOWER,"UTF-8")) .'</td>';
			else if ( substr($rKey,0,3) === 'TX_' )
				echo '<td>'. ucfirst(mb_convert_case($rValue,MB_CASE_LOWER,"UTF-8")) .'</td>';
			else
				echo '<td>'.$rValue.'</td>';
			echo '</tr>';
		}
		echo '<tr><td colspan="2">&nbsp;</td></tr>';
	}

	echo "</table>";
}
else
{
	echo "DEU MERDA<br>";
}

ob_flush();

If ( $nPage > 1 )
	echo '<p><input type="button" value="Página Anterior" onclick="javascript:Pagina('. ($nPage-1) . ',\'' . $cOrd. '\')"></p>';
If ( $nRows >= $nPageSize )
	echo '<p><input type="button" value="Mais resultados" onclick="javascript:Pagina('. ($nPage+1) . ',\'' . $cOrd. '\')"></p>;';
?>
<p>
<input type="button" value="Voltar" onclick="javascript:Voltar()">
&nbsp;&nbsp;&nbsp;
<input type="button" value="Retornar ao Início" onclick="javascript:Home()">
</p>
<br>
<?php require_once('footer.php'); ?>
</body>
<script>
</script>
</html>
<?php 
ob_end_flush(); 
?>
