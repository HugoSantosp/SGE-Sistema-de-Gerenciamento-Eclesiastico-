
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script type="text/javascript" src="js/alerta-loguin.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php
    require_once ("conexao.php");
    @session_start();

    $user = $_POST['user'];
    $senha = $_POST['senha'];


   

    $consulta = $pdo -> query("SELECT * FROM usuario WHERE (email = '$user' or documento = '$user') and senha = '$senha' ");
    $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
    $total = count($result);

    if($total > 0 ){
        $_SESSION ['nome_usuario'] = $result[0]['nome'];
        $_SESSION ['documento'] = $result[0]['documento'];
        $_SESSION ['nivel_usuario'] = $result[0]['nivel'];
        $_SESSION ['id_usuario'] = $result[0]['id'];
        $_SESSION ['id_igreja'] = $result[0]['igreja'];


         if($result[0]['nivel'] == "Pastor Presidente"){           
            echo "<script> window.location = 'painel-adm'</script>";
           
         }

        
         if($result[0]['nivel'] == "Pastor Auxiliar"){           
             echo "<script> window.location = 'painel-igreja'</script>";
          
         }


    }else{
        echo "<script> $(function() { alertaLoguin('Dados Inválidos, Tente Novamente')}) </script>";
    }

?>