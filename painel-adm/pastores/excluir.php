<?php 
require_once ("../../conexao.php");
require_once("../verify.php");

$id =  @$_POST['id-excluir'];
$id_usuario = @$_SESSION['id_usuario'];
$pagina = 'bispos';


//INFOMRAÇÕES DO USUÁRIO LOGADO NO SISTEMA
$consulta = $pdo -> query("SELECT * FROM usuario WHERE id = '$id_usuario' ");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$id_pessoa_usu = $result [0]['id_pessoa'];

if($id === $id_pessoa_usu){
    echo "Você Está Logado, efetue o logout entre em contato com Administrador SGE para solicitar a exclusão do seu usuário";
}else{
$consulta = $pdo -> query("SELECT * FROM $pagina WHERE id = '$id'");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$foto = $result[0]['foto'];
    if($foto != "sem-foto.jpg"){
        @unlink('../../img/img-user/' . $foto);
    }

$consulta = $pdo -> query("DELETE FROM $pagina WHERE id = '$id' ");
$consulta = $pdo -> query("DELETE FROM usuario WHERE id_pessoa = '$id' and nivel = 'Pastor Presidente' "); 

echo "Excluído com Sucesso";
}
?>