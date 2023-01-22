<?php 

require_once('../conexao.php');
require_once("verify.php");

$TotalOfertas = 0;
$PastoresCadastrados = 0;
$TotalMembros = 0;
$TotalDizimos = 0;
$TotalContas = 0;
$MembrosAtivos = 0;
$MembrosInativos = 0;

$consulta = $pdo -> query("SELECT * FROM membros where igreja = '$id_igreja' and situacao = 1  ");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$TotalMembros = count($result);

$consulta = $pdo -> query("SELECT * FROM membros where igreja = '$id_igreja' and situacao = 1 ");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$MembrosAtivos = count($result);

$consulta = $pdo -> query("SELECT * FROM membros where igreja = '$id_igreja' and situacao = 2 ");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$MembrosInativos = count($result);

$consulta = $pdo -> query("SELECT * FROM presbiteros where igreja = '$id_igreja'");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$PastoresCadastrados = count($result);


?>


<!-- GRÁFICOS EM JS(Java Script) -->

<script>

window.onload = function () {
	var membros1 =<?php echo $MembrosAtivos ?> ;
	var membros2 =<?php echo $MembrosInativos ?> ;

var chart = new CanvasJS.Chart("chartContainer", {
	
	animationEnabled: true,
	horizontalAlign: "left",
	legend:{
		cursor: "pointer",		
	},
	data: [{
		type: "doughnut",
		startAngle: 90,
		indexLabelFontSize: 14,
		showInLegend: true,
		toolTipContent: "<p>{name}</p> : {y} (#percent%)",
		indexLabel: "{y}",
		dataPoints: [
			{ y: membros1, name: "Membros Ativos" },
			{ y: membros2, name: "Membros Inativos" },

		]
	}]
});
chart.render();



}
</script>




<div class="container-fluid mt-3">
	<section id="minimal-statistics">
		
	
<!--  <div class="row mb-2">
			<div class="col-12 mt-3 mb-1">
				<h4 class="text-uppercase"><?php echo $nome_igreja2 ?></h4>

			</div>
		</div>  -->



<!--1ª Seção com cards informativos  -->
		<div class="row mb-4">

		<div class="col-xl-3 col-sm-6 col-12">
			<a href="index.php?pag=membros" class="text-decoration-none text-dark">
				<div class="card shadow rounded-5 border-top-0 border-end-0 border-bottom-0  mt-2">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<div class="align-self-center col-3">
									<i class="bi bi-person-square text-info fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3><span class="text-info"><?php echo @$TotalMembros ?></span></h3>
									<span>Membros Cadastrados</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
			</div>
			<div class="col-xl-3 col-sm-6 col-12">
			<a href="index.php?pag=membros" class="text-decoration-none text-dark">
				<div class="card shadow rounded-5 border-top-0 border-end-0 border-bottom-0  mt-2">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<div class="align-self-center col-3">
									<i class="bi bi-person-square text-info fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3><span class="text-info"><?php echo @$PastoresCadastrados ?></span></h3>
									<span>Pastores Cadastrados</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
			</div>


		<div class="col-xl-3 col-sm-6 col-12 linkcard"> 
			<a href="index.php?pag=presbiteros" class="text-decoration-none text-dark">
				<div class="card shadow rounded-5 border-top-0 border-end-0 border-bottom-0  mt-2">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<div class="align-self-center col-3">
									<i class="bi bi-piggy-bank text-warning fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3> <span class="text-warning"><?php echo "R$ ".@$TotalOfertas ?></span></h3>
									<span>Total de Ofertas do Mês</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
			</div>


			
			<div class="col-xl-3 col-sm-6 col-12">
			<a href="index.php?pag=membros" class="text-decoration-none text-dark">
				<div class="card shadow rounded-5 border-top-0 border-end-0 border-bottom-0  mt-2">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<div class="align-self-center col-3">
									<i class="bi bi-cash-coin text-success fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3><span class="text-success"><?php echo "R$ ".@$TotalDizimos ?></span></h3>
									<span>Total de Dízimos do Mês</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
			</div>
			<div class="col-xl-3 col-sm-6 col-12">
			<a href="index.php?pag=membros" class="text-decoration-none text-dark">
				<div class="card shadow rounded-5 border-top-0 border-end-0 border-bottom-0  mt-2">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<div class="align-self-center col-3">
									<i class="bi bi-cash-stack text-danger fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3><span class="text-danger"><?php echo "R$ ".@$TotalContas ?></span></h3>
									<span>Contas a Pagar do Mês</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</a>
			</div>

		</div>




		<div class="row">
		<div class="col-xl-5 col-sm-6 col-12 "> 
				<div class="card shadow rounded-5 border-5 border-top-0 border-end-0 border-bottom-0 border-primary mt-2">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
															
								<p class="text-center fs-5">Membros ativos e não ativos</p>
<div class="grafico"  id="chartContainer" style="height: 270px; width: 50%;"></div>



<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
							
								
								
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="col-xl-7 col-sm-6 col-12 "> 
				<div class="card shadow rounded-5 border-5 border-top-0 border-end-0 border-bottom-0 border-success mt-2">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
							<div class="col-6">
							<div class="fs-5">Lista de Membros </div>
								</div>
								
								<div class="col-6 text-end">
								<a class="btn btn-dark " href="index.php?pag=membros" ><i class="bi bi-person-square"></i> Cadastrar</a>

								</div>

								
  <div class=" table-responsive mt-4" id="Listar">
    
    <?php 
        $consulta = $pdo -> query("SELECT * FROM membros where igreja = '$id_igreja' ORDER BY id DESC");
        $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        $total = count($result);
		$i=0;

	
        if($total > 0){
			
			  
    
    ?>  

    <table id="exemplo" class="table border-start border-top border-end border-dark table-hover table-striped  table-responsive text-center" style="width:100%">
              <thead>

              <!-- Campos com os títudos dos registros do Data Table-->
                <tr>
                 
                  <th>Nome</th>
                  <th>Endereço</th>
                  <th>Telefone</th>
                  <th>Cargo Eclesiástico</th>
                  <th>Status</th>
                  
                  </tr>
              </thead>
              <tbody>

              <!-- Script PHP conecntado ao Banco de dados para trazer os registros antes de ser inseridos na tabela (datatable)-->
              <?php 
			if($total < 5 ){
				echo " Precisa de Pelo menos 5 Membros resgistrados <br> ";
			}else{
                    while($i < 5){
                        
						foreach($result[$i] as $key => $value){} 						 
						$id =  $result[$i]['id'];
                        $nome = $result[$i]['nome'];
                        $documento = $result[$i]['documento'];
                        $endereco = $result[$i]['endereco'];
                        $telefone = $result[$i]['telefone'];
                        $data_nasc = $result[$i]['data_nasc'];
                        $data_cad = $result[$i]['data_cad'];
                        $foto = $result[$i]['foto'];
                        $igreja = $result[$i]['igreja'];
                        $situacao = $result[$i]['situacao'];
                        $funcao = $result[$i]['funcao'];


						  if($situacao == 1){$situacao = "Ativo";}else{$situacao = "Inativo";}

                        $consulta3 = $pdo -> query("SELECT * FROM igrejas WHERE id = '$igreja'");
                        $result3 = $consulta3 -> fetchAll(PDO::FETCH_ASSOC);
                        $total3 = count($result3);
                        if($total3 > 0 ){
                            $nome_church = $result3[0]['nome'];
                        }else{
                          $nome_church = $nome_igreja;
                        }

                        $consulta4 = $pdo -> query("SELECT * FROM cargos WHERE id = '$funcao'");
                        $result4 = $consulta4 -> fetchAll(PDO::FETCH_ASSOC);
                        $total4 = count($result4);
                        if($total4 > 0 ){
                            $nome_funcao = $result4[0]['nome'];
                        }else{
                          $nome_funcao =  $nome_cargo;
                        }


                        // retirar quebra de linha do texto no campo observações
                         //$obs = str_replace(array("\n","\r"), ' \n ', $obs);

                        $data_nascF = implode('/', array_reverse(explode('-',$data_nasc)));
                        $data_cadF = implode('/', array_reverse(explode('-',$data_cad)));
                        

                      
                                    
                ?>

                <!-- Data table com os registros trazidos do banco de dados-->
                <tr>
                      
                      <td><?php echo $nome ; ?></td>
                      <td><?php echo $endereco ; ?></td>
                      <td><?php echo $telefone; ?></td>
                      <td><?php echo $nome_funcao; ?></td> 
                      <td><?php echo $situacao; ?></td>
                </tr>

              <?php $i ++; }}?>
              </tbody>
      </table>
      <?php 
        }else{
          echo "Não existem dados na Tabela!";
        }
	
	
      ?>
  </div>
										
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> 



		</section>
</div>


<!-- DIVISÃO COM OS CARDS DAS IGREJAS CADASTRADAS -->


		<div class="row mb-4 mt-4">

		<div class="text-xs font-weight-bold text-secondary text-uppercase mt-4 fs-2">Agendas / Tarefas</div>
<hr> 

<?php



 $consulta = $pdo -> query("SELECT * FROM tarefas where igreja = '$id_igreja' ORDER BY status_tarefa asc, hora_tarefa DESC LIMIT $quantidade_tarefas");
 $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
 $total = count($result);

 
 
  if($total == 0){
	 echo '<div class="text-xs font-weight-bold text-secondary text-uppercase mt-4 fs-3">Não Há tarefas agendadas.</div>';
 }else{
 for($i=0;$i<$total;$i++){
	foreach($result[$i] as $key => $value){}
	$id =  $result[$i]['id'];
	$titulo_tarefa = $result[$i]['titulo'];
	$descricao = $result[$i]['descricao'];
	$data = $result[$i]['data_tarefa'];
	$hora = $result[$i]['hora_tarefa'];
	$status = $result[$i]['status_tarefa'];
	$igreja = $result[$i]['igreja'];
	
	$dataF = implode('/', array_reverse(explode('-',$data)));

	if($dataF < $data_atual  && ($status != 'Concluída')){
		$status = 'Atrasado';
	}if($dataF < $data_atual  && ($status != 'Agendado')){
		
	}

?>


<div class="col-xl-3 col-md-6 mb-4">
<a class="link card text-decoration-none" href="tarefas.php">
			<div class="card text-danger shadow h-100 py-2  border-5 border-top-0 border-end-0 border-bottom-0 <?php if($status == 'Concluída'){echo'border-success';}elseif($status == 'Agendado'){echo'border-primary';}elseif($status == 'Atrasado'){echo'text-danger';} ?>">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-uppercase  <?php if($status == 'Concluída'){echo'text-success';}elseif($status == 'Agendado'){echo'text-primary';}elseif($status == 'Atrasado'){echo'text-danger';} ?>"><?php echo $titulo_tarefa ?></div>
							<div class="text-xs text-secondary"> <?php echo $descricao; ?> </div>
							<div class="text-xs text-secondary "> <?php echo $data_atual.'  '.$dataF.'/'.$hora; ?> </div>
						</div>
						<div class="col-auto" align="center">
						<i class="bi bi-calendar-check fs-1  <?php if($status == 'Concluída'){echo'text-success';}elseif($status == 'Agendado'){echo'text-primary';}elseif($status == 'Atrasado'){echo'text-danger';} ?>"></i><br>
						<span class="text-xs  <?php if($status == 'Concluída'){echo'text-success';}elseif($status == 'Agendado'){echo'text-primary';}elseif($status == 'Atrasado'){echo'text-danger';} ?>"><?php echo  $status; ?></span>
						</div>
					</div>
				</div>
			</div>

</a>		</div>


<?php
 }
}
 
?>



		</div>


		