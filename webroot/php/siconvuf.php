﻿<html lang="pt-BR">
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
function ConsultaUF(cCod) 
{
	localStorage.setItem('UF',cCod);
	window.open("/php/siconvmun.php?UF="+cCod,"_self");
}
function SelectLastUF()
{
	if(typeof(Storage) !== "undefined") {
		var savedUF = localStorage.getItem('UF');
		if( savedUF ) {
			var currentUF = window.document.getElementById('UF');
			currentUF.value = savedUF;
		}
	}
}
function ConsultaGEO()
{                          
    if (navigator.geolocation) 
    {
        navigator.geolocation.getCurrentPosition(OpenGeo);
    } else { 
        alert("Localização atual não disponivel");
    }
}

function OpenGeo(position)
{
	window.open("/php/siconvgeo.php?LAT="+position.coords.latitude+
	            "&LONG="+position.coords.longitude,"_self");
}

function Voltar()
{
	window.open("/","_self");
}
</script>
</head>
<body onload="javascript:SelectLastUF()">
<?php 
require_once('ptitle.php');
?>
<h3>Escolha o Estado do Brasil para Pesquisar</h3>
<p>
<p>
<select id="UF" name="UF">
  <option value="AC">Acre</option>
  <option value="AL">Alagoas</option>
  <option value="AP">Amapá</option>
  <option value="AM">Amazonas</option>
  <option value="BA">Bahia</option>
  <option value="CE">Ceará</option>
  <option value="DF">Distrito Federal</option>
  <option value="ES">Espírito Santo</option>
  <option value="GO">Goiás</option>
  <option value="MA">Maranhão</option>
  <option value="MT">Mato Grosso</option>
  <option value="MS">Mato Grosso do Sul</option>
  <option value="MG">Minas Gerais</option>
  <option value="PA">Pará</option>
  <option value="PB">Paraíba</option>
  <option value="PR">Paraná</option>
  <option value="PE">Pernambuco</option>
  <option value="PI">Piauí­</option>
  <option value="RJ">Rio de Janeiro</option>
  <option value="RN">Rio Grande do Norte</option>
  <option value="RS">Rio Grande do Sul</option>
  <option value="RO">Rondônia</option>
  <option value="RR">Roraima</option>
  <option value="SC">Santa Catarina</option>
  <option value="SP">São Paulo</option>
  <option value="SE">Sergipe</option>
  <option value="TO">Tocantins</option>
</select>
</p>
<p>
<input type="button" value="Buscar" onclick="javascript:ConsultaUF(UF.value)">
&nbsp;&nbsp;&nbsp;
<input type="button" value="Voltar" onclick="javascript:Voltar()">
</p>
<p><input type="button" value="Use sua localização" onclick="javascript:ConsultaGEO()"></p>
<br>
<br>
<?php 
require_once('footer.php');
?>
</body>
<script>
</script>
</html>

