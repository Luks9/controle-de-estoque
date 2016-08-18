<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/funcoesMaterias.php');
	
?>
	<head>
		<script src="../resources/dist/js/functionsDisplay.js"></script>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="../resources/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- daterange picker -->
		<link rel="stylesheet" href="../resources/plugins/daterangepicker/daterangepicker-bs3.css">
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="../resources/plugins/iCheck/all.css">
		<!-- Bootstrap Color Picker -->
		<link rel="stylesheet" href="../resources/plugins/colorpicker/bootstrap-colorpicker.min.css">
		<!-- Bootstrap time Picker -->
		<link rel="stylesheet" href="../resources/plugins/timepicker/bootstrap-timepicker.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="../resources/plugins/select2/select2.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="../resources/dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="../resources/dist/css/skins/_all-skins.min.css">
		<link href="../resources/dist/css/jquery.gritter.css" rel="stylesheet">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Confirmação Material<small>Estoquista</small></h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li>Confirmação Material</li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					      <div class="row">
							<div class="col-xs-12">
								<div class="box box-default">
									<div class="box-header">
										<h3 class="box-title">Lista de Saídas</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
										<table id="tabelasaida" class="table table-bordered table-hover">
											<!-- Cabeçalho da tabela -->
											<thead>
												<tr>
													<th>Nome do Cliente</th>
													<th>Tecnologia</th>
													<th>Data</th>
													<th>Técnico</th>
													<th>Supervisor</th>
													<th>Tipo</th>
													<th>Status</th>
													<th>Confirmar Material</th>
												</tr>
											</thead>
											<tbody>
												<?php
												mostrarSaidaInstalacao();
												?>
											</tbody>
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div><!-- /.col-xs-12 -->
						</div><!-- /.row -->

						<div class="row">
							<div class="col-xs-12">
								<div class="box box-default">
									<div class="box-header">
										<h3 class="box-title">Material Recolhido</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
										<table id="tabelaRecolhimento" class="table table-bordered table-hover">
											<!-- Cabeçalho da tabela -->
											<thead>
												<tr>
													<th>ID</th>
													<th>Tecnico</th>
													<th>Cidade</th>
													<th>Motivo</th>
													<th>Cliente</th>
													<th>Equipamento</th>
													<th>Data</th>
													<th>Status</th>
													<th>Confirmar Material</th>
												</tr>
											</thead>
											<tbody>
												<?php
												mostrarRecolhimento();
												?>
											</tbody>
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div><!-- /.col-xs-12 -->
						</div><!-- /.row -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Versão</b> 1.3.0
				</div>
				<strong>Copyright © 2016 <a href="http://www.brisanet.com.br">SAS - Brisanet Telecomunicações</a>.</strong>
			</footer>
		</div><!-- ./resources/wrapper -->

		<div class="modal" id="confirmeMaterial" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    	<h3 class="modal-title">Confirmar Material</h3>
                  	</div>

                  	<div class="modal-body">
                  		<h4>Material usado</h4>
			                <div class="box-body no-padding">
			                  <pre id="pre_info2" >
			                  	
			                  </pre>
			                  <form id="form_status">
			                  		<input type="hidden" id="id_instalacao" name="id_instalacao"></input>
			                  		<input type="hidden" id="id_status" name="id_status"></input>
			                  		<input type="hidden" id="ajax" name="ajax" value="alterarConfirmacao"></input>
			                  </form>
			                </div><!-- /.box-body -->
			            
                  	</div>

                  	<div class="modal-footer">
	                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	                    <button type="button" class="btn btn-warning" value="Observação" id="id_observacao" onclick="confirmacao(this.value, 'material')">Observação</button>
	                    <button type="button" class="btn btn-primary" value="Ok" id="id_confirmar" onclick="confirmacao(this.value, 'material')">Confirmar</button>
                 	 </div>
				</div>
			</div>
		</div>

		<!--Modal de confirmação do material do tecnicos -->
		<div class="modal" id="confirmeRecolhimento" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    	<h3 class="modal-title">Confirmar Material</h3>
                  	</div>

                  	<div class="modal-body">
                  		<h4>Material Recolhido</h4>
			                <div class="box-body no-padding">
			                  <pre id="pre_info3" >
			                  	
			                  </pre>
			                  <form id="form_recolhimento">
			                  		<input type="hidden" id="id_recolhimento" name="id_recolhimento"></input>
			                  		<input type="hidden" id="status_recolhimento" name="status_recolhimento"></input>
			                  		<input type="hidden" id="ajax" name="ajax" value="alterarRecolhimento"></input>
			                  </form>
			                </div><!-- /.box-body -->
			            
                  	</div>

                  	<div class="modal-footer">
	                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	                    <?php if ($setorUsuario == 'administrador') { ?>
	                    <button type="button" class="btn btn-warning" value="Observaçao" id="id_observacao" onclick="confirmacao(this.value, 'recolhimento')">Observação</button>
	                    <button type="button" class="btn btn-primary" value="Ok" id="id_confirmar" onclick="confirmacao(this.value, 'recolhimento')">Confirmar</button>
	                    <?php } ?>
                 	 </div>
				</div>
			</div>
		</div>
		<!-- AdminLTE App -->
		<!-- jQuery UI 1.11.4 -->
		<script type="text/javascript">

		function confirmacao(val, confirme){
			if (confirme =="material") {
				var id = $('#id_instalacao').val();
				$('#id_status').val(val);
				var dados = {};

				$('#form_status').serializeArray().map(function(x){dados[x.name] = x.value;});
				// Configurações para a requisição Ajax
				$.ajax({
					type: "POST",
					url: "/sasInstalacoes/pages/solicitacoes.ajax.php",
					data: dados,
					success: function( data ) {
		
					}
				});
				if (val=="Observação") {
							jQuery.gritter.add({
								title: 'Instalação em Observação!',
								text: 'Aguardando um retorno.',
								class_name: 'growl-warning',
								image: '/sasInstalacoes/resources/images/shield-warning-icon.png',
								sticky: false,
								time: '1200',
							});
							window.setTimeout("location.href='http://localhost/sasInstalacoes/pages/confirmacaoMaterial.php'",500);
				}else if (val=="Ok") {
							jQuery.gritter.add({
								title: 'Obrigado pela confirmação!',
								text: '',
								class_name: 'growl-success',
								image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
								sticky: false,
								time: '1200',
							});
							window.setTimeout("location.href='http://localhost/sasInstalacoes/pages/confirmacaoMaterial.php'",500);
						}	
			}else if (confirme =="recolhimento") {
				var id = $('#id_recolhimento').val();
				$('#status_recolhimento').val(val);
				var dados = {};
				$('#form_recolhimento').serializeArray().map(function(x){dados[x.name] = x.value;});
				// Configurações para a requisição Ajax
				console.log(dados);
				$.ajax({
					type: "POST",
					url: "/sasInstalacoes/pages/solicitacoes.ajax.php",
					data: dados,
					success: function( data ) {
						
					}
				});
				if (val=="Observaçao") {
							jQuery.gritter.add({
								title: 'Instalação em Observação!',
								text: 'Aguardando um retorno.',
								class_name: 'growl-warning',
								image: '/sasInstalacoes/resources/images/shield-warning-icon.png',
								sticky: false,
								time: '1200',
							});
							window.setTimeout("location.href='http://localhost/sasInstalacoes/pages/confirmacaoMaterial.php'",500);
				}else if (val=="Ok") {
							jQuery.gritter.add({
								title: 'Obrigado pela confirmação!',
								text: '',
								class_name: 'growl-success',
								image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
								sticky: false,
								time: '1200',
							});
							window.setTimeout("location.href='http://localhost/sasInstalacoes/pages/confirmacaoMaterial.php'",500);
						}	
			}
		}

			function passValue(id_instalacao, id_tecnico, nome_cliente, rede, optico, rj45, conectores, conectores2, onu, stb, bap, radio, telefone, data_instalacao, tecnologia){
		
				$.getJSON('solicitacoes.ajax.php?search=',{
						valor: id_instalacao, 
						ajax: 'confirmeMaterial'}, 
				function(j){
					
					var informacao = "A instalação do tipo <b>"+tecnologia+"</b> no cliente <b>" + nome_cliente+"</b> no dia: <b>"+data_instalacao +' </b>usou: ';
					switch (tecnologia){
						case "FTTH":
							informacao += "<br>Cabo optico: <b>"+optico +" metros</b>.";
							informacao += "<br>Conectores SC APC: <b>"+conectores +"</b>; Conectores SC PC: <b>" +conectores2 +"</b>.";
							informacao += "<br>BAP: <b>"+bap +"</b>.";
							for (var i = 0; i < j.length; i++) {
								informacao +="<br><b>" + j[i].nome.toUpperCase()+"</b> Serial: <b>" +j[i].serial+"</b>.";
							}
							$('#pre_info2').html(informacao);
							break;

						case "Radio":
						case "Telefonia":	
						case "TV" :
							
								
							informacao += "<br>Cabo rede: <b>"+rede +" metros</b>.";
							informacao += "<br>Conectores RJ45: <b>"+rj45 +"</b>.";
							informacao += "<br>BAP: <b>"+bap +"</b>.";
							for (var i = 0; i < j.length; i++) {
								informacao +="<br><b>" + j[i].nome.toUpperCase()+"</b> Serial: <b>" +j[i].serial+"</b>.";
							}
							$('#pre_info2').html(informacao);
							break;
						case "Combo":
							
							informacao += "<br>Cabo optico: <b>"+optico +" metros</b>.";
							informacao += "<br>Cabo rede: <b>"+rede +" metros</b>.";
							informacao += "<br>Conectores SC APC: <b>"+conectores +"</b>; Conectores SC PC: <b>" +conectores2 +"</b>.";
							informacao += "<br>Conectores RJ45: <b>"+rj45 +"</b>.";
							informacao += "<br>BAP: <b>"+bap +"</b>.";
							for (var i = 0; i < j.length; i++) {
								informacao +="<br><b>" + j[i].nome.toUpperCase()+"</b> Serial: <b>" +j[i].serial+"</b>.";
							}
							$('#pre_info2').html(informacao);
							break;

						}
						$('#id_instalacao').val(id_instalacao);
				});
			}

			function passValue2(id, equipamento, tecnico){
				var id2 = id;
				var equip = equipamento;
				$.getJSON('solicitacoes.ajax.php?search=',{
						id2: id,
						valor2: equip, 
						ajax: 'confirmeRecolhimento'}, 
				function(a){
					console.log(a);
					if(equipamento=="1"){
						var fonte=""; var cano=""; var antena="";
						if(a[0].fonte){fonte="Fonte ";}
						if(a[0].antena){antena=" || Antena ||";}
						if(a[0].cano){cano=" Cano";}
						var informacao = "O tecnico <b>"+tecnico+"</b> recolheu os seguintes materiais: ";
						informacao += "<br>Radio: <b>" + a[0].radio+"</b>";
						informacao += "<br>Serial: <b>" + a[0].serial_radio+"</b>";
						informacao += "<br>Cabo de Rede: <b>" + a[0].cabo_rj45+" metros</b>";
						informacao += "<br>-------------------------------------";
						informacao += "<br><b>"+fonte+antena+cano+"</b>";
					}

					else if(equipamento=="2"){
						var fonte = ""; var conector = "";
						if(a[0].fonte){fonte="Fonte ||";}
						if(a[0].conector_spc){conector=" Conector SPC";}
						var informacao = "O tecnico <b>"+tecnico+"</b> recolheu os seguintes materiais: ";
						informacao += "<br>Equipamento: <b>Onu</b>";
						informacao += "<br>Serial: <b>" + a[0].serial_onu+"</b>";
						informacao += "<br>Cabo de Rede: <b>" + a[0].onu_rj45+" metros</b>";
						informacao += "<br>-------------------------------------";
						informacao += "<br><b>"+fonte+conector+"</b>";

					}else if(equipamento=="3"){
						var cabo_av = ""; var cabo_hdmi = ""; var controle = ""; var fonte = "";
						if(a[0].fonte){fonte="Fonte ||";}
						if(a[0].cabo_av){cabo_av=" Cabo AV || ";}
						if(a[0].cabo_hdmi){cabo_hdmi=" Cabo HDMI || ";}
						if(a[0].controle){controle=" Controle ";}
						var informacao = "O tecnico <b>"+tecnico+"</b> recolheu os seguintes materiais: ";
						informacao += "<br>Equipamento: <b>SetupBox</b>";
						informacao += "<br>Serial: <b>" + a[0].serial_stb+"</b>";
						informacao += "<br>Cabo de Rede: <b>" + a[0].stb_rj45+" metros</b>";
						informacao += "<br>-------------------------------------";
						informacao += "<br><b>"+fonte+cabo_av+cabo_hdmi+controle+"</b>";

					}
					$('#pre_info3').html(informacao);
				});
				$('#id_recolhimento').val(id);
			}
		</script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.extensions.js"></script>
		<script src="../resources/plugins/fastclick/fastclick.min.js"></script>
		<script src="../resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- jQuery 2.1.4 -->
		<!-- Select2 -->
		<script src="../resources/plugins/select2/select2.full.min.js"></script>
		<script src="../resources/dist/js/app.min.js"></script>
		<script src="../resources/dist/js/jquery.gritter.min.js"></script>
	    <script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- Page script -->
		<script>
			$(function () {
				$("#tabelasaida").DataTable();
				$("#tabelaRecolhimento").DataTable();
			});
		</script>
		
	</body>
</html>