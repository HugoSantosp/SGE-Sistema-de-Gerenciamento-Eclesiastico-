<?php 
require_once ("../../conexao.php");
$id =  @$_POST['id-excluir'];
$pagina = 'secretarios';

$consulta = $pdo -> query("SELECT * FROM $pagina WHERE id = '$id'");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$foto = $result[0]['foto'];
    if($foto != "sem-foto.jpg"){
        @unlink('../../img/img-user/' . $foto);
    }

$consulta = $pdo -> query("DELETE FROM $pagina WHERE id = '$id' ");
$consulta = $pdo -> query("DELETE FROM usuario WHERE id_pessoa = '$id' and nivel = 'Secretario' ");

echo "Excluído com Sucesso";
?>