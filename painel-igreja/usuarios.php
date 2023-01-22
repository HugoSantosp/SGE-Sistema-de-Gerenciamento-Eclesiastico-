<?php
require_once("verify.php");
require_once("../conexao.php");

$pagina = 'usuario';
?>




  <div class="tabela table-responsive bg-ligth" id="Listar">
    
    <?php 
        $consulta = $pdo -> query("SELECT * FROM $pagina where igreja = '$id_igreja' ORDER BY id DESC");
        $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        $total = count($result);
        if($total >0){
  
    
    ?>  

    <table id="exemplo" class="table table-bordered border-dark table-dark table-hover table-striped  my-4 pt-4  " style="width:100%">
              <thead>

              <!-- Campos com os títudos dos registros do Data Table-->
                <tr>
                 
                  <th>Nome</th>
                  <th>Documento</th>
                  <th>Email</th>
                  <th>Igreja</th>
                  <th>Senha</th>
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
                        $documento = $result[$i]['documento'];
                        $email = $result[$i]['email'];
                        $senha = $result[$i]['senha'];
                        $igreja = $result[$i]['igreja'];
                        
                ?>

                <!-- Data table com os registros trazidos do banco de dados-->
                <tr>
                      
                      <td><?php echo $nome ; ?></td>
                      <td><?php echo $documento ?></td>
                      <td><?php echo $email; ?></td>
                      <td><?php echo $igreja; ?></td>
                      <td><?php echo $senha; ?></td>
                      <td>
                        <a href="#" class="text-primary" onclick="editar('<?php  echo $id ?>','<?php  echo $nome ?>','<?php  echo $senha ?>')" title="Editar Senha">
                        <i class="bi bi-pencil-square"></i>
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
                      
                      <div class="row">
                          <div class="col-md-6">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Senha</label>
                                <input type="text" class="form-control" id="senha" name="senha" placeholder="21 999999999"  required="required">
                              </div>
                          </div>

                      </div>


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



<script type="text/javascript">


function editar(id,nome,senha,){

    $('#id').val(id);
    $('#nome').val(nome);
    $('#senha').val(senha);

    

    
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
            url: "usuarios/inserir.php",
            type: 'POST',
            data: formData,

            success: function(menssagem){
                $('mesagem').text('');
                $('mensagem').removeClass()
                if(menssagem.trim() == "Salvo com Sucesso"){
                      $('#btn-fechar').click()
                      window.location ='index.php?pag=usuarios'
                      
                  
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



  

</script>




