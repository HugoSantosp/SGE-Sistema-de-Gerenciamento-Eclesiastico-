<?php 
require_once ("../../conexao.php");
$id =  @$_POST['id'];
$concluir =  @$_POST['concluir'];
$pagina = 'tarefas';


$consulta = $pdo -> query("UPDATE $pagina SET status_tarefa = '$concluir' WHERE id = '$id' ");


echo "Alterado com Sucesso";
?>