<!DOCTYPE html>
<html lang="pt-BR">
<head>
<?php 
require_once('headmetas.php');
?>
<meta property="og:locale" content="pt_BR">
<meta property="og:url" content="http://54.191.92.136/">
<meta property="og:site_name" content="Todos de Olho"/>
<meta property="og:image" content="http://54.191.92.136/images/brasao-todosdeolho.png"/>
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="298">
<meta property="og:image:height" content="75">
<style>
input, textarea {
  max-width:100%;
}

p {
  text-align:center;
  font-size: 120%;
}
input {
    padding:5px 15px; 
    background:#ccc; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
    font-size: 100%;
}           

.fb-share-button {
  text-align:center;
  max-width:100%;
}

</style>
<script type="text/javascript">
function Entrar(cUrl)
{
  window.open(cUrl,'_self');
}
</script>
</head>
<body>
<?php 
require_once('fbsdk.php');
require_once('ptitle.php');
?>
<p>Acompanhe as Propostas e Convênios firmados entre a União e o seu Município, 
fique por dentro da utilização das verbas e ajude o país a acabar com a corrupção. 
Participe e compartilhe esta iniciativa.</p>  
<p><input type="button" value="Consultar Propostas" onclick="javascript:Entrar('/php/siconvuf.php')"></p>
<p><input type="button" value="Precisa de Ajuda ?" onclick="javascript:Entrar('/php/sichelp.php')"></p>
<p><input type="button" value="Sobre o Site" onclick="javascript:Entrar('/php/sicabout.php')"></p>
<p><img src='/images/estamosdeolho.png'></p>
<div style="margin: 0 auto; width: 100%;" class="fb-share-button" data-href="http://54.191.92.136/" data-layout="button_count"></div>
<br>
<?php require_once('footer.php'); ?>
</body>
</html>
             
