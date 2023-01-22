<?php 
require_once('../../conexao.php');
$pagina = 'bispos';
$id =  @$_POST['id_obs'];
$obs =  @$_POST['obs'];

echo $obs;

$consulta = $pdo -> prepare("UPDATE $pagina SET obs = :obs WHERE id = '$id'");
$consulta->bindValue(":obs","$obs");
$consulta->execute();

    echo 'Salvo com Sucesso';


    

?>