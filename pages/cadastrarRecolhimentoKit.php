<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/funcoesMaterias.php');
?>
	<head>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Recolhimentos<small>Kit</small></h1>
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
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Cadastrar Recolhimento de Kit</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
								<form method="post" id="formTecnicoRecolhimento2">
									<div class="box-body">
										<div class="row">
											<div class="col-md-6">

											<label>Nome do Técnico:</label>
												<div class="form-group has-feedback">
													<select name="tecnico_selecionado" id="tecnico_selecionado" class="form-control" required >
														<option value="" disabled selected>Nome do Técnico</option>
														<?php
															require ('../server/conectarBD.php');
															$stmt = $conexao_pdo->prepare("SELECT nome FROM t_tecnicos_recolhimento ORDER BY id");
															$stmt->execute();
															$result = array();
															while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
																$result[] = $r;
																echo "<option>".$r['nome']."</option>";
															} 
														?>
													</select>
												</div>
												<!-- Nome -->
												<div class="form-group has-feedback">
													<label>Nome do Cliente:</label>
													<input type="text" class="form-control" placeholder="Nome do Cliente" id="cliente" name="cliente" required >
													<input type="hidden" value="interno" id="tipo" name="tipo"></input>
													<span class="glyphicon glyphicon-phone form-control-feedback"></span>
												</div>
												<!-- Estado -->
												<label>Estado:</label>
												<div class="form-group has-feedback">
													<select name="estado" id="estado" class="form-control" required >
														<option value="" disabled selected>Estado</option>
														<?php
															require ('../server/conectarBD.php');
															$stmt = $conexao_pdo->prepare("SELECT cod_estados, sigla FROM estados ORDER BY sigla");
															$stmt->execute();
															$result = array();
															while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
																$result[] = $r;
																echo "<option value=".$r['cod_estados'].'/'.$r['sigla'].">".$r['sigla']."</option>";
															} 
														?>
													</select>
												</div>
												<!-- Cidade -->
												<label>Cidade:</label>
												<div class="form-group has-feedback">
													<select name="cidade" id="cidade" class="form-control" required >
														<option value="">Escolha um estado</option>
														
													</select>
												</div>
												<label>Motivo:</label>
												<div class="form-group has-feedback" >
														<select name="motivo" id="motivo" class="form-control" required >
															<option value="" disabled selected>Motivo</option>
															<option value="Alteração de Endereço">Alteração de Endereço</option>
															<option value="Inadimplência">Inadimplência</option>
															<option value="Mudança de Titular">Mudança de Titular</option>
															<option value="Cancelado">Cancelado</option>
														</select>
												</div>
											</div><!-- /.col-md-6 -->
											<div class="col-md-6">
												<!-- Ramal -->
												<label>Número do Contrato:</label>
												<div class="form-group has-feedback">
													<input type="number" class="form-control" placeholder="Contrato" id="contrato" name="contrato" >
													<span class="glyphicon glyphicon-phone form-control-feedback"></span>
												</div>

												<label>Data Recolhimento:</label>
												<div class="form-group has-feedback">
													<input type="text" class="form-control" placeholder="Contrato" id="data_recolhimento" name="data_recolhimento" >
													<span class="glyphicon glyphicon-phone form-control-feedback"></span>
												</div>
												<label>Status:</label>
												<div class="form-group has-feedback">
													<select name="status_equipamento" id="status_equipamento" class="form-control" required >
															<option value="" disabled selected>Status</option>
															<option value="Estoque do Técnico">Estoque do Técnico</option>
															<option value="Estoque Local">Estoque Local</option>
															<option value="Migrado Estoque">Migrado Estoque</option>
															<option value="Reutilizado">Reutilizado</option>
															<option value="Retornado a Central">Retornado a Central</option>
													</select>
												</div>
												<label>Encaminhar para Financeiro:</label>
												<div class="form-group has-feedback">
													<select name="encaminhado_financeiro" id="encaminhado_financeiro" class="form-control" required >
															<option value="false" disabled selected>Não</option>
															<option value="false">Não</option>
															<option value="true">Sim</option>
													</select>
												</div>


												<div class="form-group has-feedback" id="div_financeiro" style="display: none;">
													<label>Extraviado:</label>
													<select name="extraviado" id="extraviado" class="form-control" required >
															<option value="false" disabled selected>Extraviado</option>
															<option value="Extraviado Cliente">Extraviado Cliente</option>
															<option value="Extraviado Técnico">Extraviado Técnico</option>
													</select>
												</div>

												<label>Equipamento Recolhido(Serviço):</label>
												<div class="form-group has-feedback">
													<select name="equipamento" id="equipamento" class="form-control" required >
															<option value="" disabled selected>Equipamento</option>
															<option value="1">Rádio</option>
															<option value="2">ONU</option>
															<option value="3">SetupBox</option>
															<option value="5">Celular</option>
															<option value="4">Combo</option>
														</select>
												</div>
												<div class="form-group has-feedback" id="div_radio" style="display: none;">
													<label>Tipo de Rádio</label>		
										    		<select name="radio" id="radio" class="form-control">
															<option value="" disabled selected>tipo de rádio</option>
															<option value="2.4 GHZ">Rádio 2.4 GHZ</option>
															<option value="5.8 GHZ">Rádio 5.8 GHZ</option>
															<option value="Canopy 5.8 GHZ">Rádio Canopy 5.8 GHZ</option>
													</select>
													<label>Serial:</label>
													<input type="text" class="form-control" placeholder="Serial Radio" id="serial_radio" name="serial_radio" >									
                      								<input type="checkbox" name="poe" id="poe" value="true" class="flat-red">
                      								<label>POE</label>
                      								<br>
                      								<input type="checkbox" name="antena" id="antena" value="true" class="flat-red">
                      								<label>Antena</label><br>
                      								<input type="checkbox" name="cano" id="cano" value="true" class="flat-red">
                      								<label>Cano</label><br>
                      								<label>Cabo RJ45: </label><br>
                      								<input type="number" name="radio_rj45" id="radio_rj45" min="0" placeholder="Metros" class="flat-red"><br>
                      								
												</div>

												<div class="form-group has-feedback" id="div_celular" style="display: none;">
													<label>Serial:</label>
													<input type="text" class="form-control" placeholder="Serial" id="serial" name="serial" ><br>                      								
												</div>

												<div class="form-group has-feedback" id="div_onu" style="display: none;">
													<label>Serial:</label>
													<input type="text" class="form-control" placeholder="Serial ONU" id="serial_onu" name="serial_onu"><br>
													<label>Cabo Óptico: </label><br>
                      								<input type="number" name="onu_rj45" min="0" id="onu_rj45" placeholder="Metros" class="flat-red"><br><br>
                      								<input type="checkbox" name="conector_spc" id="conector_spc" value="true" class="flat-red">
                      								<label>Conector SC APC</label>
                      								<br>
                      								<input type="checkbox" name="conector_pc" id="conector_pc" value="true" class="flat-red">
                      								<label>Conector SC PC</label>
                      								<br>
                      								<input type="checkbox" name="onu_fonte" id="onu_fonte" value="true" class="flat-red">
                      								<label>Fonte </label>                      								
												</div>
												<div class="form-group has-feedback" id="div_stb" style="display: none;">	
													<label>Serial:</label>
													<input type="text"  class="form-control" placeholder="Serial SetupBox" id="serial_stb" name="serial_stb" ><br>
													<label>Cabo de Rede: </label><br>	
                      								<input type="number" name="stb_rj45s" id="stb_rj45s"  min="0" placeholder="Metros" class="flat-red"><br><br>
													<input type="checkbox" name="stb_fonte" id="stb_fonte" value="true" class="flat-red">
                      								<label>Fonte</label>
                      								<br>
                      								<input type="checkbox" name="controle" id="controle" value="true" class="flat-red">
                      								<label>Controle </label>
                      								<br>
                      								<input type="checkbox" name="cabo_av" id="cabo_av" value="true" class="flat-red">
                      								<label>Cabo AV </label>
                      								<br>
                      								<input type="checkbox" name="cabo_hdmi" id="cabo_hdmi" value="true" class="flat-red">
                      								<label>Cabo HDMI </label>
												</div>

												<div class="form-group has-feedback" id="div_combo" style="display: none;">	
													<label>Serial ONU:</label>
													<input type="text"  class="form-control" placeholder="Serial SetupBox" id="serial_stb2" name="serial_stb2" ><br>
													<label>Serial SetupBox:</label>
													<input type="text"  class="form-control" placeholder="Serial SetupBox" id="serial_onu2" name="serial_onu2" ><br>
													<label>Cabo de Rede: </label><br>	
                      								<input type="number" name="stb_rj45" id="stb_rj45"  min="0" placeholder="Metros" class="flat-red"><br><br>
  													<input type="checkbox" name="stb_fonte" id="stb_fonte" value="true" class="flat-red">
                      								<label>Fonte</label>
                      								<br>
                      								<input type="checkbox" name="conector_spc" id="conector_spc" value="true" class="flat-red">
                      								<label>Conector SC APC</label>
                      								<br>
                      								<input type="checkbox" name="controle" id="controle" value="true" class="flat-red">
                      								<label>Controle </label>
                      								<br>
                      								<input type="checkbox" name="cabo_av" id="cabo_av" value="true" class="flat-red">
                      								<label>Cabo AV </label>
                      								<br>
                      								<input type="checkbox" name="cabo_hdmi" id="cabo_hdmi" value="true" class="flat-red">
                      								<label>Cabo HDMI </label>
												</div>

												<!-- Observação -->
												<div class="form-group">
													<label>Observação</label>
													<textarea class="form-control" id="observacao" name="observacao" rows="3" placeholder="Enter ..."></textarea>
												</div>
											</div><!-- /.col-md-6 -->
										</div><!-- /.row -->
									</div><!-- /.box-body -->
									<div class="box-footer">
										<div class="btn-group pull-right">
											<button type="submit" class="btn btn-defult">
												<i class="fa fa-edit"></i> Cadastrar
											</button>
										</div>
									</div><!-- /.box-footer -->
								</form><!-- /#form_cadastro -->
							</div><!-- /.box-body -->
						</div><!-- /.box -->
												<div class="row">
							<div class="col-xs-12">
								<div class="box box-default">
									<div class="box-header">
										<h3 class="box-title">Lista de Recolhimentos</h3>
									</div><!-- /.box-header -->
									<div class="box-body">
										<table id="tabelaRecolhimentoKIT" class="table table-bordered table-hover">
											<!-- Cabeçalho da tabela -->
											<thead>
												<tr>
													<th>Tecnico</th>
													<th>Cidade</th>
													<th>Motivo</th>
													<th>Cliente</th>
													<th>Equipamento</th>
													<th>Data</th>
													<th>Status</th>
													<th>Localidade</th>
													<th>Confirmar Material</th>
													<th>Editar</th>

													</tr>
											</thead>
											<tbody>
												<?php
												mostrarRecolhimentoKIT();
												?>
											</tbody>
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div><!-- /.col-xs-12 -->
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

		<div class="modal" id="editRecolhimento" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    	<h3 class="modal-title">Confirmar Material</h3>
                  	</div>
                  	<div class="modal-body">
		                <form id="form_edit_recolhimento">
		                <div class="col-md-13">
		                	<div class="col-md-6">
		                  		<div class="form-group has-feedback">	
		                  			<label>Tecnico</label>
			                  		<select name="tecnico_edit" id="tecnico_edit" class="form-control" required >
									<option value="" disabled selected>Nome do Técnico</option>
										<?php
											require ('../server/conectarBD.php');
											$stmt = $conexao_pdo->prepare("SELECT nome FROM t_tecnicos_recolhimento ORDER BY id");
											$stmt->execute();
											$result = array();
											while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
												$result[] = $r;
												echo "<option>".$r['nome']."</option>";
											} 
										?>
									</select>
								</div>
								<div class="form-group has-feedback">
									<label>Nome Cliente</label>
									<input type="text" class="form-control" id="cliente_edit" name="cliente_edit" >
		                  		</div>
	                  		</div>
	                  		<div class="col-md-6">
	                  			<div class="form-group has-feedback">
									<label>Motivo</label>
									<select name="motivo_edit" id="motivo_edit" class="form-control" required >									
										<option value="Alteração de Endereço">Alteração de Endereço</option>
										<option value="Inadimplência">Inadimplência</option>
										<option value="Mudança de Titular">Mudança de Titular</option>
										<option value="Cancelado">Cancelado</option>
									</select>
		                  		</div>
	                  			<div class="form-group has-feedback">
	                  				<label>Status</label>
									<select name="status_edit" id="status_edit" class="form-control" required >
											<option value="Estoque do Técnico">Estoque do Técnico</option>
											<option value="Estoque Local">Estoque Local</option>
											<option value="Migrado Estoque">Migrado Estoque</option>
											<option value="Reutilizado">Reutilizado</option>
											<option value="Retornado a Central">Retornado a Central</option>
									</select>
								</div>
								
								
								<div class="form-group">
									<label>Observação</label>
									<textarea class="form-control" id="observacao_edit" name="observacao_edit" rows="3" placeholder="Enter ..."></textarea>
									<input type="hidden" id="id_recolhimento_edit" name="id_recolhimento_edit">
									<input type="hidden" id="ajax" name="ajax" value="recolhimento">
								</div>

	                  		</div>
                  		</div>
		                
                  	</div>
                  	<div class="modal-footer">
	                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	                    <button type="submit" class="btn btn-primary" value="Ok" id="id_confirmar">Editar</button>
                 	 </div>
                 	 </form>
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
			
							
		<script type="text/javascript">

		function add_val(id, equipamento, tecnico, cliente, motivo, status, observacao){
			$('#id_recolhimento_edit').val(id);
			$('#tecnico_edit').val(tecnico);
			$('#cliente_edit').val(cliente);
			$('#motivo_edit').val(motivo);
			$('#status_edit').val(status);
			$('#observacao_edit').val(observacao);
			
		}

		$('#form_edit_recolhimento').submit(function() {
			var dados = {};

				$('#form_edit_recolhimento').serializeArray().map(function(x){dados[x.name] = x.value;});
				// Configurações para a requisição Ajax
				$.ajax({
					type: "POST",
					url: "/sasInstalacoes/server/edit_recolhimento.php",
					data: dados,
					success: function(data) {
						jQuery.gritter.add({
					title: 'Recolhimento Atualizando!',
					text: 'Atualizando...',
					class_name: 'growl-success',
					image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
					sticky: false,
					time: '1000',
				});
				window.setTimeout("location.href=''",1000);
					}
				});
		});

		function confirmacao(val, confirme){
			if (confirme =="material") {
				var id = $('#id_instalacao').val();
				$('#id_status').val(val);
				var dados = {};

				$('#form_status').serializeArray().map(function(x){dados[x.name] = x.value;});
				// Configurações para a requisição Ajax
				$.ajax({
					type: "POST",
					url: "/sasInstalacoes/pages/solicitacoes.ajax2.php",
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
							window.setTimeout("location.href='/sasInstalacoes/pages/cadastrarRecolhimentoKit.php'",500);
				}else if (val=="Ok") {
							jQuery.gritter.add({
								title: 'Obrigado pela confirmação!',
								text: '',
								class_name: 'growl-success',
								image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
								sticky: false,
								time: '1200',
							});
							window.setTimeout("location.href='/sasInstalacoes/pages/cadastrarRecolhimentoKit.php'",500);
						}	
			}else if (confirme =="recolhimento") {
				var id = $('#id_recolhimento').val();
				$('#status_recolhimento').val(val);
				var dados = {};
				$('#form_recolhimento').serializeArray().map(function(x){dados[x.name] = x.value;});
				// Configurações para a requisição Ajax
				$.ajax({
					type: "POST",
					url: "/sasInstalacoes/pages/solicitacoes.ajax2.php",
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
							window.setTimeout("location.href='/sasInstalacoes/pages/cadastrarRecolhimentoKit.php'",500);
				}else if (val=="Ok") {
							jQuery.gritter.add({
								title: 'Obrigado pela confirmação!',
								text: '',
								class_name: 'growl-success',
								image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
								sticky: false,
								time: '1200',
							});
							window.setTimeout("location.href='/sasInstalacoes/pages/cadastrarRecolhimentoKit.php'",500);
						}	
			}
		}

			function passValue(id_instalacao, id_tecnico, nome_cliente, rede, optico, rj45, conectores, conectores2, onu, stb, bap, radio, telefone, data_instalacao, tecnologia){
		
				$.getJSON('solicitacoes.ajax2.php?search=',{
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
				$.getJSON('solicitacoes.ajax2.php?search=',{
						id2: id,
						valor2: equip, 
						ajax: 'confirmeRecolhimento'}, 
				function(a){
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
						var fonte = ""; var conector_spc = ""; var conector_pc = "";
						if(a[0].fonte){ fonte="Fonte - ";}
						if(a[0].conector_spc){ conector_spc=" Conector SC APC - ";}
						if(a[0].conector_pc){ conectorpc=" Conector SC PC";}
						var informacao = "O tecnico <b>"+tecnico+"</b> recolheu os seguintes materiais: ";
						informacao += "<br>Equipamento: <b>Onu</b>";
						informacao += "<br>Serial: <b>" + a[0].serial_onu+"</b>";
						informacao += "<br>Cabo de Rede: <b>" + a[0].onu_rj45+" metros</b>";
						informacao += "<br>-------------------------------------";
						informacao += "<br><b>"+fonte+conector_spc+conectorpc+"</b>";

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
					else if(equipamento=="4"){
						var cabo_av = ""; var cabo_hdmi = ""; var controle = ""; var stb_fonte = ""; var serial_stb =""; var serial_onu = "";
						var conector_spc = "";
						if(a[0].stb_fonte){stb_fonte="Fonte -";}
						if(a[0].cabo_av){cabo_av=" Cabo AV - ";}
						if(a[0].cabo_hdmi){cabo_hdmi=" Cabo HDMI - ";}
						if(a[0].controle){controle=" Controle - ";}
						if(a[0].serial_stb){serial_stb=" Serial STB - ";}
						if(a[0].serial_onu){serial_onu=" Serial ONU - ";}
						if(a[0].conector_spc){conector_spc=" Conector SPC  ";}
						var informacao = "O tecnico <b>"+tecnico+"</b> recolheu os seguintes materiais: ";
						informacao += "<br>Equipamento: <b>Combo</b>";
						informacao += "<br>Serial SetupBox: <b>" + a[0].serial_stb+"</b>";
						informacao += "<br>Serial Onu: <b>" + a[0].serial_onu+"</b>";
						informacao += "<br>Cabo de Rede: <b>" + a[0].stb_rj45+" metros</b>";
						informacao += "<br>-------------------------------------";
						informacao += "<br><b>"+stb_fonte+cabo_av+cabo_hdmi+controle+conector_spc+"</b>";

					}
					else if(equipamento=="5"){
						var serial = "";
						var informacao = "O tecnico <b>"+tecnico+"</b> recolheu os seguintes materiais: ";
						informacao += "<br>Equipamento: <b>Celular</b>";
						informacao += "<br>Serial Celular: <b>" + a[0].serial+"</b>";
						informacao += "<br>-------------------------------------";
						informacao += "<br><b>"+serial+"</b>";

					}
					$('#pre_info3').html(informacao);
				});
				$('#id_recolhimento').val(id);
			}
		</script>
		


		<script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>

		<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../resources/dist/js/app.min.js"></script>
		<script src="../resources/dist/js/function_tecnico_recolhimento2.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.js"></script>
		<script src="../resources/plugins/iCheck/icheck.min.js"></script>

				<script>
			$(function () {
				$("#data_recolhimento").inputmask("##/##/####");
			});
		</script>

		<!-- page script -->
		<script>
		</script>

				<script>
			$(function () {
				$("#tabelaRecolhimentoKIT").DataTable();

			});
		</script>
	</body>
</html>