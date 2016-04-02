﻿<%
Local nI,nJ
%>

<html lang="pt-BR">
<head>
<?php require_once('headmetas.php'); ?>
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
	window.open("/php/siconv03.php?MUN=<%=cMunID%>&CCD="+cCod+"&PAGE=1&ORD=D","_self");
}
function Voltar()
{
	window.open("/php/siconvmun.php?UF=<%=cUf%>","_self");
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
<h3><%=Capital(cMunic)%> / <%=cUF%> - Propostas e Convênios</h3>
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
<% For nI := 1 to len(aData)%>
<tr>
<td <%=IIf(Ni%2==0,' id="tdodd"','')%>>
<a href="javascript:Propostas('<%=aData[nI][1]%>')">
<%=Capital(alltrim(aData[nI][2]))%>
</a>
</td>
<td <%=IIf(Ni%2==0,' id="tdodd"','')%>><%=cValToChar(aData[nI][3])%></td>
<td <%=IIf(Ni%2==0,' id="tdodd"','')%>><%=alltrim(str(aData[nI][4],8,2))%> mi</td>
<td <%=IIf(Ni%2==0,' id="tdodd"','')%>><%=cValToChar(aData[nI][5])%></td>
<td <%=IIf(Ni%2==0,' id="tdodd"','')%>><%=alltrim(str(aData[nI][6],8,2))%> mi</td>
</tr>
<% Next %>
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
