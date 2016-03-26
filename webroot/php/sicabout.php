<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php require_once('headmetas.php'); ?>
<style>
input, textarea {
  max-width:100%;
}
h1 {
  text-align:center;
}
p, pre  {
  text-align:center;
  font-size: 120%;
}
#phelp {
  text-align:justify;
  font-size: 100%;
}
a, input {
    padding:5px 15px; 
    background:#ccc; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
    font-size: 100%;
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
<p>O portal <b>Todos de Olho</b> disponibiliza de forma simples e r�pida as informa��es p�blicas
dispon�veis para Download no <b>Portal de Conv�nios</b>. �ltima alimenta��o de dados 
feita em 07/03/2016.</p>
<pre>
Desenvolvimento - J�lio Wittwer<br>
<a href="mailto:siga0984@gmail.com?Subject=Todos%20de%20Olho" target="_blank">Enviar e-Mail</a><br>
<a href="https://www.facebook.com/siga0984" target="_blank">Acessar Facebook</a><br>
<a href="https://br.linkedin.com/in/siga0984" target="_blank">Acessar LinkedIn</a><br>
<a href="https://siga0984.wordpress.com/" target="_blank">Acessar Blog Tudo em AdvPL</a><br>
</pre>
<p><input type="button" value="Voltar" onclick="javascript:Voltar()"></p>
<br>
<?php require_once('footer.php'); ?>
</body>
</html>
