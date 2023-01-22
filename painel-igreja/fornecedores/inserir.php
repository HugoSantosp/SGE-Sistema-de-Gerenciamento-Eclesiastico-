<?php 
require_once('../../conexao.php');


$pagina = 'fornecedores';
$nome =  $_POST['nome'];
$email =  $_POST['email'];
$endereco =  $_POST['endereco'];
$telefone =  $_POST['telefone'];
$produto =  $_POST['produto'];
$id =  @$_POST['id'];
$id_igreja =  @$_POST['id_igreja'];

if($id_igreja == ""){
   $id_igreja = 1;
}


 $consulta = $pdo -> query("SELECT * FROM $pagina WHERE email = '$email' ");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$result[0]['id'];
     if(@count($result) > 0 && $id_reg != $id ) {
        echo 'Este Email já existe';
         exit();
     }
       


     //SCRIPT PARA INSERIR e ATUALIZAR OS DADOS NAS TABELAS DO BANCO DE DADOS
     if($id == "" || $id == 0){

        $consulta = $pdo -> prepare("INSERT INTO $pagina SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco, produto = '$produto',igreja ='$id_igreja' ");
        $consulta->bindValue(":nome","$nome");
        $consulta->bindValue(":email","$email");
        $consulta->bindValue(":produto","$produto");
        $consulta->bindValue(":documento","$documento");
        $consulta->bindValue(":telefone","$telefone");
        $consulta->bindValue(":endereco","$endereco");
        $consulta->execute();

     }else{
        
  // UPDATE dos dados do fornecedores
        $consulta = $pdo -> prepare("UPDATE $pagina SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco, produto = '$produto', igreja ='$id_igreja' and nivel ='Secretario' ");
        $consulta->bindValue(":nome","$nome");
        $consulta->bindValue(":email","$email");
        $consulta->bindValue(":produto","$produto");
        $consulta->bindValue(":documento","$documento");
        $consulta->bindValue(":telefone","$telefone");
        $consulta->bindValue(":endereco","$endereco");
        $consulta->execute();
  

     }

   



    echo 'Salvo com Sucesso';


    

?>