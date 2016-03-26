<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php require_once('headmetas.php'); ?>
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
#phelp {
  text-align:justify;
  font-size: 100%;
}
input {
    padding:5px 15px; 
    background:#ccc; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
    font-size: 130%;
}
</style>
<script type="text/javascript">
function Voltar()
{
	window.open("/","_self");
}
</script>
</head>
<body>
<?php require_once('ptitle.php'); ?>
<p><input type="button" value="Voltar" onclick="javascript:Voltar()"></p>
<h3>Ajuda</h3>
<p id="phelp">&nbsp;&nbsp;&nbsp;A ferramenta <b><i>[Todos de Olho]</i></b> foi desenvolvida para tornar acess�vel 
a todos os cidad�os informa��es mais detalhadas sobre a execu��o de pol�ticas p�blicas, realizadas 
por meio de transfer�ncias de recursos federais, facilitando o entendimento dos dados a elas 
relacionados e a fiscaliza��o dessa execu��o de modo colaborativo entre Estado e sociedade.</p>
<p id="phelp">&nbsp;&nbsp;&nbsp;Para iniciar sua busca, clique no bot�o <b><i>[Consultar Propostas]</i></b>. 
A consulta segue uma sequ�ncia de informa��es que deve ser fornecida para refinar os resultados. 
Inicialmente informamos o Estado (ou unidade da Federa��o) para o qual desejamos verificar quais os conv�nios 
firmados para o Estado escolhido. Na pr�xima etapa, voc� deve escolher o munic�pio do estado escolhido a ser pesquisado. 
Para realizar pesquisas de munic�pios pr�ximos ao seu local atual, basta clicar no 
bot�o <b><i>[Use sua localiza��o]</i></b> e escolher o munic�pio desejado.</p> 
<p id="phelp">&nbsp;&nbsp;&nbsp;Cada etapa da consulta possui telas simples e controles intuitivos, que permitem voltar 
e refazer as escolhas anteriores, ou prosseguir com o refinamento da busca. Ap�s a escolha do munic�pio, � trazida uma lista
deparada pelo �rg�o Governamental ou Minist�rio que est� concedendo o Conv�nio, informando a quantidade de propostas
realizadas e conv�nios firmados para cada �rg�o, bem como os valores totais propostos e obtidos com os conv�nios.</p>
<p id="phelp">Ap�s escolher um �rg�o para consultar, ser�o apresentadas todas as propostas e conv�nios firmados com o �rg�o 
em quest�o para aquele minuc�pio, contendo apenas algumas informa��es da proposta, mostrando primeiro as propostas
recentemente enviadas. Ao escolher uma proposta ou conv�nio para detalhamento, ser�o mostradas as informa��es completas
sobre o item escolhido.</p>
<p>
<p id="phelp">&nbsp;&nbsp;&nbsp;Para tornar a visualiza��o das informa��es mais intuitiva e din�mica, foram utilizados alguns 
identificadores visuais para as situa��es e andamento das propostas e conv�nios, vide a seguir:</p>
<table>
<tr>
<td><img src="/images/LogoCancel.png" title="Cancelado"></td>
<td>A proposta foi cancelada.</td>
</tr>
<tr>
<td><img src="/images/LogoOK.png" title="Aprovado"></td>
<td>Uma parte ou a �ntegra da proposta foi aprovada.</td>
</tr>
<tr>
<td><img src="/images/LogoRejeitado.png" title="Rejeitado"></td>
<td>A proposta ou a presta��o de contas foi rejeitada.</td>
</tr>
<tr>
<td><img src="/images/LogoAnalize.png" title="Em An�lise"></td>
<td>A proposta ou conv�nio se encontra em uma etapa de an�lise.</td>
</tr>
<tr>
<td><img src="/images/LogoEmExec.png" title="Em Execu��o"></td>
<td>O conv�nio se encontra em execu��o.</td>
</tr>
<tr>
<td><img src="/images/RedHourGlass.png" title="Vig�ncia da Proposta Expirada"></td>
<td>A proposta ou conv�nio possuem uma data final de vig�ncia vencida.</td>
</tr>
<tr>
<td><img src="/images/GreenFlag.png" title="Vig�ncia da Proposta em Dia"></td>
<td>A data final de vig�ncia da proposta ou conv�nio ainda n�o expirou.</td>
</tr>
<tr>
<td><img src="/images/LogoAdm.png" title="Parecer do Administrador"></td>
<td>A proposta possui um laudo ou parecer do Gestor / Administrador.</td>
</tr>
<tr>
<td><img title="Parecer Jur�dico" src="/images/LogoJur.png"></td>
<td>A proposta possui um parecer Jur�dico anexado.</td>
</tr>
<tr>
<td><img title="Parecer T�cnico" src="/images/LogoTec.png"></td>
<td>A proposta possui um parecer t�cnico anexado.</td>
</tr>
</table>
<p>&nbsp;</p>
<p><input type="button" value="Voltar" onclick="javascript:Voltar()"></p>
<br>
<br>
<?php require_once('footer.php'); ?>
</body>
</html>
