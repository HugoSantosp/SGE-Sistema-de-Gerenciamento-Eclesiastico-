<?php 
require_once('../../conexao.php');
$pagina = 'presbiteros';
$id =  @$_POST['id-obs'];
$obs =  @$_POST['obs'];


$id_usuario = @$_SESSION['id_usuario'];
$consulta = $pdo -> query("SELECT * FROM usuario WHERE id = '$id_usuario' ");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$nome_usu = $result [0]['nome'];

$consulta = $pdo -> prepare("UPDATE $pagina SET obs = :obs WHERE id = '$id'");
$consulta->bindValue(":obs","$obs");
$consulta->execute();



   echo 'Salvo com Sucesso';


    

?>