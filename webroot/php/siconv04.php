﻿<%
Local nI,nJ
%>

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
<%=Capital(cMunic)%> / <%=cUF%><br>
<%=Capital(cOrgaoCCD)%><br>
Dados da Proposta <%=cIDPro%>
</h3>
<% 
/*
<p>
<img src="/images/BTNCurtir.png" alt="Curtir" style="cursor: pointer;" onclick="javascript:SetFeedback('C','<%=cIDPro%>');">&nbsp;
<img src="/images/BTNDescurtir.png" alt="Desaprovar" style="cursor: pointer;" onclick="javascript:SetFeedback('D','<%=cIDPro%>');">&nbsp;
<img src="/images/BTNSuspeito.png" alt="Suspeito" style="cursor: pointer;" onclick="javascript:SetFeedback('S','<%=cIDPro%>');">
<div id="demo"></div>
</p>
*/
%>
<div
  class="fb-like"
  style="margin: 0 auto; width: 100%;"
  data-share="true"
  data-width="50"
  data-show-faces="true">
</div>
<p><input type="button" value="Voltar" onclick="javascript:Voltar()"></p>
<table>
<% While !eof() %>
<% If !empty(QRY->TXMOD) %>
<tr>
<td>Modalidade do Convênio</td>
<td id="tdgray"><%=Capital(alltrim(cValToChar(QRY->TXMOD)))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->TXSIT) %>
<tr>
<td>Situação da Proposta</td>
<td id="tdgray">
<% If ("CANCELADO"$QRY->TXSIT)%>
<img src="/images/logocancel.png" title="Cancelado">&nbsp;
<% Endif %>
<% If ("APROVADO"$QRY->TXSIT)%>
<img src="/images/logook.png" title="Aprovado">&nbsp;
<% Endif %>
<% If ("REJEITADO"$QRY->TXSIT)%>
<img src="/images/logorejeitado.png" title="Rejeitado">&nbsp;
<% Endif %>
<% If ("ANÁLISE"$QRY->TXSIT)%>
<img src="/images/logoanalize.png" title="Em Análise">&nbsp;
<% Endif %>
<% If ("EXECUÇÃO"$QRY->TXSIT)%>
<img src="/images/logoemexec.png" title="Em Execução">&nbsp;
<% Endif %>
<%=Capital(alltrim(QRY->TXSIT))%>
</td>
</tr>
<% Endif %>
<% If !empty(QRY->TXSUBSIT) %>
<tr>
<td>Subsituação do Convênio</td>
<td id="tdgray"><%=Capital(alltrim(QRY->TXSUBSIT))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->TXOBJETOCN) %>
<tr>
<td>Objeto da Proposta</td>
<td id="tdgray"><%=Capital(alltrim(QRY->TXOBJETOCN))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->TXJUSTIFIC) %>
<tr>
<td>Justificativa da proposta </td>
<td id="tdgray"><%=Capital(alltrim(QRY->TXJUSTIFIC))%></td>
</tr>
<% Endif %>
<tr>
<td>Parecer da Proposta</td>
<td id="tdgray">
<% If QRY->INPARECERG == 'S' %>
<img title="Parecer do Administrador" src="/images/logoadm.png">&nbsp;
<% endif %>
<% If QRY->INPARECERJ == 'S' %>
<img title="Parecer Jurídico" src="/images/logojur.png">&nbsp;
<% endif %>
<% If QRY->INPARECERT == 'S' %>
<img title="Parecer Técnico" src="/images/logotec.png">&nbsp;
<% endif %>
</td>
</tr>
<% /* ------------------------------------------------------------------  */ %>
<tr><td id="tdcenter" colspan="2">Cronograma e Valores</td></tr>
<% If !empty(QRY->DTPRO) %>
<tr>
<td>Data da Proposta</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->DTPRO))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->DTINIVIG) %>
<tr>
<td>Início de Vigência</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->DTINIVIG))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->DTFIMVIG) %>
<tr>
<td>Final da Vigência</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->DTFIMVIG))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->DTASS) %>
<tr>
<td>Convênio assinado em</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->DTASS))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->DTPUB) %>
<tr>
<td>Convênio publicado em</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->DTPUB))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->VL_GLOBAL) %>
<tr>
<td>Valor Global</td>
<td id="tdgray">R$ <%=Transform(QRY->VL_GLOBAL,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>
<% If !empty(QRY->VL_REPASSE) %>
<tr>
<td>Valor Repasse</td>
<td id="tdgray">R$ <%=Transform(QRY->VL_REPASSE,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>
<% If !empty(QRY->VLREPEXERC) %>
<tr>
<td>Repasse no exercício atual</td>
<td id="tdgray">R$ <%=Transform(QRY->VLREPEXERC,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>
<% If !empty(QRY->VLCPTD) %>
<tr>
<td>Valor da Contra-partida</td>
<td id="tdgray">R$ <%=Transform(QRY->VLCPTD,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>
<% If !empty(QRY->VLCPTDFINA) %>
<tr>
<td>Valor da Contra-partida Financeira</td>
<td id="tdgray">R$ <%=Transform(QRY->VLCPTDFINA,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>
<% If !empty(QRY->VLCPTDBENS) %>
<tr>
<td>Valor da Contra-partida em Bens</td>
<td id="tdgray">R$ <%=Transform(QRY->VLCPTDBENS,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>
<% If !empty(QRY->NM_BANCO) %>
<tr>
<td>Nome do Banco</td>
<td id="tdgray"><%=Capital(alltrim(QRY->NM_BANCO))%></td>
</tr>
<% Endif %>
<% /* ------------------------------------------------------------------  */ %>
<%= H_PLANOAP() %>
<% /* ------------------------------------------------------------------  */ %>
<tr><td id="tdcenter" colspan="2">Dados do Proponente</td></tr>
<% If !empty(QRY->CDIDPPN) %>
<tr>
<td>Identificação do Proponente</td>
<td id="tdgray"><%=QRY->CDIDPPN+' - '+Capital(alltrim(QRY->NMPPN))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->TXQLFPPN) %>
<tr>
<td>Qualificação do Proponente</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->TXQLFPPN))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->TXESFADMPP) %>
<tr>
<td>Esfera Administrativa</td>
<td id="tdgray"><%=capital(alltrim(QRY->TXESFADMPP))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->NMMUNPPN) %>
<tr>
<td>Município</td>
<td id="tdgray"><%=alltrim(QRY->NMMUNPPN)%> / <%=QRY->UFPPN%></td>
</tr>
<% Endif %>
<% If !empty(QRY->CDRPNPPN) %>
<tr>
<td>Responsável pelo Proponente</td>
<td id="tdgray"><%=QRY->CDRPNPPN+' - '+Capital(alltrim(QRY->NMRPNPPN))%></td>
</tr>
<% Endif %>
<% /* ------------------------------------------------------------------  */ %>
<tr><td id="tdcenter" colspan="2">Detalhamento da Proposta</td></tr>
<% IF !empty(QRY->ANOPRO) %>
<tr>
<td>Ano da Proposta</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->ANOPRO))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->NRPRO) %>
<tr>
<td>Número da Proposta</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->NRPRO  ))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->ANOCNV) %>
<tr>
<td>Ano do Convênio</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->ANOCNV ))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->NRCNV) %>
<tr>
<td>Número do Convênio</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->NRCNV  ))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->IDPRO) %>
<tr>
<td>Código identificador da Proposta</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->IDPRO))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->IDCNV) %>
<tr>
<td>Código Identificador do Convênio</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->IDCNV))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->IDPROPPGM) %>
<tr>
<td>Código de Identificação da Proposta/Programa</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->IDPROPPGM ))%></td>
</tr>
<% endif %>

<% /* ------------------------------------------------------------------  */ %>
<tr><td id="tdcenter" colspan="2">Detalhamento do Programa / Convênio</td></tr>

<% If !empty(QRY->CDPGM) %>
<tr>
<td>Código do Programa</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->CDPGM))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->CDACTPGM) %>
<tr>
<td>Código da Ação do Programa</td>
<td id="tdgray"><%=alltrim(cValToChar(QRY->CDACTPGM))%></td>
</tr>
<tr>
<% Endif %>
<% If !empty(QRY->NMPGM) %>
<td>Nome do Programa</td>
<td id="tdgray"><%=Capital(alltrim(QRY->NMPGM))%></td>
</tr>
<% Endif %>

<% If !empty(QRYPROG->TXDESCRICA) %>
<tr>
<td>Descrição do Programa</td>
<td id="tdgray"><%=Capital(alltrim(QRYPROG->TXDESCRICA))%></td>
</tr>
<% Endif %>
<tr>
<td>Propostas realizadas</td>
<td id="tdgray"><%=cValToChar(QRYPROG->QTPRO)%></td>
</tr>
<tr>
<td>Convênios realizados</td>
<td id="tdgray"><%=cValToChar(QRYPROG->QTCNV)%></td>
</tr>

<% If !empty(QRY->CDORGSUP) %>
<tr>
<td>Órgão Superior da Proposta</td>
<td id="tdgray"><%=alltrim(QRY->CDORGSUP)+' - '+Capital(Alltrim(QRY->NMORGSUP))%></td>
</tr>
<% Endif %>
<% If !empty(QRY->CDORGCCD) %>
<tr>
<td>Órgão Concedente</td>
<td id="tdgray"><%=alltrim(QRY->CDORGCCD)+' - '+Capital(Alltrim(QRY->NMORGCCD))%></td>
</tr>
<% Endif %>   
<% If !empty(QRY->CDRPNCCD) %>
<tr>
<td>Responsável pelo Concedente</td>
<td id="tdgray"><%=QRY->CDRPNCCD+' - '+Capital(alltrim(QRY->NMRPNCCD))%></td>
</tr>
<% Endif %>
<tr><td colspan="2">&nbsp;</td></tr>
<% DbSkip() %>
<% Enddo %>
</table>
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


