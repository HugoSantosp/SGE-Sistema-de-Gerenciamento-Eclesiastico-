<?php
require_once("verify.php");
require_once("../conexao.php");

$pagina = 'pagar';
?>


<!-- links para chamar o ajax  -->
<script type="text/javascript"></script>
<script src="../js/ajax.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<div class="col-md-12 my-5 ">


<a href="#" onclick="inserir()" type="button" class="btn btn-dark"> <i class="bi bi-person-plus"></i> Nova Conta</a>
</div>






  <div class="tabela table-responsive" id="Listar">
    
    <?php 
        $consulta = $pdo -> query("SELECT * FROM $pagina where igreja = '$id_igreja' ORDER BY id DESC");
        $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        $total = count($result);
        if($total >0){
  
    
    ?>  

    <table id="exemplo" class="table table-bordered border-dark table-dark table-hover table-striped  my-4 pt-4 table-responsive" style="width:100%">
              <thead>

              <!-- Campos com os títudos dos registros do Data Table-->
                <tr>
                 
                  <th>Descrição</th>
                  <th>Fornecedor</th>
                  <th>Valor</th>
                  <th>Data de Vencimento</th>
                  <th>Frequencia</th>
                  <th>Arquivo</th>
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
                        $descricao = $result[$i]['descricao'];
                        $fornecedor = $result[$i]['fornecedor'];
                        $valor = $result[$i]['valor'];
                        $vencimento = $result[$i]['vencimento'];
                        $frequencia = $result[$i]['frequencia'];
                        $usuario_cad = $result[$i]['usuario_cad'];
                        $arquivo = $result[$i]['arquivo'];
                        $usuario_baixa = $result[$i]['usuario_baixa'];
                        $status = $result[$i]['status'];
                        $data_cad = $result[$i]['data_cad'];
                        $data_baixa = $result[$i]['data_baixa'];
                        $igreja = $result[$i]['igreja'];


                        $consulta3 = $pdo -> query("SELECT * FROM fornecedores WHERE id = '$fornecedor'");
                        $result3 = $consulta3 -> fetchAll(PDO::FETCH_ASSOC);
                        $total3 = count($result3);
                        if($total3 > 0 ){
                            $nome_for = $result3[0]['nome'];
                        }else{
                          $nome_for = 'Sem fornecedor';
                        }

                        $consulta4 = $pdo -> query("SELECT * FROM usuários WHERE id = '$usuario_cad'");
                        $result4 = $consulta4 -> fetchAll(PDO::FETCH_ASSOC);
                        $total4 = count($result4);
                        if($total4 > 0 ){
                            $nome_usuario_cad = $result4[0]['nome'];
                        }else{
                          $nome_usuario_cad =  '';
                        }

                        
                        $consulta4 = $pdo -> query("SELECT * FROM usuários WHERE id = '$usuario_baixa'");
                        $result4 = $consulta4 -> fetchAll(PDO::FETCH_ASSOC);
                        $total4 = count($result4);
                        if($total4 > 0 ){
                            $nome_usuario_baixa = $result4[0]['nome'];
                        }else{
                          $nome_usuario_baixa =  '';
                        }

                        $valorF = number_format($valor,2,',','.');
                        $data_baixaF = implode('/', array_reverse(explode('-',$data_baixa)));
                        $data_cadF = implode('/', array_reverse(explode('-',$data_cad)));
                        $vencimentoF = implode('/', array_reverse(explode('-',$vencimento)));
                ?>

                <!-- Data table com os registros trazidos do banco de dados-->
                <tr>
                      
                      <td><?php echo $descricao ; ?></td>
                      <td><?php echo $nome_for ?></td>
                      <td><?php echo $valorF ; ?></td>
                      <td><?php echo $vencimentoF ; ?></td>
                      <td><?php echo $frequencia; ?></td>
                      <td><?php echo $arquivo; ?></td> 
                      <td><?php echo $status; ?></td>
                      <td>
                        <a href="#" class="text-primary" onclick="editar('<?php  echo $id ?>','<?php  echo $nome ?>','<?php  echo $telefone ?>','<?php echo $documento ?>','<?php echo $endereco ?>','<?php echo $foto ?>','<?php echo $data_nasc ?>','<?php echo $igreja ?>','<?php echo $nome_church ?>','<?php echo $situacao ?>','<?php echo $nome_funcao ?>','<?php echo $data_batismo ?>')" title="Editar Registro">          
                        <i class="bi bi-pencil-square"></i>
                        </a>

                        <a href="#" class="text-danger" onclick="deletar('<?php  echo $id ?>','<?php  echo $nome ?>')" >
                        <i class="bi bi-x-octagon-fill"></i>
                        </a>

                        <a href="#" class="text-success" onclick="InfoDados('<?php  echo $nome ?>','<?php  echo $telefone ?>','<?php echo $documento ?>','<?php echo $endereco ?>','<?php echo $foto ?>','<?php echo $data_nascF ?>','<?php echo $data_cadF ?>','<?php echo $nome_church ?>','<?php echo $situacao ?>','<?php echo $nome_funcao?>','<?php echo $data_batismoF ?>')" title="Mostrar Registro" >
                        <i class="bi bi-info-circle-fill"></i>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Observações <span id="nome-obs"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form id="form-obs" method="POST">
              <div class="modal-body">
                    <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Observações</label>
                     </div>
                     <textarea class="form-control" name="obs" id="obs" maxlength="500"></textarea>

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

                <span><b>Descrição:</b>
                  <span id="descricao-dados"></span>
                </span>
                <hr>
                <span><b>Fornecedor: </b>
                  <span id="fornecedor-dados"></span>
                </span>
                <hr>
                <span><b>Valor: </b>
                  <span id="valor-dados"></span>
                </span>
                <hr>
                <span><b>Data de Vencimento: </b>
                  <span id="vencimento-dados"></span>
                </span>
                <hr>
                <span><b>Cadastrado Por: </b>
                  <span id="usuario_cad-dados"></span>
                </span>
                <hr>
                <span><b>Baixa Efetuada Por: </b>
                  <span id="usuario_baixa-dados"></span>
                </span>
                <hr>
               
                <span><b>Data de Baixa: </b>
                  <span id="data_baixa-dados"></span>
                </span>
                <hr>
                <span><b>Frequencia de Pagamento: </b>
                    <span id="frequencia-dados"></span>
                </span>
                <hr>
                <span><b>Status:</b>
                  <span id="status-dados"></span>
                </span>
                <hr>
                <span><b>Igreja:</b>
                  <span id="igreja-dados"></span>
                </span>
                <hr>
                <span><b>Arquivo: </b>
                <div id="divImg" class="mt-3">
                     <img src="../img/contas/sem-foto.png" id="target-dados" width="150px">
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
                          <div class="col-md-5">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Descrição</label>
                                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descreva o Produto/Serviço"   required="required">
                              </div>
                          </div>
                          <div class="col-md-4">
                          <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Fornecedor</label><br>
                                <select class="form-select" id="fornecedor" name="fornecedor" style="width: 100%">
                                <option  value="null" selected>Escolha uma opção</option>
                                
                                <?php
                                      $consulta2 = $pdo -> query("SELECT * FROM fornecedores  ORDER BY nome ASC");
                                      $result = $consulta2 -> fetchAll(PDO::FETCH_ASSOC);
                                      $total = count($result);
                                      if($total >0){
                                      
                                        for($i=0;$i < $total;$i++){
                                          foreach($result[$i] as $key => $value){}
                  
                                          $id_funcao =  $result[$i]['id'];
                                          $nome_funcao = $result[$i]['nome'];

                                
                                ?>
                                    
                                    <option  value="<?php echo $id_funcao?>"><?php echo $nome_funcao ?></option>
                                <?php 
                                        }}
                                ?>
                                  </select>
                              </label>
                              </div>                             
                             
                          </div>
                          <div class="col-md-3">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Valor</label>
                                <input type="text" class="form-control" id="valor" name="valor" placeholder="R$ 00,00 " required="required">
                              </div>
                              
                          </div>
                      </div>
                      
                      <div class="row">
                      <div class="col-md-4">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Data  de Vencimento</label>
                                <input type="text" class="form-control" id="vencimento" name="vencimento" placeholder="dd/mm/aaaa"  required="required">
                              </div>                            
                          </div>
                      <div class="col-md-4 ">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Frequencia</label>
                                <select class="form-select " id="frequencia" name="frequencia" style="width: 100%">
                                <option  value="null" selected>Escolha uma opção</option>
                                    <option value="0">Uma Vez</option>
                                    <option value="1">Diária</option>
                                    <option value="7">Semanal</option>
                                    <option value="30">Mensal</option>
                               
                                  </select>
                              </div>
                              
                          </div>
                         
                      </div>
                   
                     
                     <div class="row">
                    

                        <div class="col-md-6">
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Arquivo</label>
                                <input type="file" class="form-control" id="arquivo" name="arquivo" onchange="CarregarImagem();">

                           
                              </div>
                          </div>

                          <div class="col-md-6">
                             <div class="col-md-8">
                              <div class="mb-3">
                              <div id="divImg" class="mt-3">
                                      <img src="../img/contas/sem-foto.png" id="target" width="150px">
                                </div>
                              </div>
                               </div>

                            
                          </div>
                      </div>
                     

                      <input  type="hidden"  name="id" id="id" > </input>
                      <input  type="hidden"  name="igreja" id="igreja2" value="<?php echo $id_igreja; ?>"> </input>

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




 <!-- Script JavaScript  -->


<script type="text/javascript">


function editar(id,descricao,fornecedor,valor,vencimento,arquivo,frequencia,igreja)
{

    $('#id').val(id);
    $('#descricao').val(descricao);
    $('#fornecedor').val(fornecedor).change();
    $('#valor').val(valor);
    $('#vencimento').val(vencimento);
    $('#frequencia').val(frequencia).change();
    $('#igreja').val(igreja);
    $('#target').attr('src' , '../img/contas/' + arquivo);
    

    
    $('#tituloModal1').text('Editar Registro');
    var myModal = new bootstrap.Modal(document.getElementById('modalForm'),{
      backdrop: 'static',
     });
     myModal.show();
     $('mensagem').text('');

}




function InfoDados(descricao,fornecedor,valor,arquivo,data_cad,vencimento,igreja,usuario_cad,usuario_baixa,data_baixa,frequencia,status)
{
    
    $('#descricao-dados').text(descricao);
    $('#fornecedor-dados').text(fornecedor);
    $('#valor-dados').text(valor);
    $('#telefone-dados').text(telefone);
    $('#vencimento-dados').text(vencimento);
    $('#data_cad-dados').text(data_cad);
    $('#usuario_cad-dados').text(usuario_cad);  
    $('#igreja-dados').text(igreja);
    $('#usuario_baixa-dados').text(usuario_baixa);
    $('#data_baixa-dados').text(data_baixa);
    $('#frequencia-dados').text(frequencia);
    $('#status-dados').text(status);
    $('#target-dados').attr('src' , '../img/contas/' + arquivo);
    
  

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
            url: "pagar/inserir.php",
            type: 'POST',
            data: formData,

            success: function(menssagem){
                $('mesagem').text('');
                $('mensagem').removeClass()
                if(menssagem.trim() == "Salvo com Sucesso"){
                      $('#btn-fechar').click()
                      window.location ='index.php?pag=pagar'
                      
                  
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
            url: "pagar/excluir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem){
                $('mensagem-excluir').text('');
                $('mensagem-excluir').removeClass()
                if(mensagem.trim() == "Excluído com Sucesso"){
                      $('#btn-fechar-excluir').click()
                      window.location ='index.php?pag=pagar'
                      
                  
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
            url: "pagar/obs.php",
            type: 'POST',
            data: formData,

            success: function(menssagem)
            {
                $('mensagem-obs').text('');
                $('mensagem-obs').removeClass()
                if(menssagem.trim() == "Salvo com Sucesso"){
                      $('#btn-fechar-obs').click()
                      window.location ='index.php?pag=pagar'
                   
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

  $(document).ready(function()
  {
    $('.sel2').select2({
       dropdownParent: $('#modalForm')
    });
});
  
$(".js-example-responsive").select2(
  {
    width: 'resolve', // need to override the changed default
    dropdownParent: $('#modalForm')
});



//LIMPA OS CAMPOS PARA QUE SEJA ESCRITO OUTROS DADOS

function Limpar()
{
    $('#id').val('');
    $('#descricao').val('');
    $('#fornecedor').val('').options.selectedindex = 'null';
    $('#valor').val('');
    $('#vencimento').val('');
    $('#frequencia').val('').options.selectedindex = 'null';
    $('#igreja').val('');
    $('#target').attr('src' , '../img/contas/sem-foto.png');
}





</script>




