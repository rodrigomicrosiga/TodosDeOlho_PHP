<%
Local nI,nJ
// Detalhamento de Convenio pelo ID 
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
  xhttp.open("POST", "SetFeed.php", true);
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
Dados do Conv�nio <%=cIDCNV%>
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
<% /* While !eof() */ %>
<% If !empty(QRYCONV->TXMOD) %>
<tr>
<td>Modalidade do Conv�nio</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->TXMOD  ))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->TXSIT) %>
<tr>
<td>Situa��o da Proposta</td>
<td id="tdgray">
<% If ("CANCELADO"$QRYCONV->TXSIT)%>
<img src="/images/logocancel.png" title="Cancelado">&nbsp;
<% Endif %>
<% If ("APROVADO"$QRYCONV->TXSIT)%>
<img src="/images/logook.png" title="Aprovado">&nbsp;
<% Endif %>
<% If ("REJEITADO"$QRYCONV->TXSIT)%>
<img src="/images/logorejeitado.png" title="Rejeitado">&nbsp;
<% Endif %>
<% If ("AN�LISE"$QRYCONV->TXSIT)%>
<img src="/images/logoanalize.png" title="Em An�lise">&nbsp;
<% Endif %>
<% If ("EXECU��O"$QRYCONV->TXSIT)%>
<img src="/images/logoemexec.png" title="Em Execu��o">&nbsp;
<% Endif %>
<%=Capital(alltrim(QRYCONV->TXSIT))%>
</td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->TXSUBSIT) %>
<tr>
<td>Subsitua��o do Conv�nio</td>
<td id="tdgray"><%=Capital(alltrim(QRYCONV->TXSUBSIT))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->TXOBJETOCN) %>
<tr>
<td>Objeto da Proposta</td>
<td id="tdgray"><%=Capital(alltrim(QRYCONV->TXOBJETOCN))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->TXJUSTIFIC) %>
<tr>
<td>Justificativa da proposta </td>
<td id="tdgray"><%=Capital(alltrim(QRYCONV->TXJUSTIFIC))%></td>
</tr>
<% Endif %>
<tr>
<td>Parecer da Proposta</td>
<td id="tdgray">
<% If QRYPROP->INPARECERG == 'S' %>
<img title="Parecer do Administrador" src="/images/logoadm.png">&nbsp;
<% endif %>
<% If QRYPROP->INPARECERJ == 'S' %>
<img title="Parecer Jur�dico" src="/images/logojur.png">&nbsp;
<% endif %>
<% If QRYPROP->INPARECERT == 'S' %>
<img title="Parecer T�cnico" src="/images/logotec.png">&nbsp;
<% endif %>
</td>
</tr>
<% If !empty(QRYCONV->TXSITPUB) %>
<tr>
<td>Situa��o da Publica��o</td>
<td id="tdgray"><%=Capital(QRYCONV->TXSITPUB)%></td>
</tr>
<% Endif %>
<% /* ------------------------------------------------------------------  */ %>
<tr><td id="tdcenter" colspan="2">Cronograma e Valores</td></tr>
<% If !empty(QRYPROP->DTPRO) %>
<tr>
<td>Data da Proposta</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYPROP->DTPRO))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->DTINIVIG) %>
<tr>
<td>In�cio de Vig�ncia</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->DTINIVIG))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->DTFIMVIG) %>
<tr>
<td>Final da Vig�ncia</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->DTFIMVIG))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->DTASSCNV) %>
<tr>
<td>Conv�nio assinado em</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->DTASSCNV))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->DTPUB) %>
<tr>
<td>Conv�nio publicado em</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->DTPUB))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->VL_GLOBAL) %>
<tr>
<td>Valor Global</td>
<td id="tdgray">R$ <%=Transform(QRYCONV->VL_GLOBAL,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->VL_REPASSE) %>
<tr>
<td>Valor Repasse</td>
<td id="tdgray">R$ <%=Transform(QRYCONV->VL_REPASSE,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>
<% If !empty(QRYPROP->VLREPEXERC) %>
<tr>
<td>Repasse no exerc�cio atual</td>
<td id="tdgray">R$ <%=Transform(QRYPROP->VLREPEXERC,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->VLCPTDTOTA) %>
<tr>
<td>Valor da Contra-partida</td>
<td id="tdgray">R$ <%=Transform(QRYCONV->VLCPTDTOTA,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->VLCPTDFINA) %>
<tr>
<td>Contra-partida Financeira</td>
<td id="tdgray">R$ <%=Transform(QRYCONV->VLCPTDFINA,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->VLCPTDBENS) %>
<tr>
<td>Contra-partida em Bens</td>
<td id="tdgray">R$ <%=Transform(QRYCONV->VLCPTDBENS,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>

<% If !empty(QRYCONV->VLEMPENHAD) %>
<tr>
<td>Valor Empenhado</td>
<td id="tdgray">R$ <%=Transform(QRYCONV->VLEMPENHAD,"@E 999,999,999,999.99")%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->DTULTIMOEP) %>
<tr>
<td>�timo Empenho em </td>
<td id="tdgray"><%=dtoc(QRYCONV->DTULTIMOEP)%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->DTULTIMOPG) %>
<tr>
<td>�timo Pagamento em </td>
<td id="tdgray"><%=dtoc(QRYCONV->DTULTIMOPG)%></td>
</tr>
<% Endif %>
<% If !empty(QRYPROP->NM_BANCO) %>
<tr>
<td>Nome do Banco</td>
<td id="tdgray"><%=Capital(alltrim(cValToChar(QRYPROP->NM_BANCO)))%></td>
</tr>
<% Endif %>
<% /* ------------------------------------------------------------------  */ %>
<%= H_PLANOAP() %>
<% /* ------------------------------------------------------------------  */ %>
<tr><td id="tdcenter" colspan="2">Dados do Proponente</td></tr>
<% If !empty(QRYCONV->CDIDPPN) %>
<tr>
<td>Identifica��o do Proponente</td>
<td id="tdgray"><%=QRYCONV->CDIDPPN+' - '+Capital(alltrim(QRYCONV->NMPPN))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->TXQLFPPN) %>
<tr>
<td>Qualifica��o do Proponente</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->TXQLFPPN))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->TXESFADMPP) %>
<tr>
<td>Esfera Administrativa</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->TXESFADMPP))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->NMMUNPPN) %>
<tr>
<td>Munic�pio / UF</td>
<td id="tdgray"><%=alltrim(QRYCONV->NMMUNPPN)%> / <%=QRYCONV->UFPPN%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->CDRPNPPN) %>
<tr>
<td>Respons�vel pelo Proponente</td>
<td id="tdgray"><%=QRYCONV->CDRPNPPN+' - '+Capital(alltrim(QRYCONV->NMRPNPPN))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->TXCARRPNPP) %>
<tr>
<td>Cargo do Respons�vel</td>
<td id="tdgray"><%=Capital(alltrim(QRYCONV->TXCARRPNPP))%></td>
</tr>
<% Endif %>
<% /* ------------------------------------------------------------------  */ %>
<tr><td id="tdcenter" colspan="2">Detalhamento da Proposta / Conv�nio</td></tr>
<% IF !empty(QRYCONV->ANOPRO) %>
<tr>
<td>Ano da Proposta</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->ANOPRO))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->NRPRO) %>
<tr>
<td>N�mero da Proposta</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->NRPRO  ))%></td>
</tr>
<% Endif %>

<% If !empty(QRYCONV->NRINTERNOC) %>
<tr>
<td>N�mero Interno de Controle</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->NRINTERNOC))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->NRPROCESSO) %>
<tr>
<td>N�mero do Processo</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->NRPROCESSO))%></td>
</tr>
<% Endif %>

<% If !empty(QRYCONV->ANOCNV) %>
<tr>
<td>Ano do Conv�nio</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->ANOCNV ))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->NRCNV) %>
<tr>
<td>N�mero do Conv�nio</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->NRCNV  ))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->ID_PROP) %>
<tr>
<td>C�digo identificador da Proposta</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->ID_PROP	))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->IDCNV) %>
<tr>
<td>C�digo Identificador do Conv�nio</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->IDCNV))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->IDPROPPGM) %>
<tr>
<td>C�digo de Identifica��o da Proposta/Programa</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->IDPROPPGM ))%></td>
</tr>
<% endif %>

<% If !empty(QRYCONV->INPUBLICAD) %>
<tr>
<td>Conv�nio Pulblidado ?</td>
<td id="tdgray"><%=IIF(QRYCONV->INPUBLICAD='S',"Sim","N�o")%></td>
</tr>
<% endif %>
<% If !empty(QRYCONV->INASSINADO) %>
<tr>
<td>Conv�nio Assinado ?</td>
<td id="tdgray"><%=IIF(QRYCONV->INASSINADO='S',"Sim","N�o")%></td>
</tr>
<% endif %>
<% If !empty(QRYCONV->INADITIVOS) %>
<tr>
<td>Possui Aditivos ?</td>
<td id="tdgray"><%=IIF(QRYCONV->INADITIVOS='S',"Sim","N�o")%></td>
</tr>
<% endif %>
<% If !empty(QRYCONV->QTADITIVOS) %>
<tr>
<td>Aditivos</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->QTADITIVOS ))%></td>
</tr>
<% endif %>
<% If !empty(QRYCONV->INEMPENHAD) %>
<tr>
<td>Possui Empenhos ?</td>
<td id="tdgray"><%=IIF(QRYCONV->INEMPENHAD='S',"Sim","N�o")%></td>
</tr>
<% endif %>
<% If !empty(QRYCONV->QTEPHS) %>
<tr>
<td>Empenhos</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->QTEPHS ))%></td>
</tr>
<% endif %>

<% If !empty(QRYCONV->INPERMITEA) %>
<tr>
<td>Permite ajuste de cronograma ?</td>
<td id="tdgray"><%=IIF(QRYCONV->INPERMITEA='S',"Sim","N�o")%></td>
</tr>
<% endif %>

<% If !empty(QRYCONV->INPRORROGA) %>
<tr>
<td>Possui Prorroga de Of�cio ?</td>
<td id="tdgray"><%=IIF(QRYCONV->INPRORROGA='S',"Sim","N�o")%></td>
</tr>
<% endif %>
<% If !empty(QRYCONV->QTPRORROGA) %>
<tr>
<td>Prorroga��es de Of�cio</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->QTPRORROGA ))%></td>
</tr>
<% endif %>

<% /* ------------------------------------------------------------------  */ %>
<tr><td id="tdcenter" colspan="2">Detalhamento do Programa / Conv�nio</td></tr>

<% If !empty(QRYCONV->CDPGM) %>
<tr>
<td>C�digo do Programa</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->CDPGM))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->CDACTPPA) %>
<tr>
<td>C�digo da A��o do Programa</td>
<td id="tdgray"><%=alltrim(cValToChar(QRYCONV->CDACTPPA))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->NMPGM) %>
<tr>
<td>Nome do Programa</td>
<td id="tdgray"><%=Capital(alltrim(QRYCONV->NMPGM))%></td>
</tr>
<% Endif %>
<% If !empty(QRYPROG->TXDESCRICA) %>
<tr>
<td>Descri��o do Programa</td>
<td id="tdgray"><%=Capital(alltrim(QRYPROG->TXDESCRICA))%></td>
</tr>
<% Endif %>
<tr>
<td>Propostas realizadas</td>
<td id="tdgray"><%=cValToChar(QRYPROG->QTPRO)%></td>
</tr>
<tr>
<td>Conv�nios realizados</td>
<td id="tdgray"><%=cValToChar(QRYPROG->QTCNV)%></td>
</tr>


<% If !empty(QRYCONV->CDORGSUP) %>
<tr>
<td>�rg�o Superior da Proposta</td>
<td id="tdgray"><%=alltrim(QRYCONV->CDORGSUP)+' - '+Capital(Alltrim(QRYCONV->NMORGSUP))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->CDORGCCD) %>
<tr>
<td>�rg�o Concedente</td>
<td id="tdgray"><%=alltrim(QRYCONV->CDORGCCD)+' - '+Capital(Alltrim(QRYCONV->NMORGCCD))%></td>
</tr>
<% Endif %>   
<% If !empty(QRYCONV->CDRPNCCD) %>
<tr>
<td>Respons�vel pelo Concedente</td>
<td id="tdgray"><%=QRYCONV->CDRPNCCD+' - '+Capital(alltrim(QRYCONV->NMRPNCCD))%></td>
</tr>
<% Endif %>
<% If !empty(QRYCONV->TXCARRPNCC) %>
<tr>
<td>Cargo do Respons�vel</td>
<td id="tdgray"><%=Capital(alltrim(QRYCONV->TXCARRPNCC))%></td>
</tr>
<% Endif %>
<tr><td colspan="2">&nbsp;</td></tr>
<% /* DbSkip() */ %>
<% /* Enddo */ %>
</table>
<% 
QRYCONV->(DbSkip())
If !QRYCONV->(eof()) %>
%>
<p>ANTEN��O: Existem dados adicionais na base de conv�nio por programa com a mesma chave de busca de conv�nio.</p>
<% Endif %>
<p>
<input type="button" value="Voltar" onclick="javascript:Voltar()">
&nbsp;&nbsp;&nbsp;
<input type="button" value="Retornar ao In�cio" onclick="javascript:Home()">
</p>
<br>
<?php require_once('footer.php'); ?>
</body>
<script>
</script>
</html>

