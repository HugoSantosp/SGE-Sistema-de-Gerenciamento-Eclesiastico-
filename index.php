<?php
    //requerimento ao arquivo de conexão com o banco de dados 
    require_once ("conexao.php");

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>

<!-- Icone para o titulo da Página -->
 <link href="img/logo-icone.ico" rel="shortcut icon" type="image/x-ico">

 <!-- Folha de Estilo -->
 <link rel="stylesheet" href="../css/style.css">

 <!-- Folha de Estido do BootStrap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- Links para o kit de Icones do FontWatesome -->
<script src="https://kit.fontawesome.com/445ebf3c32.js" crossorigin="anonymous"></script>

<!-- Links para os scripts para o Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>




    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php  echo "$nome_igreja";?> </title>

</head>
<body class="bg-dark">

    <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="img/logorestitui.png" alt="">
        <div class="text">
          <span class="text-1">Lembre-se sempre <br> Que você é </span>
          <span class="text-2">Resposta de oração</span>
        </div>
      </div>
      
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
          
            <!--FORMULARIO PARA AUTENTICAÇÃO E LOGUIN  -->
          <form method="post" action="autenticar.php">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Digite Seu email ou cpf"  name="user" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Digite Sua Senha" name="senha" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Entrar">
              </div>
              <div class="text sign-up-text"> 
                <a href="../index.html" class="text-dark mx-5"><i class="fas fa-arrow-circle-left text-dark"></i>    Ir ao Site</a>
              </div>
            </div>
        </form>



      </div>
        
    </div>
    </div>
  </div>




</body>
</html>