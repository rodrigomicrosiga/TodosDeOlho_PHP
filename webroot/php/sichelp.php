﻿<!DOCTYPE html>
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
<p id="phelp">&nbsp;&nbsp;&nbsp;A ferramenta <b><i>[Todos de Olho]</i></b> foi desenvolvida para tornar acessível 
a todos os cidadãos informações mais detalhadas sobre a execução de políticas públicas, realizadas 
por meio de transferências de recursos federais, facilitando o entendimento dos dados a elas 
relacionados e a fiscalização dessa execução de modo colaborativo entre Estado e sociedade.</p>
<p id="phelp">&nbsp;&nbsp;&nbsp;Para iniciar sua busca, clique no botão <b><i>[Consultar Propostas]</i></b>. 
A consulta segue uma sequência de informações que deve ser fornecida para refinar os resultados. 
Inicialmente informamos o Estado (ou unidade da Federação) para o qual desejamos verificar quais os convênios 
firmados para o Estado escolhido. Na próxima etapa, você deve escolher o município do estado escolhido a ser pesquisado. 
Para realizar pesquisas de municípios próximos ao seu local atual, basta clicar no 
botão <b><i>[Use sua localização]</i></b> e escolher o município desejado.</p> 
<p id="phelp">&nbsp;&nbsp;&nbsp;Cada etapa da consulta possui telas simples e controles intuitivos, que permitem voltar 
e refazer as escolhas anteriores, ou prosseguir com o refinamento da busca. Após a escolha do município, é trazida uma lista
deparada pelo Órgão Governamental ou Ministério que está concedendo o Convênio, informando a quantidade de propostas
realizadas e convênios firmados para cada órgão, bem como os valores totais propostos e obtidos com os convênios.</p>
<p id="phelp">Após escolher um órgão para consultar, serão apresentadas todas as propostas e convênios firmados com o órgão 
em questão para aquele minucípio, contendo apenas algumas informações da proposta, mostrando primeiro as propostas
recentemente enviadas. Ao escolher uma proposta ou convênio para detalhamento, serão mostradas as informações completas
sobre o item escolhido.</p>
<p>
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
<p>&nbsp;</p>
<p><input type="button" value="Voltar" onclick="javascript:Voltar()"></p>
<br>
<br>
<?php require_once('footer.php'); ?>
</body>
</html>
