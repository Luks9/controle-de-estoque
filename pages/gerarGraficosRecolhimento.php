<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/funcoesMaterias.php');
?>
	<head>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="../resources/plugins/morris/morris.css">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Gráficos<small>Recolhimentos</small></h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Recolhimento</a></li>
						<li class="active">Cadastrar Recolhimento KIT</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
				<!-- CHARTS PARA RECOLHIMENTO  -->
					<div class="col-md-13">

						<div class="row">
			

			<div class="col-xs-6">
			<?php
				$meses = array(
			    '01'=>'Janeiro',
			    '02'=>'Fevereiro',
			    '03'=>'Março',
			    '04'=>'Abril',
			    '05'=>'Maio',
			    '06'=>'Junho',
			    '07'=>'Julho',
			    '08'=>'Agosto',
			    '09'=>'Setembro',
			    '10'=>'Outubro',
			    '11'=>'Novembro',
			    '12'=>'Dezembro'
			);
			   $mes = $meses[date('m')];
			?>
			<div class="box box-warning">
                <div class="box-header with-border" >
                  <h3 class="box-title">Gráfico de Recolhimentos: <?php echo $mes; ?> <i class="fa fa-envelope-o" 
                  data-toggle="popover" data-placement="rigth" data-content="Gráfico de Recolhimento: estatística‎ dos motivos do recolhimento por mês"></i> </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <canvas id="pieChart" style="height:250px"></canvas>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
             </div><!-- /.row -->
                  <div class="col-xs-6">
      <?php
        $meses = array(
          '01'=>'Janeiro',
          '02'=>'Fevereiro',
          '03'=>'Março',
          '04'=>'Abril',
          '05'=>'Maio',
          '06'=>'Junho',
          '07'=>'Julho',
          '08'=>'Agosto',
          '09'=>'Setembro',
          '10'=>'Outubro',
          '11'=>'Novembro',
          '12'=>'Dezembro'
      );
         $mes = $meses[date('m')];
      ?>
      <div class="box box-primary">
                <div class="box-header with-border" >
                  <h3 class="box-title">Equipamentos Recolhidos: <?php echo $mes; ?> <i class="fa fa-envelope-o" 
                  data-toggle="popover" data-placement="rigth" data-content="Gráfico de todos os equipamentos recolhidos por mês."></i> </h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <div class="chart" id="sales-chart" style="height: 255px;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
             </div><!-- /.row -->

			</div><!-- /.col-md-13 -->

				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Versão</b> 1.3.0
				</div>
				<strong>Copyright © 2016 <a href="http://www.brisanet.com.br">SAS - Brisanet Telecomunicações</a>.</strong>
			</footer>
		</div><!-- ./resources/wrapper -->
							

		<script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../resources/dist/js/app.min.js"></script>
		<script src="../resources/dist/js/function_tecnico_recolhimento2.js"></script>
		<!-- jQuery UI 1.11.4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../resources/plugins/morris/morris.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.js"></script>
		<script src="../resources/plugins/iCheck/icheck.min.js"></script>
    <script src="../resources/plugins/chartjs/Chart.min.js"></script>
		</script>


    <script type="text/javascript">
    $(function () {
      $('[data-toggle="popover"]').popover()
    })
    </script>

				<script>
			$(function () {
				$("#tabelaRecolhimentoKIT").DataTable();
			});
		</script>

		<script type="text/javascript">
		$(function () {
		
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        		      // Criamos uma Var
        		var TotalAlteracao = "";
        		      // Usamos os metodo getJson para solicitar informações da nossa base de dados  
              	$.getJSON('solicitacoes.ajax2.php?search=',{
						valor: TotalAlteracao, 
						ajax: 'listarRecolhimento',
						}, 
					function(TotalAlteracao){
					
					   // Trazemos os dados com o metodo AJAX
					   // Array para preencher o Gráfico Pizza
					var PieData = [

			          {

			            value: TotalAlteracao[0].totalcount,
			            color: "#f56954",
			            highlight: "#f56954",
			            label: TotalAlteracao[0].motivo
			          },
			          {
			            value: TotalAlteracao[1].totalcount,
			            color: "#00a65a",
			            highlight: "#00a65a",
			            label: TotalAlteracao[1].motivo
			          },
			          {
			            value: TotalAlteracao[2].totalcount,
			            color: "#f39c12",
			            highlight: "#f39c12",
			            label: TotalAlteracao[2].motivo
			          },
			         	{
			            value: TotalAlteracao[3].totalcount,
			            color: "#0073b7",
			            highlight: "#0073b7",
			            label: TotalAlteracao[3].motivo
			          }
			           // destrichemos o array[1,2,3,4], e assim resolvemos o problema //
			        ];

			        var pieOptions = {
			          //Boolean - Whether we should show a stroke on each segment
			          segmentShowStroke: true,
			          //String - The colour of each segment stroke
			          segmentStrokeColor: "#fff",
			          //Number - The width of each segment stroke
			          segmentStrokeWidth: 2,
			          //Number - The percentage of the chart that we cut out of the middle
			          percentageInnerCutout: 50, // This is 0 for Pie charts
			          //Number - Amount of animation steps
			          animationSteps: 100,
			          //String - Animation easing effect
			          animationEasing: "easeOutBounce",
			          //Boolean - Whether we animate the rotation of the Doughnut
			          animateRotate: true,
			          //Boolean - Whether we animate scaling the Doughnut from the centre
			          animateScale: false,
			          //Boolean - whether to make the chart responsive to window resizing
			          responsive: true,
			          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			          maintainAspectRatio: true,
			          //String - A legend template
			          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
			        };

					pieChart.Doughnut(PieData, pieOptions)
					});


            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
        

        });
        </script>
        <script type="text/javascript">
      $(function () {
        "use strict";
        //DONUT CHART

                          // Criamos uma Var
        var totalEquipamento = "";
                  // Usamos os metodo getJson para solicitar informações da nossa base de dados  
          $.getJSON('solicitacoes.ajax2.php?search=',{
           valor: totalEquipamento, 
           ajax: 'listarEquipamentosRecolhidos',
            }, 
          function(totalEquipamento){

        console.log(totalEquipamento);
        if (totalEquipamento[0].equipamento == 3) {
            totalEquipamento[0].equipamento = 'SetupBox';
        }
        if(totalEquipamento[2].equipamento == 1) {
            totalEquipamento[2].equipamento = 'Rádio';
        }
        if(totalEquipamento[3].equipamento == 2) {
            totalEquipamento[3].equipamento = 'Onu';
        }

        var donut = new Morris.Donut({
          element: 'sales-chart',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a", "#f39c12"],
          data: [
            {label: totalEquipamento[1].equipamento, value: totalEquipamento[1].totalcount,},
            {label: totalEquipamento[2].equipamento, value: totalEquipamento[2].totalcount,},
            {label: totalEquipamento[3].equipamento, value: totalEquipamento[3].totalcount,},
          ],
          hideHover: 'auto'
              });
           });
        });

        </script>

	</body>
</html>
