<?php 
require_once ("../../conexao.php");
$id =  @$_POST['id-excluir'];
$pagina = 'membros';


$id_usuario = @$_SESSION['id_usuario'];
$consulta = $pdo -> query("SELECT * FROM usuario WHERE id = '$id_usuario' ");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$nome_usu = $result [0]['nome'];



$consulta = $pdo -> query("SELECT * FROM $pagina WHERE id = '$id'");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$foto = $result[0]['foto'];
    if($foto != "sem-foto.jpg"){
        @unlink('../../img/img-user/' . $foto);
    }

$consulta = $pdo -> query("DELETE FROM $pagina WHERE id = '$id' ");

$consulta = $pdo -> prepare("INSERT INTO notificacoes SET nome = '$nome_usu', atividade = 'Excluiu um Membro', hora = curTime(), data_not = curDate(), status_not = 'nao visto'  ");
$consulta->execute();


echo "Excluído com Sucesso";
?>