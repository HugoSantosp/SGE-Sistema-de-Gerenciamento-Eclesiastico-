<?php 
require_once('../../conexao.php');
$pagina = 'presbiteros';
$id =  @$_POST['id-obs'];
$obs =  @$_POST['obs'];


$consulta = $pdo -> prepare("UPDATE $pagina SET obs = :obs WHERE id = '$id'");
$consulta->bindValue(":obs","$obs");
$consulta->execute();

   echo 'Salvo com Sucesso';


    

?>