<?php 
require_once('../../conexao.php');


$pagina = 'igrejas';

// Dados da tabela igrejas Resgatados Via POST
$id =  @$_POST['id'];
$nome =  $_POST['nome'];
$telefone =  $_POST['telefone'];
$endereco =  $_POST['endereco'];
$data_cad =  $_POST['data_cad'];
$pastor = @$_POST['pastor'];
$matriz = $_POST['matriz'];





     // SCRIPT PARA SUBIR A IMAGEM PARA O SERVIDOR
     $nome_img = date('d-m-Y H:i:s') . '-'. @$_FILES['imagem']['name'];
     $nome_img = preg_replace('/[ :]+/','-',$nome_img);


     $caminho = '../../img/img-igreja/'.$nome_img;
     if(@$_FILES['imagem']['name'] == ""){
         $imagem = "logorestitui.png";
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
       


     if($id == "" || $id == 0){

      // //SCRIPT PARA INSERIR OS DADOS NAS TABELAS DO BANCO DE DADOS
        $consulta = $pdo -> prepare("INSERT INTO $pagina SET nome = :nome,telefone = :telefone, endereco = :endereco, foto ='$imagem', data_cad = curDate(),matriz = :matriz, pastor = '$pastor'");
        $consulta->bindValue(":nome","$nome");
        $consulta->bindValue(":telefone","$telefone");
        $consulta->bindValue(":endereco","$endereco");
        $consulta->bindValue(":matriz","$matriz");
        $consulta->execute();
        /* $last_id = $pdo -> lastInsertId(); */

     }else{

// UPDATE dos dados da tabela Igrejas
      if($imagem == "logorestitui.png"){
         $consulta = $pdo -> prepare("UPDATE $pagina SET nome = :nome,telefone = :telefone, endereco = :endereco,matriz = :matriz, pastor = '$pastor' WHERE id = '$id'");
        
      }else {
         $consulta = $pdo -> query("SELECT * FROM $pagina WHERE id = '$id'");
         $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
         $foto = $result[0]['foto'];
          if($foto != "logorestitui.png"){
             @unlink('../../img/img-igreja/' . $foto);
           
          }  
   
         $consulta = $pdo -> prepare("UPDATE $pagina SET nome = :nome,telefone = :telefone, endereco = :endereco, foto ='$imagem',matriz = :matriz,pastor = '$pastor' WHERE id = '$id'");

      }
        $consulta->bindValue(":nome","$nome");
        $consulta->bindValue(":telefone","$telefone");
        $consulta->bindValue(":endereco","$endereco");
        $consulta->bindValue(":matriz","$matriz");
        $consulta->execute();

     }


    



    echo 'Salvo com Sucesso';


    

?>