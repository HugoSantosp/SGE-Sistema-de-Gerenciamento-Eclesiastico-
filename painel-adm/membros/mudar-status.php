<?php 
require_once ("../../conexao.php");
$id =  @$_POST['id'];
$situacao2 =  @$_POST['situacao'];
$pagina = 'membros';


$consulta = $pdo -> query("UPDATE $pagina SET situacao = '$situacao2' WHERE id = '$id' ");


echo "Alterado com Sucesso";
?>