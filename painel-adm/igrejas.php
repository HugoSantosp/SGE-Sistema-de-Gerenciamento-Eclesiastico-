<?php
require_once("verify.php");
require_once("../conexao.php");

$pagina = 'igrejas';
?>




<div class="col-md-12 my-5">

<a href="#" onclick="inserir()" type="button" class="btn btn-dark"> <i class="bi bi-person-plus"></i> Nova Igreja</a>
</div>






  <div class="tabela table-responsive bg-ligth" id="Listar">
    
    <?php 
        $consulta = $pdo -> query("SELECT * FROM $pagina ORDER BY id DESC");
        $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        $total = count($result);
        if($total >0){
  
    
    ?>  

    <table id="exemplo" class="table table-bordered border-dark table-dark table-hover table-striped  my-4 pt-4 table-responsive text-center" style="width:100%">
              <thead>

              <!-- Campos com os títudos dos registros do Data Table-->
                <tr>
                 
                  <th>Nome</th>
                  <th>Telefone</th>
                  <th>Endereço</th>
                  <th>Membros</th>
                  <th>Pastor Responsável</th>
                  <th>Ações</th>
                  </tr>
              </thead>
              <tbody>

              <!-- Script PHP conecntado ao Banco de dados para trazer os registros antes de ser inseridos na tabela (datatable)-->
              <?php 
                    for($i=0;$i < $total;$i++){
                        foreach($result[$i] as $key => $value){}

                        $id =  $result[$i]['id'];
                        $nome = $result[$i]['nome'];
                        $endereco = $result[$i]['endereco'];
                        $telefone = $result[$i]['telefone'];
                        $data_cad = $result[$i]['data_cad'];
                        $foto = $result[$i]['foto'];
                        $obs = $result[$i]['obs'];
                        $matriz = $result[$i]['matriz'];
                        $pastor = $result[$i]['pastor'];
                      
                    

                        $consulta3 = $pdo -> query("SELECT * FROM presbiteros WHERE  id = '$pastor'");
                        $result3 = $consulta3 -> fetchAll(PDO::FETCH_ASSOC);
                        $total3 = count($result3);
                        if($total3 > 0 ){
                            $nome_pastor = $result3[0]['nome'];
                        }else{
                          $nome_pastor = "Não Definido";
                        }
                        

                        $consulta4 = $pdo -> query("SELECT * FROM membros WHERE igreja = '$id'");
                        $result4 = $consulta4 -> fetchAll(PDO::FETCH_ASSOC);
                        $total4 = count($result4);
                        


                        // retirar quebra de linha do texto no campo observações
                         $obs = str_replace(array("\n","\r"), ' \n ', $obs);

                        $data_cadF = implode('/', array_reverse(explode('-',$data_cad)));
                                    
                ?>

                <!-- Data table com os registros trazidos do banco de dados-->
                <tr>
                      
                      <td><?php echo $nome ; ?></td>
                      <td><?php echo $telefone; ?></td>
                      <td><?php echo $endereco ; ?></td>
                      <td><?php echo $total4 ; ?></td>
                      <td><?php echo $nome_pastor ; ?></td>
                  
                      <td>
                        <a href="#" class="text-primary" onclick="editar('<?php  echo $id ?>','<?php  echo $nome ?>','<?php  echo $telefone ?>','<?php echo $endereco ?>','<?php echo $foto ?>', <?php echo $pastor ?> )" title="Editar Registro">
                        <i class="bi bi-pencil-square"></i>
                        </a>

                        <a href="#" class="text-danger" onclick="deletar('<?php  echo $id ?>','<?php  echo $nome ?>')" >
                        <i class="bi bi-x-octagon-fill"></i>
                        </a>

                        <a href="#" class="text-success" onclick="InfoDados('<?php  echo $nome ?>','<?php  echo $telefone ?>','<?php echo $endereco ?>','<?php echo $foto ?>','<?php echo $data_cadF ?>','<?php echo $matriz ?>','<?php echo $nome_pastor ?>' )" title="Mostrar Registro" >
                        <i class="bi bi-info-circle-fill"></i>
                        </a>

                        <a href="#" class="text-warning" onclick="Obs('<?php  echo $id ?>','<?php  echo $nome ?>','<?php  echo $obs ?>')" title="Observações" >
                        <i class="bi bi-card-list"></i>
                        </a>
                      

                        
                      </td>
                </tr>

              <?php } ?>
              </tbody>
      </table>
      <?php 
        }else {
          echo "Não existem dados na Tabela!";
        }
      ?>
  </div>



<!-- Janela Modal Para Exlcuir resgistros-->
<div class="modal" id="modalExcluir" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Excluir Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form id="form-excluir" method="POST">
              <div class="modal-body">
                Deseja Realmente Excluir o Resgistro: <spam id="nome-excluido"></spam> ? 

              <small><div id="mensagem-excluir"></div></small>

              <input type="hidden" class="form-control" name="id-excluir" id="id-excluir">

              </div>
        

        <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-excluir">Fechar</button>

        <button type="submit" class="btn btn-danger">Excluir</button>
      </div>
      </form> 
    </div>
  </div>
</div>

<!-- Janela Modal Para EXIBIR AS OBSERVAÇÕES-->

<div class="modal" id="modalObs" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Observações - <span id="nome-obs" class="text-primary"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form id="form-obs" method="POST">
              <div class="modal-body">
                    <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Observações - Máximo (500 Caractéres)</label>
                     </div>
                     <textarea class="form-control" name="obs" id="obs" maxlength="500" style="height: 250px;"></textarea>

              <small><div id="mensagem-obs"></div></small>

              <input type="hidden" class="form-control" name="id-obs" id="id-obs">

              </div>
        

        <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar-obs">Fechar</button>

        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
      </form> 
    </div>
  </div>
</div>


<!-- Janela Modal Para Exibir Resgistros-->
<div class="modal" id="modalDados" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span id="tituloModal"></span> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        
              <div class="modal-body">

                <span><b>Nome:</b>
                  <span id="nome-dados"></span>
                </span>
                <hr>
                <span><b>Telefone:</b>
                  <span id="telefone-dados"></span>
                </span>
                <hr>
                <span><b>Endereço: </b>
                    <span id="endereco-dados"></span>
                </span>
                <hr>
                <span><b>Data de Cadastro: </b>
                  <span id="data_cad-dados"></span>
                </span>
                <hr>
                <span><b>Ponto: </b>
                  <span id="matriz-dados"> </span>
                </span>
                <hr>
                <span><b>Pastor Responsável: </b>
                  <span id="pastor-dados"> </span>
                </span> 
                <hr>
                <span><b>Foto: </b>
                <div id="divImg" class="mt-3">
                     <img src="../img/img-user/sem-foto.jpg" id="target-dados" width="150px">
                </div>
                </span>
                <hr>

                
               
              
              </div>
        
    </div>
  </div>
</div>


<!-- Janela Modal Para cadastrar e editar  resgistros-->

<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal1"> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="form" method="post">
                  
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Igreja Pentencostal do Rio de Janeiro"   required="required">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua/Av C, n 613 - São João de Meriti/RJ " required="required">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="21 999999999"  required="required">
                              </div>                            
                          </div>
                          <div class="col-md-6">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Data Cadastro</label>
                                <input type="date" class="form-control" id="data_nasc" name="data_cad" value="<?php echo date('Y-m-d'); ?>" required="required">
                              </div>
                          </div>
                     </div>
                     <div class="row">

                     <div class="col-md-6">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="imagem" name="imagem" onchange="CarregarImagem();">

                                <div id="divImg" class="mt-3">
                                      <img src="../img/img-igreja/logorestitui.png" id="target" width="150px">
                                </div>
                              </div>
                          </div>

                            <div class="col-md-6">
                              <div class="mb-3">
                                <label for="inputState" class="form-label">Esta Igreja é Matriz ?</label>
                                <input type="text" class="form-control" id="matriz" name="matriz" placeholder="Digite sim ou não" maxlength="3">                              
                              </div>

                               <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pastor Responsável</label><br>
                                <select class="sel2 form-select" id="pastor" name="pastor" style="width: 100%">
                                <?php
                                      $consulta = $pdo -> query("SELECT * FROM presbiteros ORDER BY nome ASC");
                                      $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
                                      $total = count($result);
                                      if($total >0){
                                      
                                        for($i=0;$i < $total;$i++){
                                          foreach($result[$i] as $key => $value){}
                  
                                          $id_registro =  $result[$i]['id'];
                                          $nome_registro = $result[$i]['nome'];
                                          echo $id_registro;
                                         
                                        

                                
                                ?>
                                    <option value="<?php echo $id_registro?>"><?php echo $nome_registro ?></option>
                                    
                                <?php 
                                        }}
                                ?>
                                  </select>
                              </label>
                              </div>
                          </div>

                          
                          </div>

<!--                           <label for="exampleFormControlInput1" class="form-label">Matriz ?</label>
                                <input type="select" class="form-control" id="data_nasc" name="data_cad" value="<?php echo date('Y-m-d'); ?>" required="required">
 -->
                      <input  type="hidden"  name="id" id="id" > </input>

                        <small> <div class="text-center"  id="mensagem"></div> </small>

                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-fechar">Sair</button>
                          <button type="submit" class="btn btn-primary" >Salvar</button>
                      </div>
                   
                  </div>

             </form>           
         </div>
      </div>
    </div>




 
<!-- links para chamar o ajax  -->
<script type="text/javascript"></script>
<script src="../js/ajax.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">


function editar(id,nome,telefone,endereco,foto,matriz,pastor){

    $('#id').val(id);
    $('#nome').val(nome);
    $('#endereco').val(endereco);
    $('#telefone').val(telefone);
    $('#matriz').val(matriz);
    $('#pastor').val(pastor).change();
    $('#target').attr('src' , '../img/img-igreja/' + foto);
    

    
    $('#tituloModal1').text('Editar Registro');
    var myModal = new bootstrap.Modal(document.getElementById('modalForm'),{
      backdrop: 'static',
     });
     myModal.show();
     $('mensagem').text('');

}




function InfoDados(nome,telefone,endereco,foto,data_cad,matriz,pastor){
    
    $('#nome-dados').text(nome);
    $('#endereco-dados').text(endereco);
    $('#telefone-dados').text(telefone);
    $('#data_cad-dados').text(data_cad);
    if(matriz == 'Sim' || matriz == 'sim'){
      matriz = 'Matriz'
      $('#matriz-dados').text(matriz)
    }else{
      matriz = 'Filial'
      $('#matriz-dados').text(matriz)
    }
    $('#pastor-dados').text(pastor);
    $('#target-dados').attr('src' , '../img/img-igreja/' + foto);
    
    
    

    $('#tituloModal').text('Exibir Registro');
    var myModal = new bootstrap.Modal(document.getElementById('modalDados'),{
      backdrop: 'static',
     });
     myModal.show();
     $('mensagem').text('');

}
$("#form").submit( function (){
    //console.log('Entrou');
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
            url: "igrejas/inserir.php",
            type: 'POST',
            data: formData,

            success: function(menssagem){
                $('mesagem').text('');
                $('mensagem').removeClass()
                if(menssagem.trim() == "Salvo com Sucesso"){
                      $('#btn-fechar').click()
                      window.location ='index.php?pag=igrejas'
                      
                  
                }else{
                      $('#mesnagem').addClass('text-danger');
                      $('#mensagem').text(menssagem);
                      
                }
            },

            cache: false,
            contentType: false,
            processData : false,
    });


  });

  $("#form-excluir").submit( function (){
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
            url: "igrejas/excluir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem){
                $('mensagem-excluir').text('');
                $('mensagem-excluir').removeClass()
                if(mensagem.trim() == "Excluído com Sucesso"){
                      $('#btn-fechar-excluir').click()
                      window.location ='index.php?pag=igrejas'
                      
                  
                }else{
                      $('#mensagem-excluir').addClass('text-danger');
                      $('#mensagem-excluir').text(mensagem);
                      
                }
            },

            cache: false,
            contentType: false,
            processData : false,
    });


  });

  function Obs(id,nome,obs){
     
    $('#id-obs').val(id);
    $('#nome-obs').text(nome);
    $('#obs').val(obs);
        
  
    var myModal = new bootstrap.Modal(document.getElementById('modalObs'),{
      backdrop: 'static',
     });
     myModal.show();
     $('mensagem-obs').text('');

}
 
  $("#form-obs").submit( function (){
    //console.log('Entrou');
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
            url: "igrejas/obs.php",
            type: 'POST',
            data: formData,

            success: function(menssagem){
                $('mensagem-obs').text('');
                $('mensagem-obs').removeClass()
                if(menssagem.trim() == "Salvo com Sucesso"){
                      $('#btn-fechar-obs').click()
                      window.location ='index.php?pag=igrejas'
                   
                }else{
                      $('#mensagem-obs').addClass('text-danger');
                      $('#mensagem-obs').text(menssagem);
                      
                }
            },

            cache: false,
            contentType: false,
            processData : false,
    });


  });

function Limpar(){
  $('#id').val('');
    $('#nome').val('');
    $('#endereco').val('');
    $('#telefone').val('');
    $('#matriz').val('');
    $('#pastor').val('').change();
    $('#target').attr('src' , '../img/img-igreja/sem-foto.jpg' );
}




  $(document).ready(function() {
    $('.sel2').select2({
       dropdownParent: $('#modalForm')
    });
});
  
$(".js-example-responsive").select2({
    width: 'resolve', // need to override the changed default
    dropdownParent: $('#modalForm')
});


</script>




