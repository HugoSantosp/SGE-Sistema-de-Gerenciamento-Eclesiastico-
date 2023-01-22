<?php 
require_once('../../conexao.php');


$pagina = 'usuario';

$id =  @$_POST['id'];
$senha =  @$_POST['senha'];



        $consulta = $pdo -> prepare ("UPDATE $pagina SET senha = :senha WHERE id = '$id'");
        $consulta->bindValue(":senha","$senha");
        $consulta->execute();
   



    echo 'Salvo com Sucesso';


    

?>