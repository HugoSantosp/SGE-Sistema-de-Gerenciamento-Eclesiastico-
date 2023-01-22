<?php 

require_once('../conexao.php');

$IgrejasCadastradas = 0;
$MembrosSede = 0;
$PastoresCadastrados = 0;
$TotalMembros = 0;
$MembrosAtivos = 0;
$MembrosInativos = 0;


$consulta = $pdo -> query("SELECT * FROM igrejas");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$IgrejasCadastradas = count($result);


$consulta = $pdo -> query("SELECT * FROM presbiteros");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$PastoresCadastrados = count($result);


// Total de Membros Na igreja Mastriz
$consulta = $pdo -> query("SELECT * FROM membros WHERE igreja = 1");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$MembrosSede = count($result);


// Total de Membros em todas as igrejas cadastradas
$consulta = $pdo -> query("SELECT * FROM membros");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$TotalMembros = count($result);


// Solecionar os membros ativos de todas as igrejas cadastradas
$consulta = $pdo -> query("SELECT * FROM membros where situacao = 'Ativo'");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$MembrosAtivos = count($result);

$consulta = $pdo -> query("SELECT * FROM membros where situacao = 'Inativo'");
$result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
$MembrosInativos = count($result);


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
				<h4 class="text-uppercase"></h4>

			</div>
		</div> 
 -->


<!--1ª Seção com cards informativos  -->
		<div class="row mb-4">

			<div class="col-xl-3 col-sm-6 col-12">
				<a href="index.php?pag=igrejas" class="text-decoration-none text-dark">
				<div class="card shadow rounded-5  border-top-0 border-end-0 border-bottom-0 mt-2">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<div class="align-self-center col-3">
									<i class="bi bi-house-door text-success fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3> <span class="text-success"><?php echo @$IgrejasCadastradas ?></span></h3>
									<span>Igrejas Cadastradas</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				</a>
			</div>

			<div class="col-xl-3 col-sm-6 col-12 "> 
			<a href="index.php?pag=membros" class="text-decoration-none text-dark">
				<div class="card shadow rounded-5 border-top-0 border-end-0 border-bottom-0  mt-2">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<div class="align-self-center col-3">
									<i class="bi bi-people text-primary fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3> <span class="text-primary"><?php echo $MembrosSede ?></span></h3>
									<span>Membros da Sede</span>
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
									<i class="bi bi-people-fill text-warning fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3> <span class="text-warning"><?php echo @$PastoresCadastrados ?></span></h3>
									<span>Pastores Cadastrados</span>
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
									<h3><span class="text-info"><?php echo @$TotalMembros ?></span></h3>
									<span>Membros Cadastrados</span>
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
				<div class="card shadow rounded-5 border-5 border-top-0 border-end-0 border-bottom-0 border-danger mt-2">
					<div class="card-content">
						<div class="card-body">
							<div class="row">
								<!-- <div class="align-self-center col-3">
									<i class="bi bi-house-door text-success fs-1 float-start"></i>
								</div>
								<div class="col-9 text-end">
									<h3> <span class="text-success"><?php echo @$IgrejasCadastradas ?></span></h3>
									<span>Igrejas Cadastrados</span>
								</div> -->

							
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
        $consulta = $pdo -> query("SELECT * FROM membros ORDER BY id DESC");
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


<!--== Igrejas e Filiais  -->


		<div class="row mb-4 mt-4">

		<div class="text-xs font-weight-bold text-secondary text-uppercase mt-4">IGREJAS - SEDE E FILIAIS</div>
<hr> 

<?php



 $consulta = $pdo -> query("SELECT * FROM igrejas ORDER BY matriz desc, nome DESC");
 $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
 $total = count($result);
 
 for($i=0;$i < $total;$i++){
	foreach($result[$i] as $key => $value){}
	$id = $result[$i]['id'];
	$matriz = $result[$i]['matriz'];
	$nome = $result[$i]['nome'];
	$pastor = $result[$i]['pastor'];
	$id_ig = $result[$i]['id'];
	



	$consulta3 = $pdo -> query("SELECT * FROM presbiteros WHERE  id = '$pastor'");
	$result3 = $consulta3 -> fetchAll(PDO::FETCH_ASSOC);
	$total3 = count($result3);
	if($total3 > 0 ){
		$nome_pastor = $result3[0]['nome'];
	}else{
		$nome_pastor = "Não Definido";
	}


	$consulta4 = $pdo -> query("SELECT * FROM membros WHERE  igreja = '$id'");
	$result4 = $consulta4 -> fetchAll(PDO::FETCH_ASSOC);
	$total4 = count($result4);
	
	

?>


<div class="col-xl-3 col-md-6 mb-4 linkcard">
<a class="link card text-decoration-none" href="../painel-igreja/index.php?igreja=<?php echo $id?>">

			<div class="card text-danger shadow h-100 py-2  border-5 border-top-0 border-end-0 border-bottom-0 border-danger">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase"><?php echo $nome ?></div>
							<div class="text-xs text-secondary"> <?php if($nome_pastor == 'Não Definido' && $matriz == '1'){echo 'Pastor Presidente';}else{echo $nome_pastor;} ?> </div>
						</div>
						<div class="col-auto" align="center">
							<i class="far fa-calendar-alt fa-2x  text-danger"></i><br>
							<span class="text-xs"><?php echo $total4; ?></span>
						</div>
					</div>
				</div>
			</div>

</a>		</div>


<?php

 }
?>



		</div>


		<!--== Tarefas Agendas/Concluídas  -->


		<div class="row mb-4 mt-4">

		<div class="text-xs font-weight-bold text-secondary text-uppercase mt-4">Tarefas Agendadas</div>
<hr> 

<?php



 $consulta = $pdo -> query("SELECT * FROM tarefas WHERE igreja = 1 ORDER BY status_tarefa asc, hora_tarefa DESC");
 $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
 $total = count($result);


	
	
 
 for($i=0;$i < $total;$i++){
	foreach($result[$i] as $key => $value){}
	$id = $result[$i]['id'];
	$titulo = $result[$i]['titulo'];
	$descricao = $result[$i]['descricao'];
	$hora_tarefa = $result[$i]['hora_tarefa'];
	$data_tarefa = $result[$i]['data_tarefa'];
	$status_tarefa = $result[$i]['status_tarefa'];
	$id_igreja = $result[$i]['igreja'];
	


	
	$dataF = implode('/', array_reverse(explode('-',$data_tarefa)));



?>


<div class="col-xl-3 col-md-6 mb-4 linkcard">
<a class="link card text-decoration-none" href="index.php?pag=tarefas">

			<div class="card text-danger shadow h-100 py-2  border-5 border-top-0 border-end-0 border-bottom-0 <?php if($status_tarefa == 'Concluída'){echo'border-success';}elseif($status_tarefa == 'Agendado'){echo'border-warning';} ?>">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold <?php if($status_tarefa == 'Concluída'){echo'text-success';}elseif($status_tarefa == 'Agendado'){echo'text-warning';} ?> text-uppercase"><?php echo $titulo ;?></div>
							<div class="text-xs fw-lighter fst-italic"> <?php echo $descricao; ?> </div>
							<div class="text-xs text-secondary"> <?php echo $dataF.'/'.$hora_tarefa; ?> </div>
						</div>
						<div class="col-auto" align="center">
							<i class="far bi-calendar-check fa-2x  <?php if($status_tarefa == 'Concluída'){echo'text-success';}elseif($status_tarefa == 'Agendado'){echo'text-warning';} ?>"></i><br>
							<span class="text-xs  <?php if($status_tarefa == 'Concluída'){echo'text-success';}elseif($status_tarefa == 'Agendado'){echo'text-warning';} ?>"><?php echo  $status_tarefa; ?></span>
						</div>
					</div>
				</div>
			</div>

</a>		</div>


<?php

 }

?>



		</div>

