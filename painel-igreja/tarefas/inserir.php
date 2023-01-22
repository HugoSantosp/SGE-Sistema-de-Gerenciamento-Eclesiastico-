<?php 
require_once('../../conexao.php');


$pagina = 'tarefas';
$titulo =  $_POST['titulo'];
$descricao =  $_POST['descricao'];
$data =  $_POST['data'];
$hora =  $_POST['hora'];
$igreja =  $_POST['igreja'];
$id =  @$_POST['id'];



// VERIFICA SE JA EXISTE AQUELA TAREFA

$consulta = $pdo -> query("SELECT * FROM $pagina WHERE data_tarefa = '$data' and hora_tarefa = '$hora'");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$result[0]['id'];
if(@count($result) > 0 && $id_reg != $id ) {
echo 'O) horário indisponível';
exit();
}



     //SCRIPT PARA INSERIR e ATUALIZAR OS DADOS NAS TABELAS DO BANCO DE DADOS
     if($id == "" || $id == 0){

      // INSERÇÃO DE DADOS 
        $consulta = $pdo -> prepare("INSERT INTO $pagina SET titulo = :titulo, descricao = :descricao, data_tarefa = '$data', hora_tarefa = '$hora', igreja = '$igreja', status_tarefa = 'Agendado' ");

     }else{
      
// UPDATE dos dados dos cargos

        $consulta = $pdo -> prepare("UPDATE $pagina SET titulo = :titulo, descricao = :descricao, data_tarefa = '$data', hora_tarefa = '$hora' WHERE id = '$id'");

   }
   $consulta->bindValue(":titulo","$titulo");
   $consulta->bindValue(":descricao","$descricao");
   $consulta->execute();



    echo 'Salvo com Sucesso';


    

?>