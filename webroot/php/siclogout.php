﻿<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php require_once('headmetas.php'); ?>
<style>
img {
  max-width: 100%;
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
h1{
  text-align:center;
}
p {
  text-align:center;
  font-size: 130%;
}
</style>
<script type = 'text/javascript'>
function Home()
{
	window.open("/","_self");
}
function OnLoad()
{
	setTimeout(window.close, 5000);
}
</script>
</head>
<body onload="javascript:OnLoad()">
<?php require_once('ptitle.php'); ?>
<p>Obrigado por usar o TODOS DE OLHO.</p> 
<p>Esta janela deve fechar automaticamente em alguns segundos. Caso a janela 
não feche sozinha, você pode fechar o navegador de Internet.</p> 
<p><input type="button" value="Retornar ao Início" onclick="javascript:Home()"></p>
<br>
<?php require_once('footer.php'); ?>
</body>
</html>
	