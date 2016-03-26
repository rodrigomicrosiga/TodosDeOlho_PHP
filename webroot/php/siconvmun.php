<%
Local nI
%>

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
a, select, input {
    padding:5px 15px; 
    background:#ccc; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
    font-size: 120%;
}
</style>
<script type = 'text/javascript'>
function SelectLastMUN()
{
	if(typeof(Storage) !== "undefined") {
		var savedMUN = localStorage.getItem('MUN');
		if( savedMUN ) {
			var currentForm = window.document.getElementById('_FORM_MUN');
		    var currentMUN = currentForm.elements.namedItem('MUN');
			currentMUN.value = savedMUN;
		}
	}
}
function Voltar()
{
	window.open("/siconvuf.php","_self");
}
function ConsultaMUN(cCod) 
{
	localStorage.setItem('MUN',cCod);
	window.open("/php/siconv02.php?MUN="+cCod,"_self");
}
function Home()
{
	window.open("/","_self");
}
function ConsultaGEO()
{                          
    if (navigator.geolocation) 
    {
        navigator.geolocation.getCurrentPosition(OpenGeo);
    } else { 
        alert("Localiza��o atual n�o disponivel");
    }
}

function OpenGeo(position)
{
	window.open("/php/siconvgeo.php?LAT="+position.coords.latitude+
	            "&LONG="+position.coords.longitude,"_self");
}                                         
function FilterMun(oFilter,oSelect)
{
	var cFlt = oFilter.value.toUpperCase();
  oFilter.value = cFlt;   
	for ( var i=0 ; i < oSelect.options.length ; i++)
	{
		var cOpt = oSelect.options[i].text.toUpperCase();
		if ( cFlt == cOpt.substr(0,cFlt.length) )
		{             
		  oSelect.options[i].selected = true;
		  break;
		}
	}
}

</script>
</head>
<body onload="javascript:SelectLastMUN()">
<?php require_once('ptitle.php'); ?>
<h3>Escolha um Munic�pio <%=UFNome(cUF)%> para Pesquisar</h3>
<p>Voc� pode come�ar digitando as primeiras letras do nome do munic�pio no campo abaixo.</p>
<form id="_FORM_MUN">
<p>
<input type="search" id="FLT" 
name="FLT" value="" 
size="15" maxsize="15" placeholder="Filtrar cidades" 
onkeyup="javascript:FilterMun(this,MUN)" 
autofocus></p>
<p>
<select id="MUN" name="MUN">
<% For nI := 1 to len(aMunicipios) %>
<option value="<%=aMunicipios[nI][1]%>"><%=aMunicipios[nI][2]%></option>
<% next %>
</select>
</p>
<p>
<input type="button" value="Buscar" onclick="javascript:ConsultaMUN(MUN.value)">
&nbsp;&nbsp;&nbsp;
<input type="button" value="Voltar" onclick="javascript:Voltar()">
</p>
<p><input type="button" value="Use sua localiza��o" onclick="javascript:ConsultaGEO()"></p>
</form>
<p><input type="button" value="Retornar ao In�cio" onclick="javascript:Home()"></p>
<br>
<?php require_once('footer.php'); ?>
</body>
</html>
