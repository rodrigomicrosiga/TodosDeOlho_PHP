<html lang="pt-BR">
<head>
<?php 
require_once('headmetas.php');
require_once('dbconn.php'); 

ob_start();

$cIDPro = filter_input(INPUT_GET, 'IDPRO');

if ( is_null($cIDPro) ) 
{
	$cErrorMSG = "Proposta não informada.";
	$cErrorHLP = 'A busca não recebeu corretamente o código da Proposta a ser pesquisada. ' . 
					'Retorne para a tela anterior e tente novamente, ou volte ao início do site.' ;
    require 'sicerror.php';
	return;	
}

$cIDConv = filter_input(INPUT_GET, 'IDCONV');

$cMunic = '';
$cUF = '';
$cOrgaoCCD = '';

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
  background:#ccc; 
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
}
</style>
<script type = 'text/javascript'>
function Voltar() {
    // TODO 
    window.history.back();
}
function Home()
{
	window.open("/","_self");
}
function SetFeedback(cAction,cProp) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("demo").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("POST", "/php/setfeed.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send('ACT='+cAction+'&IDPRO='+cProp);
}
</script>
</head>
<body>
<?php 
require_once('fbsdk.php'); 
require_once('ptitle.php'); 
?>
<h3>
<?php echo $cMunic; ?> / <?php echo $cUF; ?><br>
<?php echo $cOrgaoCCD; ?><br>
Dados da Proposta <?php echo $cIDPro; ?>
</h3>
<div
  class="fb-like"
  style="margin: 0 auto; width: 100%;"
  data-share="true"
  data-width="50"
  data-show-faces="true">
</div>
<p><input type="button" value="Voltar" onclick="javascript:Voltar()"></p>

<?php

$conn = MySQLConnect();

// ===================================================================================
$stmt = mysqli_prepare($conn, "Select * from PROPOSTAS where ID_PROPOSTA = ?");
mysqli_stmt_bind_param($stmt,'i',$cIDPro);

if ( mysqli_stmt_execute ( $stmt ) )
{
	echo "<table>";

	$result = mysqli_stmt_get_result($stmt);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		
		foreach( $row as $rKey => $rValue)
		{
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

	mysqli_stmt_close($stmt);
	$stmt = NULL;
	ob_flush();
}


// ===================================================================================
$stmt = mysqli_prepare($conn, "Select * from CRONOGRAMA_DESEMBOLSO where ID_PROPOSTA = ?");
mysqli_stmt_bind_param($stmt,'i',$cIDPro);

if ( mysqli_stmt_execute ( $stmt ) )
{
	echo '<table>';
	echo '<tr><td colspan="2"><p>Cronograma de Desembolso</p></td></tr>';

	$result = mysqli_stmt_get_result($stmt);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		
		foreach( $row as $rKey => $rValue)
		{
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
	mysqli_stmt_close($stmt);
	$stmt = NULL;
	ob_flush();
}

// ===================================================================================
$stmt = mysqli_prepare($conn, "Select * from CRONOGRAMA_FISICO where ID_PROPOSTA = ?");
mysqli_stmt_bind_param($stmt,'i',$cIDPro);

if ( mysqli_stmt_execute ( $stmt ) )
{
	echo "<table>";
	echo '<tr><td colspan="2"><p>Cronograma Físico</p></td></tr>';

	$result = mysqli_stmt_get_result($stmt);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		
		foreach( $row as $rKey => $rValue)
		{
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
	mysqli_stmt_close($stmt);
	$stmt = NULL;
	ob_flush();
}

// ===================================================================================
$stmt = mysqli_prepare($conn, "Select * from EMPENHOS where ID_PROP = ?");
mysqli_stmt_bind_param($stmt,'i',$cIDPro);

if ( mysqli_stmt_execute ( $stmt ) )
{
	echo "<table>";
	echo '<tr><td colspan="2"><p>Empenhos</p></td></tr>';

	$result = mysqli_stmt_get_result($stmt);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		
		foreach( $row as $rKey => $rValue)
		{
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
	mysqli_stmt_close($stmt);
	$stmt = NULL;
	ob_flush();
}

// ===================================================================================
$stmt = mysqli_prepare($conn, "Select * from EXECUCAOFIN where ID_PROP = ?");
mysqli_stmt_bind_param($stmt,'i',$cIDPro);

if ( mysqli_stmt_execute ( $stmt ) )
{
	echo "<table>";
	echo '<tr><td colspan="2"><p>Execução Financeira</p></td></tr>';

	$result = mysqli_stmt_get_result($stmt);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		
		foreach( $row as $rKey => $rValue)
		{
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
	mysqli_stmt_close($stmt);
	$stmt = NULL;
	ob_flush();
}

// ===================================================================================
$stmt = mysqli_prepare($conn, "Select * from PLANOAP where ID_PROPOSTA = ?");
mysqli_stmt_bind_param($stmt,'i',$cIDPro);

if ( mysqli_stmt_execute ( $stmt ) )
{
	echo "<table>";
	echo '<tr><td colspan="2"><p>Plano de Aplicação</p></td></tr>';

	$result = mysqli_stmt_get_result($stmt);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		
		foreach( $row as $rKey => $rValue)
		{
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
	mysqli_stmt_close($stmt);
	$stmt = NULL;
	ob_flush();
}

// ===================================================================================
$stmt = mysqli_prepare($conn, "Select * from PROPOSTAS_BANCOS where ID_PROPOSTA = ?");
mysqli_stmt_bind_param($stmt,'i',$cIDPro);

if ( mysqli_stmt_execute ( $stmt ) )
{
	echo "<table>";
	echo '<tr><td colspan="2"><p>Dados Bancários</p></td></tr>';

	$result = mysqli_stmt_get_result($stmt);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		
		foreach( $row as $rKey => $rValue)
		{
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
	mysqli_stmt_close($stmt);
	$stmt = NULL;

	ob_flush();

}

// ===================================================================================
$stmt = mysqli_prepare($conn, "Select * from PROPOSTAS_BENEFESPECIF where ID_PROPOSTA = ?");
mysqli_stmt_bind_param($stmt,'i',$cIDPro);

if ( mysqli_stmt_execute ( $stmt ) )
{
	echo "<table>";
	echo '<tr><td colspan="2"><p>Beneficiário Específico</p></td></tr>';

	$result = mysqli_stmt_get_result($stmt);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		
		foreach( $row as $rKey => $rValue)
		{
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
	mysqli_stmt_close($stmt);
	$stmt = NULL;
	ob_flush();
}

// ===================================================================================
$stmt = mysqli_prepare($conn, "Select * from PROPOSTAS_EMENDAP where ID_PROPOSTA = ?");
mysqli_stmt_bind_param($stmt,'i',$cIDPro);

if ( mysqli_stmt_execute ( $stmt ) )
{
	echo "<table>";
	echo '<tr><td colspan="2"><p>Emenda Parlamentar</p></td></tr>';

	$result = mysqli_stmt_get_result($stmt);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		
		foreach( $row as $rKey => $rValue)
		{
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
	mysqli_stmt_close($stmt);
	$stmt = NULL;
	ob_flush();
}


// ===================================================================================
$stmt = mysqli_prepare($conn, "Select * from PROPOSTAS_PROPONENTE where ID_PROPOSTA = ?");
mysqli_stmt_bind_param($stmt,'i',$cIDPro);

if ( mysqli_stmt_execute ( $stmt ) )
{
	echo "<table>";
	echo '<tr><td colspan="2"><p>Dados do Proponente</p></td></tr>';

	$result = mysqli_stmt_get_result($stmt);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		
		foreach( $row as $rKey => $rValue)
		{
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
	mysqli_stmt_close($stmt);
	$stmt = NULL;
	ob_flush();
}

// ===================================================================================
$stmt = mysqli_prepare($conn, "Select * from PROPOSTAS_RESPONSAVEIS where ID_PROPOSTA = ?");
mysqli_stmt_bind_param($stmt,'i',$cIDPro);

if ( mysqli_stmt_execute ( $stmt ) )
{
	echo "<table>";
	echo '<tr><td colspan="2"><p>Dados dos Responsáveis</p></td></tr>';

	$result = mysqli_stmt_get_result($stmt);
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		
		foreach( $row as $rKey => $rValue)
		{
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
	mysqli_stmt_close($stmt);
	$stmt = NULL;
	ob_flush();
}

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
