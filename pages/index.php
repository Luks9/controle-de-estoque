<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/FuncoesDinamicas.php');
	if ($setorUsuario == 'Técnico Externo') {
		header('location: ./ ');
	}
?>
<head>
<script src="../resources/plugins/jQuery/timer.jquery.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<link rel="stylesheet" href="../resources/plugins/morris/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
      	<form id="deash" type="get">
      		 <div class="box">
      		 	<div class="box-header with-border">
	              	<h3 class="box-title">Selecione as opções</h3>
              	</div>
              	 <div class="box-body">
		      		<div class="col-md-3 col-sm-6 col-xs-12">
			      		<select name="cidade" class="form-control">
			      		<option value="geral">Geral</option>
			      		<?php
			  				require ('../server/conectarBD.php');
							$usuarioLogado = $_SESSION['nome_usuario'];
							$stmt = $conexao_pdo->prepare("SELECT DISTINCT cidade FROM t_instalacoes");
							$stmt->execute();
							$result = array();
							while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
								$result[] = $r;
								echo "<option value=".$r['cidade'].">".$r['cidade']."</option>";
							}
						?>
			      		</select>
		      		</div>
		      		<div class="col-md-3 col-sm-6 col-xs-12">
			      		<input type="date" id="data1" name="data1" required="" class="form-control">
		      		</div>
		      		<div class="col-md-3 col-sm-6 col-xs-12">
			      		<input type="date" id="data2" name="data2" required="" class="form-control">
		      		</div>
		      		<span class="input-group-btn">
						<button type="button" name="go" id="go" class="btn btn-primary" onclick="deashBoard()" data-toggle="tooltip" data-placement="right" title="Atualizar página para cada nova pesquisa."><i class="ion ion-stats-bars"></i></button>
					</span>
	      		</div>
      		 </div>
      	</form>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="#"><span id="span1" class="info-box-icon bg-green" data-toggle="modal" data-target="#modal_info" onclick="tabelas(1)"><i class="ion ion-plus-circled"></i></span></a>

            <div class="info-box-content">
              <span class="info-box-text">Novas Instalações</span>
              <span class="info-box-number" id="newInst"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="#"><span class="info-box-icon bg-aqua" data-toggle="modal" data-target="#modal_info" onclick="tabelas(2)"><i class="ion-wrench"></i></span></a>

            <div class="info-box-content">
              <span class="info-box-text">Suportes</span>
              <span class="info-box-number" id="supp"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="#"><span class="info-box-icon bg-yellow" data-toggle="modal" data-target="#modal_info" onclick="tabelas(3)"><i class="ion-refresh"></i></span></a>

            <div class="info-box-content">
              <span class="info-box-text">Troca de Tecnologia</span>
              <span class="info-box-number" id="troca"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="#"><span class="info-box-icon bg-red" data-toggle="modal" data-target="#modal_info" onclick="tabelas(4)"><i class="ion-close-circled"></i></span></a>

            <div class="info-box-content">
              <span class="info-box-text">Cancelamento</span>
              <span class="info-box-number" id="cancel"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Instalações - Tecnologia</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>FTTH - Radio - TV</strong>
                  </p>

              	<div class="box-body chart-responsive" id="div_area">
                  <div class="chart" id="revenue-chart" style="height: 180px;"></div>
                </div><!-- /.box-body -->
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Ranking de Instalações - Técnicos</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text" id="text0">Tecnico 1</span>
                    <span class="progress-number" id="total0" ><b>0</b>/0</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" id="valor0" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group" >
                    <span class="progress-text" id="text1">Tecnico 2</span>
                    <span class="progress-number" id="total1"><b>0</b>/0</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" id="valor1" style="width: 50%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text" id="text2">Tecnico 3</span>
                    <span class="progress-number" id="total2"><b>0</b>/0</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" id="valor2"  style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text" id="text3">Tecnico 4</span>
                    <span class="progress-number" id="total3"><b>0</b>/0</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" id="valor3" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
    </section>
    <!-- /.content -->
  </div>
  <footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Versão</b> 1.3.0
				</div>
				<strong>Copyright © 2016 <a href="http://www.brisanet.com.br">SAS - Brisanet Telecomunicações</a>.</strong>
			</footer>
	</div>

	<!-- Modal -->
<div class="modal fade" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Informação Instalações</h4>
      </div>
      <div class="modal-body">
        <div id="div_1" style="display:none;">
        	<table id="table_1" style="width:100%" class="table table-bordered table-hover">
			  <tr>
			    <th>id</th>
			    <th>Cliente</th> 
			    <th>Tecnologia</th>
			    <th>Data</th>
			    <th>Codigo Sigem</th>
			    <th>Técnico</th>
			  </tr>
			 </table>
        </div>

        <div id="div_2" style="display:none;">
        	<table id="table_2" style="width:100%" class="table table-bordered table-hover">
			  <tr>
			    <th>id</th>
			    <th>Cliente</th> 
			    <th>Tecnologia</th>
			    <th>Data</th>
			    <th>Codigo Sigem</th>
			    <th>Técnico</th>
			  </tr>
			 </table>
        </div>

        <div id="div_3" style="display:none;">
        	<table id="table_3" style="width:100%" class="table table-bordered table-hover">
			  <tr>
			    <th>id</th>
			    <th>Cliente</th> 
			    <th>Tecnologia</th>
			    <th>Data</th>
			    <th>Codigo Sigem</th>
			    <th>Técnico</th>
			  </tr>
			 </table>
        </div>

        <div id="div_4" style="display:none;">
        	<table id="table_4" style="width:100%" class="table table-bordered table-hover">
			  <tr>
			    <th>id</th>
			    <th>Cliente</th> 
			    <th>Tecnologia</th>
			    <th>Data</th>
			    <th>Codigo Sigem</th>
			    <th>Técnico</th>
			  </tr>
			 </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

	<script src="../resources/plugins/morris/morris.min.js"></script>
	<script type="text/javascript">
	
		$(function () {
			  google.charts.load('current', {'packages':['corechart']});
		      google.charts.setOnLoadCallback(drawChart);
		      function drawChart() {
		      	data = new Date();
           		 mes = data.getMonth();
		      	$.getJSON('solicitacoes.ajax.php?search=',{
						valor: mes, 
						ajax: 'grafico'}, 
					function(s){
						var tam = s.length;
						var meses = new Array();

						var find ="/";
						var re = new RegExp(find, 'g');

						for (var i = 1; i < 5; i++) {
							meses[i-1] = s[tam-i].replace(re,"-"); 
						}

						var qnt = [0,0,0,0];
						var http = [0,0,0,0];
						var tv = [0,0,0,0];
						var radio = [0,0,0,0];
						//qnt[]=0;
						for (var j = 0; j < tam - 4; j++) {
							if 		(s[j].data_instalacao.substring(0,7) == meses[0].substring(0,7)){ 
								qnt[0]++;
								if (s[j].tecnologia=="FTTH") {http[0]++;}
								else if (s[j].tecnologia=="TV") {tv[0]++;}
								else if (s[j].tecnologia=="Radio") {radio[0]++;}
							}
							else if (s[j].data_instalacao.substring(0,7) == meses[1].substring(0,7)){ 
								qnt[1]++;
								if (s[j].tecnologia=="FTTH") {http[1]++;}
								else if (s[j].tecnologia=="TV") {tv[1]++;}
								else if (s[j].tecnologia=="Radio") {radio[1]++;}
							}
							else if (s[j].data_instalacao.substring(0,7) == meses[2].substring(0,7)){ 
								qnt[2]++;
								if (s[j].tecnologia=="FTTH") {http[2]++;}
								else if (s[j].tecnologia=="TV") {tv[2]++;}
								else if (s[j].tecnologia=="Radio") {radio[2]++;}
							}
							else if (s[j].data_instalacao.substring(0,7) == meses[3].substring(0,7)){ 
								qnt[3]++;
								if (s[j].tecnologia=="FTTH") {http[3]++;}
								else if (s[j].tecnologia=="TV") {tv[3]++;}
								else if (s[j].tecnologia=="Radio") {radio[3]++;}
							}
						}
				        var data = google.visualization.arrayToDataTable([
				          ['Mês', 'Total', 'HTTP', 'TV', 'Radio'],
				          [meses[0],  qnt[0], http[0], tv[0], radio[0]],
				          [meses[1],  qnt[1], http[1], tv[1], radio[1]],
				          [meses[2],  qnt[2], http[2], tv[2], radio[2]],
				          [meses[3],  qnt[3], http[3], tv[3], radio[3]]
				        ]);

				        var options = {
				          title: 'TOTAL INSTALAÇÕES',
				          hAxis: {title: 'Mês',  titleTextStyle: {color: '#333'}},
				          vAxis: {minValue: 0}
				        };

				        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
				        chart.draw(data, options);
					});
		      	
		      }
	  });

		
		function tabelas(i){
			if (i == 1) {
				$("#div_2").hide();
				$("#div_3").hide();
				$("#div_4").hide();

				$("#div_1").show();
			}else if (i == 2) {
				$("#div_1").hide();
				$("#div_3").hide();
				$("#div_4").hide();

				$("#div_2").show();
			}else if (i == 3) {
				$("#div_1").hide();
				$("#div_2").hide();
				$("#div_4").hide();

				$("#div_3").show();
			}else if (i == 4) {
				$("#div_1").hide();
				$("#div_2").hide();
				$("#div_3").hide();

				$("#div_4").show();
			}
		}
	</script>
	<!-- ======================================================FIM================================================================== -->
	<script src="../resources/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- jvectormap -->
	<script src="../resources/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="../resources/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script src="../resources/dist/js/app.min.js"></script>
	<script src="../resources/dist/js/jquery.gritter.min.js"></script>
	
	<!-- InputMask -->
	<script src="../resources/plugins/input-mask/jquery.inputmask.js"></script>
	<!-- InputMask -->
	<script src="../resources/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<!-- InputMask -->
	<script src="../resources/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<script src="../resources/plugins/fastclick/fastclick.min.js"></script>
	<script src="../resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<script src="../resources/plugins/bootstrap-datepicker-1.5.1/js/bootstrap-datepicker.js"></script>
	<script src="../resources/plugins/bootstrap-datepicker-1.5.1/locales/bootstrap-datepicker.pt-BR.min.js"></script>
	<script src="../resources/dist/js/scriptpage.js"></script>
	<script src="../resources/dist/js/dashboard2.js"></script>
    <!-- InputMask -->

	</body>
</html>

<script type="text/javascript">
	function deashBoard(){
			var dados = {};
			$('#deash').serializeArray().map(function(x){dados[x.name] = x.value;});
				// Configurações para a requisição Ajax
				$.ajax({
					type: "POST",
					url: "/sasInstalacoes/server/deash.php",
					data: dados,
					success: function( data ) {
						obj = JSON.parse(data);
						console.log(obj);
						var tipo = [0,0,0,0];
						var table, table2, table3, table4;
						var total = obj.length;
						for (var a = 0; a < obj.length; a++) {
							if (obj[a].tipo == "nova instalacao") {tipo[0]++;
								table += '<tr>';
								table += "<td>"+obj[a].id_instalacao+"</td>";
								table += "<td>"+obj[a].nome_cliente+"</td>";
								table += "<td>"+obj[a].tecnologia+"</td>";
								table += "<td>"+obj[a].data_instalacao+"</td>";
								table += "<td>"+obj[a].cod_instalacao_sigem+"</td>";
								table += "<td>"+obj[a].nome_tecnico+"</td>";
								table += '</tr>';	

							}
							else if(obj[a].tipo == "suporte") {tipo[1]++;
								table2 += '<tr>';
								table2 += "<td>"+obj[a].id_instalacao+"</td>";
								table2 += "<td>"+obj[a].nome_cliente+"</td>";
								table2 += "<td>"+obj[a].tecnologia+"</td>";
								table2 += "<td>"+obj[a].data_instalacao+"</td>";
								table2 += "<td>"+obj[a].cod_instalacao_sigem+"</td>";
								table2 += "<td>"+obj[a].nome_tecnico+"</td>";
								table2 += '</tr>';	
							}
							else if(obj[a].tipo == "troca tecnologia") {tipo[2]++;
								table3 += '<tr>';
								table3 += "<td>"+obj[a].id_instalacao+"</td>";
								table3 += "<td>"+obj[a].nome_cliente+"</td>";
								table3 += "<td>"+obj[a].tecnologia+"</td>";
								table3 += "<td>"+obj[a].data_instalacao+"</td>";
								table3 += "<td>"+obj[a].cod_instalacao_sigem+"</td>";
								table3 += "<td>"+obj[a].nome_tecnico+"</td>";
								table3 += '</tr>';	

							}
							else if(obj[a].tipo == "cancelamento") {tipo[3]++;
								table4 += '<tr>';
								table4 += "<td>"+obj[a].id_instalacao+"</td>";
								table4 += "<td>"+obj[a].nome_cliente+"</td>";
								table4 += "<td>"+obj[a].tecnologia+"</td>";
								table4 += "<td>"+obj[a].data_instalacao+"</td>";
								table4 += "<td>"+obj[a].cod_instalacao_sigem+"</td>";
								table4 += "<td>"+obj[a].nome_tecnico+"</td>";
								table4 += '</tr>';
							}

						}
						$('#table_1').append(table);
						$('#table_2').append(table2);
						$('#table_3').append(table3);
						$('#table_4').append(table4);

						$("#newInst").text(tipo[0]);
						$("#supp").text(tipo[1]);
						$("#troca").text(tipo[2]);
						$("#cancel").text(tipo[3]);

						//selecionando apenas um nome do tecnico e somando a quantidade de instalações
						var vetor = new Array ();
						var igual = false;
						var tam =1;
						for (var i = 0; i<obj.length; i++) {
							if (i < 1) {
								vetor[i] = obj[i].nome_tecnico;
							}else{

								for (var b = 0; b < vetor.length; b++) {
									if (vetor[b] == obj[i].nome_tecnico) {
										igual = true;
									}
								}
								if (igual) {
									igual = false;
								}else{
									vetor[i] = obj[i].nome_tecnico;
									tam++;
								}
							}
						}
						vetor.sort();
						var quantidade = new Array;

						for(var i=0;i<tam;i++){
							quantidade[i]=0;
						}

						for (var t = 0; t<obj.length; t++) {
							for(var j=0; j<tam; j++)
								if (obj[t].nome_tecnico == vetor[j]) {
									quantidade[j]++;
							}
						}
						console.log(quantidade);
						console.log(vetor);

						//ordenar vetores em ordem decrecente
						var aux = "";
						var aux2 = "";
						for( x = 0; x < tam; x++ )
						  {
						    for( y = x + 1; y < tam; y++ ) // sempre 1 elemento à frente
						    {
						      if ( quantidade[y] > quantidade[x] )
						      {
						         aux2 = vetor[y];
						         vetor[y] = vetor[x];
						         vetor[x] = aux2;
						         
						         aux = quantidade[y];
						         quantidade[y] = quantidade[x];
						         quantidade[x] = aux;

						      }
						    }
						  }

					  	console.log(quantidade);
						console.log(vetor);

						//porcentagem por tecnico
						var porcentagem = new Array;

						for (var i = 0; i < 4; i++) {
							porcentagem[i] = (100*quantidade[i])/total;
							$("#text"+i).text(vetor[i]);
							$("#total"+i).text(quantidade[i]+'/'+total);
							$("#valor"+i).width(porcentagem[i]+'%');

						}

						 var dataJson = new Array();
			              var label1 = 0;
			              var label2 = 0;
			              var label3 = 0;
			              var cont;
			              var data1 = new Date($("#data1").val());
			              var data2 = new Date($("#data2").val());
			              var dias = (data2.getTime() - data1.getTime());
			              dias = Math.round(Math.abs(dias/(1000*60*60*24)));
			              var data3 = data1;
			              var vv = data3.getDate();
			              data3.setDate(vv+1);
			              for (var i = 0; i < dias+1; i++) {
			                cont = false;
			                for (var x = 0; x < obj.length; x++) {
			                  var data4 = new Date(obj[x].data_instalacao);
			                  var v4 = data4.getDate();
			                  data4.setDate(v4+1);
			                  if(data3.getDate() == data4.getDate() && data3.getMonth() == data4.getMonth() && data3.getFullYear() == data4.getFullYear()){
			                    cont = true;
			                    switch (obj[x].tecnologia){
			                      case "FTTH":
			                        label1++;
			                        break;
			                      case "TV":
			                        label2++;
			                        break;
			                      case "radio":
			                        label3++;
			                        break;
			                    }
			                  }
			                }
			                if (cont) {
			                  dataJson.push({ y: data3.getFullYear()+"-"+(data3.getMonth()+1)+"-"+data3.getDate(), FTTH: label1, TV: label2, Rádio: label3});
			                  label1 = 0;
			                  label2 = 0;
			                  label3 = 0;
			                }
			                 data3.setDate(data3.getDate()+1);
			              }

			               $('#revenue-chart').remove();
			              $('#div_area').append('<div id="revenue-chart"></div>');
			              var area = new Morris.Area({
			                element: 'revenue-chart',
			                resize: true,
			                data: dataJson,
			                xkey: 'y',
			                ykeys: ['FTTH', 'TV', 'Rádio'],
			                labels: ['FTTH', 'TV', 'Rádio'],
			                lineColors: ['#a0d0e0', '#3c8dbc', '#a0b0e0'],
			                hideHover: 'auto'
			              });

					}
				});
				return false;
		}

		$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>