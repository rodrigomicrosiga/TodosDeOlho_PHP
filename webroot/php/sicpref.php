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
input {
    padding:5px 15px; 
    background:#ccc; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
    font-size: 130%;
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
<h3>Prefer�ncias</h3>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><input type="button" value="Voltar" onclick="javascript:Voltar()"></p>
<br>
<br>
<?php require_once('footer.php'); ?>
</body>
</html>
