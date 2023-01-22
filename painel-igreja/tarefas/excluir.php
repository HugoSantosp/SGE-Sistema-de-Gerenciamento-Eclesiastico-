<?php 
require_once ("../../conexao.php");
$id =  @$_POST['id-excluir'];
$pagina = 'tarefas';

$consulta = $pdo -> query("DELETE FROM $pagina WHERE id = '$id' ");

echo "Excluído com Sucesso";
?>