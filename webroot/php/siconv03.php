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
	window.open("/siconv04.php?IDPRO="+cCod,"_self");
}
function Convenio(cCod)
{
	window.open("/siconv05.php?IDCNV="+cCod,"_self");
}
function Voltar()
{
	window.open("/siconv02.php?MUN=<%=cIDMun%>","_self");
}
function Home()
{
	window.open("/","_self");
}
function Pagina(nPage,cOrdem)
{
	window.open("/siconv03.php?MUN=<%=cIDMun%>&CCD=<%=cCodCCD%>&PAGE="+nPage+"&ORD="+cOrdem,"_self");
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
<h3><%=Capital(cMunic)%> / <%=cUF%><br><%=Capital(cOrgaoCCD)%><br>( P�gina <%=cValToChar(nPage)%> )</h3>

<div id="_HELP" style="display: none">
<hr>
<p>Esta consulta mostra as propostas e conv�nios realizados para o munic�pio em quest�o, 
mostrando apenas as informa��es relacionadas a <b><%=Capital(cOrgaoCCD)%></b>. Para obter maiores 
detalhes sobre cada Proposta ou Conv�nio celebrado, basta clicar no bot�o de Consulta 
correspondente.</p>
<p id="phelp">Ap�s escolher um �rg�o para consultar, ser�o apresentadas todas as propostas e conv�nios firmados com o �rg�o 
em quest�o para aquele minuc�pio, contendo apenas algumas informa��es da proposta, mostrando primeiro as propostas
recentemente enviadas. Ao escolher uma proposta ou conv�nio para detalhamento, ser�o mostradas as informa��es completas
sobre o item escolhido. </p>
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
<input type="button" value="P�gina Anterior" onclick="javascript:Pagina(<%=cValToChar(nPage-1)%>,'<%=cOrd%>')">
</p>
<% endif %>

<table>
<% 
While !eof() 
   nRows++
%>
<tr><td colspan="4">
<% IF !empty(QRY->IDCNV) %>
<input id="normalbutton" type="button" value="Consultar Conv�nio <%=QRY->IDCNV%>" onclick="javascript:Convenio('<%=QRY->IDCNV%>')">
<% else %>
<input id="normalbutton" type="button" value="Consultar Proposta <%=QRY->IDPRO%>" onclick="javascript:Proposta('<%=QRY->IDPRO%>')">
<% Endif %>                     
&nbsp;
<% If ("CANCELADO"$QRY->TXSIT)%>
<img src="/images/LogoCancel.png" title="Cancelado">&nbsp;
<% Endif %>
<% If ("APROVADO"$QRY->TXSIT)%>
<img src="/images/LogoOK.png" title="Aprovado">&nbsp;
<% Endif %>
<% If ("REJEITADO"$QRY->TXSIT)%>
<img src="/images/LogoRejeitado.png" title="Rejeitado">&nbsp;
<% Endif %>
<% If ("AN�LISE"$QRY->TXSIT)%>
<img src="/images/LogoAnalize.png" title="Em An�lise">&nbsp;
<% Endif %>
<% If ("EXECU��O"$QRY->TXSIT)%>
<img src="/images/LogoEmExec.png" title="Em Execu��o">&nbsp;
<% Endif %>
<% IF QRY->DTFIMVIG < date() /* Ampulheta - Proposta VENCIDA*/%>
<img src="/images/RedHourGlass.png" title="Vig�ncia da Proposta Expirada">&nbsp;
<% Else %>
<img src="/images/GreenFlag.png" title="Vig�ncia da Proposta em Dia">&nbsp;
<% Endif %>
<% If QRY->INPARECERG == 'S' %>
<img title="Parecer do Administrador" src="/images/LogoAdm.png">&nbsp;
<% endif %>
<% If QRY->INPARECERJ == 'S' %>
<img title="Parecer Jur�dico" src="/images/LogoJur.png">&nbsp;
<% endif %>
<% If QRY->INPARECERT == 'S' %>
<img title="Parecer T�cnico" src="/images/LogoTec.png">&nbsp;
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
<td>Situa��o Atual</td>
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
<p><input type="button" value="P�gina Anterior" onclick="javascript:Pagina(<%=cValToChar(nPage-1)%>,'<%=cOrd%>')"></p>
<% endif %>
<% If nRows >= nPageSize %>
<p><input type="button" value="Mais resultados" onclick="javascript:Pagina(<%=cValToChar(nPage+1)%>,'<%=cOrd%>')"></p>
<% endif %>
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






