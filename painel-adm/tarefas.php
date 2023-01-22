<?php
require_once("verify.php");
require_once("../conexao.php");

$pagina = 'tarefas';
?>


<div class="col-md-12 my-5">

<a href="#" onclick="inserir()" type="button" class="btn btn-dark"> <i class="bi bi-person-plus"></i> Nova Tarefa</a>
</div>






  <div class="tabela table-responsive bg-ligth" id="Listar">
    
    <?php 
        $consulta = $pdo -> query("SELECT * FROM $pagina  ORDER BY status_tarefa asc, data_tarefa asc, hora_tarefa asc");
        $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        $total = count($result);
        if($total >0){
  
    
    ?>  

    <table id="exemplo" class="table table-bordered border-dark table-dark table-hover table-striped text-center  my-4 pt-4  " style="width:100%">
              <thead>

              <!-- Campos com os títudos dos registros do Data Table-->
                <tr>
                  <th>Título</th>
                  <th>Descrição</th>
                  <th>Data</th>
                  <th>Hora</th>
                  <th>Status</th>
                  <th>Ações</th>
              
                  </tr>
              </thead>
              <tbody>

              <!-- Script PHP conecntado ao Banco de dados para trazer os registros antes de ser inseridos na tabela (datatable)-->
              <?php 
                    for($i=0;$i < $total;$i++){
                        foreach($result[$i] as $key => $value){}

                        $id =  $result[$i]['id'];
                        $titulo_tarefa = $result[$i]['titulo'];
                        $descricao = $result[$i]['descricao'];
                        $data = $result[$i]['data_tarefa'];
                        $hora = $result[$i]['hora_tarefa'];
                        $status = $result[$i]['status_tarefa'];
                        $igreja = $result[$i]['igreja'];

                        $dataF = implode('/', array_reverse(explode('-',$data)));


                        if($status == 'Concluída'){
                          $classe = "text-success";
                          $titulo = "Reagendar Tarefa";
                          $icone = "bi-check-square";
                          $concluir = 'Agendada';
                          $inativo = "";

                        }
                        else{
                          $classe = "text-danger";
                          $titulo  = "Concluir Tarefa";
                          $icone = "bi-square";
                          $concluir = "Concluída";
                          $inativo = "text-muted";
                        }
                 
                ?>

                <!-- Data table com os registros trazidos do banco de dados-->
                <tr>
                      
                      <td> <small><i class="bi bi-circle-fill mr-5 <?php  echo $classe ?>"></i></small>  <?php echo $titulo_tarefa ; ?></td>
                      <td><?php echo $descricao ; ?></td>
                      <td><?php echo $dataF ; ?></td>
                      <td><?php echo $hora ; ?></td>
                      <td><?php echo $status ; ?></td>


                      <td>
                        <a href="#" class="text-primary" onclick="editar('<?php  echo $id ?>','<?php  echo $titulo_tarefa ?>','<?php  echo $descricao ?>','<?php  echo $data ?>','<?php  echo $hora ?>')" title="Editar Registro">
                        <i class="bi bi-pencil-square"></i>
                        </a>

                        <a href="#" class="text-danger" onclick="deletar('<?php  echo $id ?>','<?php  echo $descricao ?>')" >
                        <i class="bi bi-x-octagon-fill"></i>
                        </a>

                       <a href="#" class="text-warning" onclick="MudarStatus('<?php  echo $id ?>','<?php  echo $concluir?>')" title=" <?php echo $titulo; ?>" >
                        <i class="bi <?php  echo $icone ?> <?php  echo $classe ?>"></i> 
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
                Deseja Realmente Excluir o Resgistro: <br> <spam id="nome-excluido"></spam> ?

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
                       
               
              
              </div>
        
    </div>
  </div>
</div>


<!-- Janela Modal Para cadastrar e editar  resgistros-->

<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal"> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="form" method="post">
                  
                  <div class="modal-body">
                      
                          <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Título</label>
                                    <input type="text" class="form-control" maxlength="50" id="titulo" name="titulo" placeholder="Oração"   required="required">
                                  </div>
                          </div>

                          <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Descrição</label>
                                    <input type="text" class="form-control" maxlength="100" id="descricao" name="descricao" placeholder="Orar pela igreja" >
                                  </div>
                          </div>
                 
                        
                      <div class="row">
                              <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Hora</label>
                                    <input type="time" class="form-control" id="hora" name="hora" placeholder="00:00"   required="required">
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Data </label>
                                    <input type="date" class="form-control" id="data" name="data" value="<?php echo $data_atual; ?>" required="required">
                                  </div>
                              </div>
                      </div>
                      
                     


                      <input  type="hidden"  name="id" id="id" > </input>
                      <input  type="hidden"  name="igreja" id="igreja" value="<?php echo $id_igreja ?>"></input>

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



<script type="text/javascript">


function editar(id,titulo,descricao, data, hora){

    $('#id').val(id);
    $('#titulo').val(titulo);
    $('#descricao').val(descricao);
    $('#data').val(data);
    $('#hora').val(hora);

    

    
    $('#tituloModal').text('Editar Registro');
    var myModal = new bootstrap.Modal(document.getElementById('modalForm'),{

     });
     myModal.show();
     $('mensagem').text('');

}

$("#form").submit( function (){
    //console.log('Entrou');
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
            url: "tarefas/inserir.php",
            type: 'POST',
            data: formData,

            success: function(menssagem){
                $('mesagem').text('');
                $('mensagem').removeClass()
                if(menssagem.trim() == "Salvo com Sucesso"){
                      $('#btn-fechar').click()
                      window.location ='index.php?pag=tarefas'
                      
                  
                }else{
                      $('#mensagem').addClass('text-danger');
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
            url: "tarefas/excluir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem){
                $('mensagem-excluir').text('');
                $('mensagem-excluir').removeClass()
                if(mensagem.trim() == "Excluído com Sucesso"){
                      $('#btn-fechar-excluir').click()
                      window.location ='index.php?pag=tarefas'
                      
                  
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



  function MudarStatus(id, concluir){
    
    $.ajax({
        url: "tarefas/mudar-status.php",
        type: 'POST',
        data: {id,concluir},
        dataType : "text",

        success: function(menssagem){
                if(menssagem.trim == "Alterado com Sucesso"){
                  window.location ='index.php?pag=tarefas';
                }
        },

});
window.location ='index.php?pag=tarefas';

}



</script>




