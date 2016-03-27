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
function ConsultaMUN(cCod,cUF) 
{
	localStorage.setItem('UF',cUF);
	localStorage.setItem('MUN',cCod);
	window.open("/php/siconv02.php?MUN="+cCod,"_self");
}
function Voltar()
{
	window.open("/php/siconvuf.php","_self");
}
</script>
</head>
<body onload="javascript:SelectLastUF()">
<?php require_once('ptitle.php'); ?>
<h3>Munic�pios Pr�ximos</h3>
<br>
<% If len(aMunic) > 0 %>
<% For nI := 1 to len(aMunic) %>
<p><input type="button" value="<%=aMunic[nI][2]%> / <%=aMunic[nI][3]%>" 
onclick="javascript:ConsultaMUN('<%=aMunic[nI][1]%>','<%=aMunic[nI][3]%>')"></p>
<% next %>
<% else %>
<p>Latitude: <%=cLat%><br>Longitude: <%=cLong%></p>
<p>N�o foi identificado nenhum munic�pio pr�ximo a sua localiza��o atual. Volte para a p�gina anterior e selecione manualmente um Estado e Munic�pio para realizar a consulta.</p>
<% Endif %>
<p><input type="button" value="Voltar" onclick="javascript:Voltar()"></p>
<br>
<br>
<?php require_once('footer.php'); ?>
</body>
<script>
</script>
</html>

