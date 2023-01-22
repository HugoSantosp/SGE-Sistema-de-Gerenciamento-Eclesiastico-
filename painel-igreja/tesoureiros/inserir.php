<?php 
require_once('../../conexao.php');


$pagina = 'tesoureiros';

$nome =  $_POST['nome'];
$documento =  $_POST['cpf'];
$email =  $_POST['email'];
$endereco =  $_POST['endereco'];
$telefone =  $_POST['telefone'];
$data_nasc =  $_POST['data_nasc'];
$id =  @$_POST['id'];
$id_igreja =  @$_POST['id_igreja'];

if($id_igreja == ""){
   $id_igreja = 1;
}


$consulta = $pdo -> query("SELECT * FROM $pagina WHERE documento = '$documento' ");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$result[0]['id'];
     if(@count($result) > 0 && $id_reg != $id ) {
        echo 'Este documento já existe';
        exit();
       }


 $consulta = $pdo -> query("SELECT * FROM $pagina WHERE email = '$email' ");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$result[0]['id'];
     if(@count($result) > 0 && $id_reg != $id ) {
        echo 'Este Email já existe';
         exit();
     }


     // SCRIPT PARA SUBIR A IMAGEM PARA O SERVIDOR
     $nome_img = date('d-m-Y H:i:s') . '-'. @$_FILES['imagem']['name'];
     $nome_img = preg_replace('/[ :]+/','-',$nome_img);


     $caminho = '../../img/img-user/'.$nome_img;
     if(@$_FILES['imagem']['name'] == ""){
         $imagem = "sem-foto.jpg";
     }else{
         $imagem=$nome_img;
     }

     $imagem_temp = @$_FILES['imagem']['tmp_name'];
     $ext = pathinfo($imagem, PATHINFO_EXTENSION);

     if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif'){
        move_uploaded_file($imagem_temp, $caminho);
     }else{
        echo 'Extenção de Imagem não permitida!';
        exit();
     }
       


     //SCRIPT PARA INSERIR e ATUALIZAR OS DADOS NAS TABELAS DO BANCO DE DADOS
     if($id == "" || $id == 0){

        $consulta = $pdo -> prepare("INSERT INTO $pagina SET nome = :nome, documento = :documento, email = :email, telefone = :telefone, endereco = :endereco, foto ='$imagem',data_nasc = '$data_nasc', data_cad = curDate(), igreja ='$id_igreja' ");
        $consulta->bindValue(":nome","$nome");
        $consulta->bindValue(":email","$email");
        $consulta->bindValue(":documento","$documento");
        $consulta->bindValue(":telefone","$telefone");
        $consulta->bindValue(":endereco","$endereco");
        $consulta->execute();
        $last_id = $pdo -> lastInsertId();

        $consulta = $pdo -> prepare("INSERT INTO usuario SET nome = :nome, documento = :documento, email = :email, senha = '123', nivel='Tesoureiro', id_pessoa ='$last_id', foto ='$imagem',igreja ='$id_igreja'; ");
        $consulta->bindValue(":nome","$nome");
        $consulta->bindValue(":email","$email");
        $consulta->bindValue(":documento","$documento");
        $consulta->execute();

     }else{
      
      if($imagem == "sem-foto.jpg"){
         $consulta = $pdo -> prepare("UPDATE usuario SET nome = :nome, documento = :documento, email = :email,igreja ='$id_igreja' WHERE id_pessoa = '$id' and nivel ='Tesoureiro' ");
        }else{
        $consulta = $pdo -> query("SELECT * FROM usuario WHERE id_pessoa = '$id'");
        $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        $foto = $result[0]['foto'];
         if($foto != "sem-foto.jpg"){
            @unlink('../../img/img-user/' . $foto);
          
         }  
  
         $consulta = $pdo -> prepare("UPDATE usuario SET nome = :nome, documento = :documento, email = :email, foto ='$imagem',igreja ='$id_igreja' WHERE id_pessoa = '$id' and nivel ='Tesoureiro' ");     
  
      }
        $consulta->bindValue(":nome","$nome");
        $consulta->bindValue(":email","$email");
        $consulta->bindValue(":documento","$documento");
        $consulta->execute();
  
  
  // UPDATE dos dados do secretarios
        if($imagem == "sem-foto.jpg"){
           $consulta = $pdo -> prepare("UPDATE $pagina SET nome = :nome, documento = :documento, email = :email, telefone = :telefone, endereco = :endereco,data_nasc = '$data_nasc',igreja ='$id_igreja' WHERE id = '$id'");
          
        }else {
           $consulta = $pdo -> query("SELECT * FROM $pagina WHERE id = '$id'");
           $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
           $foto = $result[0]['foto'];
            if($foto != "sem-foto.jpg"){
               @unlink('../../img/img-user/' . $foto);
             
            }  
     
           $consulta = $pdo -> prepare("UPDATE $pagina SET nome = :nome, documento = :documento, email = :email, telefone = :telefone, endereco = :endereco, foto ='$imagem',data_nasc = '$data_nasc',igreja ='$id_igreja' WHERE id = '$id'");
  
        }
          $consulta->bindValue(":nome","$nome");
          $consulta->bindValue(":email","$email");
          $consulta->bindValue(":documento","$documento");
          $consulta->bindValue(":telefone","$telefone");
          $consulta->bindValue(":endereco","$endereco");
          $consulta->execute();
  

     }

   



    echo 'Salvo com Sucesso';


    

?>