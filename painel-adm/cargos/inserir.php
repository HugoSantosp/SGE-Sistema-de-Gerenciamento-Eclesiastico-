<?php 
require_once('../../conexao.php');


$pagina = 'cargos';
$nome =  $_POST['nome'];
$id =  @$_POST['id'];


     //SCRIPT PARA INSERIR e ATUALIZAR OS DADOS NAS TABELAS DO BANCO DE DADOS
     if($id == "" || $id == 0){

      // INSERÇÃO DE DADOS 
        $consulta = $pdo -> prepare("INSERT INTO $pagina SET nome = :nome");
        $consulta->bindValue(":nome","$nome");
        $consulta->execute();
        $last_id = $pdo -> lastInsertId();
     }else{
      
// UPDATE dos dados dos cargos

        $consulta = $pdo -> prepare("UPDATE $pagina SET nome = :nome");
        $consulta->bindValue(":nome","$nome");
        $consulta->execute();

   }



    echo 'Salvo com Sucesso';


    

?>