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
  font-size: 120%;
}
a, input {
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
function Voltar() {
    window.history.back();
}
function Home()
{
	window.open("/","_self");
}
</script>
</head>
<body>
<?php require_once('ptitle.php'); ?>
<h3><?php echo $cErrorMSG ?></h3>
<p><?php echo $cErrorHLP ?></hp>
<p><input type="button" value="Voltar" onclick="javascript:Voltar()"></p>
<p><input type="button" value="Retornar ao Início" onclick="javascript:Home()"></p>
<p>Para reportar um erro, envie um email ao Administrador do Site, usando a opção abaixo:</p>
<p><a href="mailto:siga0984@gmail.com?Subject=Todos%20de%20Olho%20(ERROR_REPORT)" target="_blank">Reportar Erro</a></p>
<br>
<?php require_once('footer.php'); ?>
</body>
</html>
