<?php 
require_once('../../conexao.php');
require_once("../verify.php");


$pagina = 'pagar';
$descricao =  $_POST['descricao'];
$fornecedor =  $_POST['fornecedor'];
$valor =    $_POST['valor'];
$vencimento =  $_POST['vencimento'];
$frequencia =  $_POST['frequencia'];
$igreja =  $_POST['igreja'];
$id =  @$_POST['id'];



$id_usuario = @$_SESSION['id_usuario'];
$consulta = $pdo -> query("SELECT * FROM usuario WHERE id = '$id_usuario' ");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$nome_usu = $result [0]['nome'];




     // SCRIPT PARA SUBIR A IMAGEM PARA O SERVIDOR
     $nome_img = date('d-m-Y H:i:s') . '-'. @$_FILES['arquivo']['name'];
     $nome_img = preg_replace('/[ :]+/','-',$nome_img);


     $caminho = '../../img/contas/'.$nome_img;
     if(@$_FILES['arquivo']['name'] == ""){
         $imagem = "sem-foto.jpg";
     }else{
         $imagem=$nome_img;
     }

     $imagem_temp = @$_FILES['arquivo']['tmp_name'];
     $ext = pathinfo($imagem, PATHINFO_EXTENSION);

     if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif'){
        move_uploaded_file($imagem_temp, $caminho);
     }else{
        echo 'Extenção de Imagem não permitida!';
        exit();
     }
       


     //SCRIPT PARA INSERIR e ATUALIZAR OS DADOS NAS TABELAS DO BANCO DE DADOS
     if($id == "" || $id == 0){

      // INSERÇÃO DE DADOS 
        $consulta = $pdo -> prepare("INSERT INTO $pagina SET nome = :nome, documento = :documento, situacao =$situacao, telefone = :telefone, endereco = :endereco, foto ='$imagem', data_nasc = '$data_nasc', data_cad = curDate(), igreja = $igreja, funcao = $funcao, data_batismo = '$data_batismo' ");
        $consulta->bindValue(":nome","$nome");
        $consulta->bindValue(":documento","$docdumento");
        /* $consulta->bindValue(":funcao","$funcao"); */
        $consulta->bindValue(":telefone","$telefone");
        $consulta->bindValue(":endereco","$endereco");
        $consulta->execute();
        $last_id = $pdo -> lastInsertId();

        $consulta = $pdo -> prepare("INSERT INTO notificacoes SET nome = '$nome_usu', atividade = 'Cadastrou um Novo Membro', hora = curTime(), data_not = curDate(), status_not = 'nao visto'  ");
        $consulta->execute();

        
     }else{
      

// UPDATE dos dados do membros
      if($imagem == "sem-foto.jpg"){
         $consulta = $pdo -> prepare("UPDATE $pagina SET nome = :nome, documento = :documento, situacao = $situacao, telefone = :telefone, endereco = :endereco, data_nasc = '$data_nasc', igreja = $igreja,funcao = $funcao, data_batismo = '$data_batismo' WHERE id = '$id'");
        
      }else {
         $consulta = $pdo -> query("SELECT * FROM $pagina WHERE id = '$id'");
         $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
         $foto = $result[0]['foto'];
          if($foto != "sem-foto.jpg"){
             @unlink('../../img/img-user/' . $foto);
           
          }  
   
         $consulta = $pdo -> prepare("UPDATE $pagina SET nome = :nome, documento = :documento, situacao = $situacao, telefone = :telefone, endereco = :endereco, foto ='$imagem', data_nasc = '$data_nasc', igreja = $igreja,funcao = $funcao, data_batismo = '$data_batismo' WHERE id = '$id'");
      }
        $consulta->bindValue(":nome","$nome");
        $consulta->bindValue(":documento","$documento");
        /* $consulta->bindValue(":funcao","$funcao"); */
        $consulta->bindValue(":telefone","$telefone");
        $consulta->bindValue(":endereco","$endereco");
        $consulta->execute();

        $consulta = $pdo -> prepare("INSERT INTO notificacoes SET nome = '$nome_usu', atividade = 'Atualizou o cadastro de $nome', hora = curTime(), data_not = curDate(), status_not = 'nao visto'  ");
        $consulta->execute();

     }


    



    echo 'Salvo com Sucesso';


    

?>