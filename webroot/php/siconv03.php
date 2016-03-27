<%
Local nI,nJ
Local nRows := 0
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
	window.open("/php/siconv05.php?IDCNV="+cCod,"_self");
}
function Voltar()
{
	window.open("/php/siconv02.php?MUN=<%=cIDMun%>","_self");
}
function Home()
{
	window.open("/","_self");
}
function Pagina(nPage,cOrdem)
{
	window.open("/php/siconv03.php?MUN=<%=cIDMun%>&CCD=<%=cCodCCD%>&PAGE="+nPage+"&ORD="+cOrdem,"_self");
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
<h3><%=Capital(cMunic)%> / <%=cUF%><br><%=Capital(cOrgaoCCD)%><br>( Página <%=cValToChar(nPage)%> )</h3>

<div id="_HELP" style="display: none">
<hr>
<p>Esta consulta mostra as propostas e convênios realizados para o município em questão, 
mostrando apenas as informações relacionadas a <b><%=Capital(cOrgaoCCD)%></b>. Para obter maiores 
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
<p>

<% If cOrd == 'V' %>
<input type="button" value="Ordenar por Data" onclick="javascript:Pagina(<%=cValToChar(nPage)%>,'D')";">
<% Else %>
<input type="button" value="Ordenar por Valor" onclick="javascript:Pagina(<%=cValToChar(nPage)%>,'V')";">
<% Endif %>
</p>


<% If nPage > 1 %>
<p>
<input type="button" value="Página Anterior" onclick="javascript:Pagina(<%=cValToChar(nPage-1)%>,'<%=cOrd%>')">
</p>
<% endif %>

<table>
<% 
While !eof() 
   nRows++
%>
<tr><td colspan="4">
<% IF !empty(QRY->IDCNV) %>
<input id="normalbutton" type="button" value="Consultar Convênio <%=QRY->IDCNV%>" onclick="javascript:Convenio('<%=QRY->IDCNV%>')">
<% else %>
<input id="normalbutton" type="button" value="Consultar Proposta <%=QRY->IDPRO%>" onclick="javascript:Proposta('<%=QRY->IDPRO%>')">
<% Endif %>                     
&nbsp;
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
<% IF QRY->DTFIMVIG < date() /* Ampulheta - Proposta VENCIDA*/%>
<img src="/images/redhourglass.png" title="Vigência da Proposta Expirada">&nbsp;
<% Else %>
<img src="/images/greenflag.png" title="Vigência da Proposta em Dia">&nbsp;
<% Endif %>
<% If QRY->INPARECERG == 'S' %>
<img title="Parecer do Administrador" src="/images/logoadm.png">&nbsp;
<% endif %>
<% If QRY->INPARECERJ == 'S' %>
<img title="Parecer Jurídico" src="/images/logojur.png">&nbsp;
<% endif %>
<% If QRY->INPARECERT == 'S' %>
<img title="Parecer Técnico" src="/images/logotec.png">&nbsp;
<% endif %>
</td></tr>
<tr>
<td>Data da proposta</td>
<td id="tdgray"><%=dtoc(QRY->DTPRO)%></td>
<td>Valor Global</td>
<td id="tdgray">R$ <%=Transform(QRY->VL_GLOBAL,"@E 999,999,999,999.99")%></td>
</tr>
<% IF !empty(QRY->TXSIT) %>
<tr>
<td>Situação Atual</td>
<td id="tdgray" colspan="3"><%=Capital(alltrim(QRY->TXSIT))%></td>
</tr> 
<% Endif %>
<tr>
<td>Proponente</td>
<td id="tdgray" colspan="3"><%=QRY->CDIDPPN%> - <%=Capital(alltrim(QRY->NMPPN))%></td>
</tr>
<tr>
<td>Objeto da Proposta</td>
<td id="tdgray" colspan="3"><%=Capital(alltrim(QRY->TXOBJETOCN))%></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<% DbSkip() %>
<% Enddo %>
</table>
<% If nPage > 1 %>
<p><input type="button" value="Página Anterior" onclick="javascript:Pagina(<%=cValToChar(nPage-1)%>,'<%=cOrd%>')"></p>
<% endif %>
<% If nRows >= nPageSize %>
<p><input type="button" value="Mais resultados" onclick="javascript:Pagina(<%=cValToChar(nPage+1)%>,'<%=cOrd%>')"></p>
<% endif %>
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






