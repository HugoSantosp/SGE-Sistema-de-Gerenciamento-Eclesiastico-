<?php 
require_once('../conexao.php');


$nome =  $_POST['nome_usu'];
$documento =  $_POST['cpf_usu'];
$email =  $_POST['email_usu'];
$senha =  $_POST['senha_usu'];
$id =  $_POST['id_usu'];




// consulta para requerir os dados o Usuário através do Identificador (id)
$consulta = $pdo -> query("SELECT * FROM usuario WHERE id = '$id' ");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$documento_antigo = $result[0]['documento'];
$email_antigo = $result[0]['email'];
$nivel_usu = $result[0]['nivel'];
$id_pessoa = $result[0]['id_pessoa'];



if($documento_antigo != $documento){
    $consulta = $pdo -> query("SELECT * FROM usuario WHERE documento = '$documento' ");
    $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);

        if(@count($result) > 0){
            echo 'Este documento já existe';
            exit();

        }
}

if($email_antigo != $email){
    $consulta = $pdo -> query("SELECT * FROM usuario WHERE email = '$email' ");
    $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);

        if(@count($result) > 0){
            echo 'Este email já existe!';
            exit();

        }
}


 // SCRIPT PARA SUBIR A IMAGEM PARA O SERVIDOR
 $nome_img = date('d-m-Y H:i:s') . '-'. @$_FILES['imagem']['name'];
 $nome_img = preg_replace('/[ :]+/','-',$nome_img);


 $caminho = '../img/img-user/'.$nome_img;
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

 


 if($imagem == "sem-foto.jpg"){ 
    $consulta = $pdo -> prepare("UPDATE usuario SET nome = :nome, documento = :documento, email = :email, senha = :senha WHERE id = '$id' ; ");

 }else{
    $consulta = $pdo -> query("SELECT * FROM usuario WHERE id = '$id'");
    $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
    $foto = $result[0]['foto'];
    if($foto != "sem-foto.jpg"){
        @unlink('../img/img-user/'.$foto);
        echo ' excluir foto da tabela usuario';

      }
    $consulta = $pdo -> prepare("UPDATE usuario SET nome = :nome, documento = :documento, email = :email, senha = :senha, foto = '$imagem' WHERE id = '$id' ; ");
}

$consulta->bindValue(":nome","$nome");
$consulta->bindValue(":email","$email");
$consulta->bindValue(":documento","$documento");
$consulta->bindValue(":senha","$senha");
$consulta->execute();



 if ($nivel_usu == 'Pastor Presidente'){  
        $nome_tab = 'bispos'; 
}else if($nivel_usu == 'Pastor Auxiliar'){
    $nome_tab = 'presbiteros';
}else if($nivel_usu == 'Tesoureiro'){
    $nome_tab = 'tesoureiros';
}else if($nivel_usu == 'Secretario'){
    $nome_tab = 'secretarios';
}
 


   
//|| $imagem == $foto

 if($imagem == "sem-foto.jpg" ){
            $consulta = $pdo -> prepare("UPDATE $nome_tab SET nome = :nome, documento = :documento, email = :email WHERE id = '$id_pessoa' ;");
            echo 'não excluir foto da tabela'.$nome_tab;
     
    } else{
        $consulta = $pdo -> query("SELECT * FROM $nome_tab WHERE id = '$id_pessoa'");
        $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        $foto = $result[0]['foto'];
        if($foto != "sem-foto.jpg"){
            @unlink('../img/img-user/'.$foto);
            echo ' excluir foto da tabela'.$nome_tab;
          }
        $consulta = $pdo -> prepare("UPDATE $nome_tab SET nome = :nome, documento = :documento, email = :email, foto = '$imagem' WHERE id = '$id_pessoa' ; ");
    
      }
    

    $consulta->bindValue(":nome","$nome");
    $consulta->bindValue(":email","$email");
    $consulta->bindValue(":documento","$documento");
    $consulta->execute();








    

?>