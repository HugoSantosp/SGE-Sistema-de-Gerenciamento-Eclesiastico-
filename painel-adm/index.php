<?php
@session_start();
require_once("verify.php");
require_once("../conexao.php");

$data_atual = date('Y-m-d');
$hora_atual = date('H:i:s');


$id_usuario = @$_SESSION['id_usuario'];



//Recuperar dados do Usuário conectado
$consulta = $pdo -> query("SELECT * FROM usuario WHERE id = '$id_usuario' ");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);

$nome_usu = $result [0]['nome'];
$email_usu = $result [0]['email'];
$documento_usu = $result [0]['documento'];
$senha_usu = $result [0]['senha'];
$nivel_usu = $result [0]['nivel'];
$foto_usu =  $result [0]['foto'];





//MENU DO PAINEL ADM
$pag = @$_GET['pag'];

if($pag == ''){
    $pag = 'home';
}


?>

<!DOCTYPE html>
<html lang="pr-br">
<head>



<!-- Folha de Estilo -->
<link rel="stylesheet" type="text/css" href="css-painel/style.css"></link>

<!-- Icone para o titulo da Página -->
<link href="../img/logo-icone.ico" rel="shortcut icon" type="image/x-ico">

<!-- Folha de Estido do BootStrap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- Folha de Estido de Icones do  BootStrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

 <!-- Boxiocns CDN Link -->
 <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


<!-- Links para o kit de Icones do FontWatesome -->
<script src="https://kit.fontawesome.com/445ebf3c32.js" crossorigin="anonymous"></script>

<!-- Links para os scripts para o Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Links para os scripts do AJAX do google -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Links para Importar o Datatable -->
<link rel="stylesheet" type="text/css" href="../../DataTables/datatables.min.css"></link>
<script type="text/javascript" src="../../DataTables/datatables.min.js"> </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
</head>



<body class="corpo">
  

 <!-- Barra de Navegação do Menu do Painel Administrativo -->



 
<nav class="sidebar close">
    <div class="logo-details">
      <img src="../img/logo-icone.png" width="40px" class="mx-3">
      <span class="logo_name">Restitui Church</span>
    </div>
    <ul class="nav-links">


<li>
    <a href="index.php">
      <i class='bx bx-grid-alt' ></i>
      <span class="link_name">Home</span>
    </a>
    <ul class="sub-menu blank">
      <li><a class="link_name" href="index.php">Home</a></li>
    </ul>
  </li>
  <li>
    <div class="iocn-link">
      <a href="#">
      <i class='bx bx-user-circle'></i>
        <span class="link_name">Pessoas</span>
      </a>
      <i class='bx bxs-chevron-down arrow' ></i>
    </div>
    <ul class="sub-menu">
      <li><a class="link_name" href="#">Pessoas</a></li>
      <li><a href="index.php?pag=pastores">Pastor Presitente</a></li>
      <li><a href="index.php?pag=presbiteros">Pastor Auxiliar</a></li>
      <li><a href="index.php?pag=tesoureiros">Tesoureiros</a></li>
      <li><a href="index.php?pag=secretarios">Secretários</a></li>
      <li><a href="index.php?pag=membros">Membros</a></li>
      <li><a href="index.php?pag=usuarios">Usuários</a></li>
      
       
    </ul>
  </li>
 
  <li>
    <div class="iocn-link">
      <a href="#">
        <i class='bx bx-book-alt' ></i>
        <span class="link_name">Cadastros</span>
      </a>
      <i class='bx bxs-chevron-down arrow' ></i>
    </div>
    <ul class="sub-menu">
      <li><a class="link_name" >Cadastros</a></li>
      <li><a href="index.php?pag=igrejas">Igrejas</a></li>
      <li><a href="index.php?pag=cargos">Cargo Eclesiástico</a></li>
      
      
    </ul>
  </li>
   

   <li>
    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class='bx bxs-user-detail'></i>
      <span class="link_name" >Perfil</span>
    </a>
    <ul class="sub-menu blank">
      <li><a class="link_name" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Perfil</a></li>
    </ul>
  </li> 


  <li>
    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-notice">
    <i class='bx bxs-bell-ring' ></i>
      <span class="link_name" >Notificações</span>
    </a>
    <ul class="sub-menu blank">
      <li><a class="link_name" href="#" data-bs-toggle="modal" data-bs-target="#modal-notice">Notificações</a></li>
    </ul>
  </li>

  <li>
    <div class="iocn-link">
      <a href="#">
      <i class='bx bx-cog' ></i>
        <span class="link_name">Settings</span>
      </a>
      <i class='bx bxs-chevron-down arrow' ></i>
    </div>
    <ul class="sub-menu">
      <li><a class="link_name" >Configurações</a></li>
      <li><a href="#" class="theme" id="theme" onclick="ThemeMode()">Theme<i class='bx bx-moon theme1'></i> <i class='bx bx-sun theme2' ></i></a></li>
      <li><a  class="tarefas" id="tarefas" href="index.php?pag=tarefas" >Tarefas</i></a></li>
                
    </ul>
  </li>


  




<li>
<div class="profile-details">
  <div class="profile-content">
   <img src="../img/img-user/<?php echo $foto_usu ?>">

  </div>
  <div class="name-job">
    <div class="profile_name"><?php echo $nome_usu?></div>
    <div class="job"> <a href="../logout.php">Logout<i class="fas fa-sign-out-alt text-primary fs-5 me-5 bx-sair"></a></i></div>
  </div>
  
</div>
</li>
</ul>
</nav>



<section class="home-section">
    <div class="home-content">

      <i class='bx bx-menu'></i> <br>            
                  
      <span class="text-uppercase fs-3 align-top mx-3 my-3 text-decoration-underline"><?php if ($pag === 'home'){ echo 'DASHBOARD' ;}else { echo $pag;} ;?></span>  
       </div>

          <div class="container-fluid conteudo">
          <?php  require_once($pag.'.php');?> 
            
          </div> 
       
        
    </div>
</section> 





 


    
</body>
</html>




<!-- Links para os scripts de mascara JS -->

<script type="text/javascript" src="../js/mascara.js"></script>


<!-- Links para os scripts de mascara Ajax -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>





<!-- Chama a Janela Modal para Edição de Dados do Usuário Logado -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Dados</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="form-modal" method="post">
                  
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome_usu" name="nome_usu" placeholder="Digite o Nome" value="<?php echo "$nome_usu" ?>"  required="required">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Documento</label>
                                <input type="text" class="form-control" id="cpf" name="cpf_usu" placeholder=" Digite o Documento" value="<?php echo "$documento_usu" ?>" required="required">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email_usu" name="email_usu" placeholder="Digite o email" value="<?php echo "$email_usu" ?>" required="required">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha_usu" name="senha_usu" placeholder="Digite a Senha" value="<?php echo "$senha_usu" ?>" required="required">
                              </div>
                          </div>
                      </div>
                    
                      <div class="row">
                      <div class="col-md-6">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="imagem-usu" name="imagem" onchange="CarregarImagemUsu();">

                                <div id="divImg" class="mt-3">
                                      <img src="../img/img-user/sem-foto.jpg" id="target-usu" width="150px">
                                </div>
                              </div>
                          </div>
                      </div>
                     

                      <input type="hidden"  name="id_usu"  value="<?php echo "$id_usuario" ?>">

                  </div>
                 <small> <div class="text-center"  id="msg-usu"></div> </small>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-usu">Sair</button>
                <button type="submit" class="btn btn-primary" >Salvar</button>
            </div>

       </form>


    </div>
  </div>
</div>


<!-- MODAL DE NOTIFICAÇÕES-->

<div class="modal fade" id="modal-notice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <i class='bx bxs-bell-ring bx-tada fs-2' ></i><h5 class="modal-title text-center" id="exampleModalLabel">   Notificações</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
       <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>



<!-- scripts para o AJAXA inserir e editar os dados do usuário logado -->

<script type="text/javascript">

 /*  $("#form-modal").submit( function (){
    //console.log('Entrou')
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
            url: "editar-dados.php",
            type: 'POST',
            data: formData,

            success: function(menssagem){
                $('msg-usu').text('');
                $('msg-usu').removeClass()
                if(menssagem.trim() == "Salvo com Sucesso"){
                      $('#btn-fechar-usu').click();                                         
                  
                }else{
                      $('#msg-usu').addClass('text-danger');
                      $('#msg-usu').text(menssagem);
                      window.location ='index.php'
                      
                }
            },

            cache: false,
            contentType: false,
            processData : false,
    });


  });
 */

  
 function CarregarImagemUsu(){
    var target  = document.getElementById('target-usu');
    var file = document.querySelector("input[type=file]").files[0];
 var arquivo = file['name'];
    resultado = arquivo.split(".", 2);

    

    if(resultado[1] === 'pdf'){
            $('#target-usu').attr('scr',"../img/img-user/pdf.png");
            return;
    }

    var reader = new FileReader();
    reader.onloadend = function(){
        target.src = reader.result;
    };
    
    if(file){
        reader.readAsDataURL(file);

    }else{
        target.src = "";
    }
}


  $("#form-modal").submit( function (){
    //console.log('Entrou')
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
            url: "editar-dados.php",
            type: 'POST',
            data: formData,

            success: function(menssagem){
                $('msg-usu').text('');
                $('msg-usu').removeClass()
                if(menssagem.trim() == "Salvo com Sucesso"){
                      $('#btn-fechar-usu').click();                                         
                  
                }else{
                      $('#msg-usu').addClass('text-danger');
                      $('#msg-usu').text(menssagem);
                      window.location ='index.php'
                      
                }
            },

            cache: false,
            contentType: false,
            processData : false,
    });


  });






  function ThemeMode(){
  /* const div = document.querySelector(".card-body"); */
  
  const body = document.querySelector("body"),
  sidebar = body.querySelector(".sidebar"),
  theme = body.querySelector(".theme");
  theme.addEventListener("click", () => {
      body.classList.toggle("dark");
/*       div.classList.toggle("bg-secondary"),
      div.classList.toggle("text-white");
 */      
     
  })
  
 
}
  


</script>



<script>
  
  /* const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");


toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () =>{
    sidebar.classList.remove("close");
})

modeSwitch.addEventListener("click" , () =>{
    body.classList.toggle("dark");
    
    if(body.classList.contains("dark")){
        modeText.innerText = "Light mode";
    }else{
        modeText.innerText = "Dark mode";
        
    }
}); */





let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
    let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
    arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
/*   console.log(sidebarBtn);
 */  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });

  </script>
