<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
?>
		
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>Registros<small>Escritórios</small></h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="#">Registros</a></li>
						<li class="active">Cadastrar Escritórios</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="col-md-13">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Cadastrar Recolhimento</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
								<form method="post" id="formTecnicoRecolhimento">
									<div class="box-body">
										<div class="row">
											<div class="col-md-6">
												<!-- Nome -->
												<div class="form-group has-feedback">
													<label>Nome do Cliente:</label>
													<input type="text" class="form-control" placeholder="Nome do Cliente" id="cliente" name="cliente" required >
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
												<div class="form-group has-feedback">
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
												<label>Equipamento Recolhido:</label>
												<div class="form-group has-feedback">
													<select name="equipamento" id="equipamento" class="form-control" required >
															<option value="" disabled selected>Equipamento</option>
															<option value="1">Rádio</option>
															<option value="2">ONU</option>
															<option value="3">SetupBox</option>
														</select>
												</div>
												<div class="form-group has-feedback" id="div_radio" style="display: none;">
													<label>Tipo de Rádio</label>		
										    		<select name="radio" id="radio" class="form-control" required >
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
												<div class="form-group has-feedback" id="div_onu" style="display: none;">
													<label>Serial:</label>
													<input type="text" class="form-control" placeholder="Serial ONU" id="serial_onu" name="serial_onu"><br>
													<label>Cabo de Rede: </label><br>
                      								<input type="number" name="onu_rj45" min="0" id="onu_rj45" placeholder="Metros" class="flat-red"><br><br>
                      								<input type="checkbox" name="conector_spc" id="conector_spc" value="true" class="flat-red">
                      								<label>Conector SPC</label>
                      								<br>
                      								<input type="checkbox" name="onu_fonte" id="onu_fonte" value="true" class="flat-red">
                      								<label>Fonte </label>                      								
												</div>
												<div class="form-group has-feedback" id="div_stb" style="display: none;">	
													<label>Serial:</label>
													<input type="text"  class="form-control" placeholder="Serial SetupBox" id="serial_stb" name="serial_stb" ><br>
													<label>Cabo de Rede: </label><br>	
                      								<input type="number" name="stb_rj45" id="stb_rj45"  min="0" placeholder="Metros" class="flat-red"><br><br>
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

		


		<script type="text/javascript">

		</script>
		<script>
			function idfunctionSuper(a, b, c, d, e, f) {
				$("#s_id").val(a);
				$("#s_nome_escritorio").val(b);
				$("#s_cidade").val(c);
				$("#s_email").val(d);
				$("#s_ramal").val(e);
				$("#s_obs").text(f);
			}
		</script>
		<script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>

		<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../resources/dist/js/app.min.js"></script>
		<script src="../resources/dist/js/function_tecnico_recolhimento.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.js"></script>
		<script src="../resources/plugins/iCheck/icheck.min.js"></script>
		<!-- page script -->
		<script>
		</script>
	</body>
</html>
