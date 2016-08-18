<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/FuncoesDinamicas.php');
?>
<head>
<script src="../resources/plugins/jQuery/timer.jquery.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>Home<small>Suportes</small></h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-home"></i> Index</a></li>
					<li><a href="#">Home</a></li>
					<li class="active">Listar Suporte</li>
				</ol>
			</section>
			<br>
			<section class="content">
					<div class="box box-danger box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">Total de Suportes</h3>
							<div class="box-tools pull-right">
								<button class="btn btn-box-tool">
							</div><!-- /.box-tools -->
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="box-body">
								<table id="tabelaFTTH" class="table table-bordered table-hover">
									<!-- Cabeçalho da tabela -->
									<thead>
										<tr>
											<th>Nome do Cliente</th>
											<th>Data Instalação</th>
											<th>Tecnologia</th>
											<th>Cabo Óptico<small> (em metros)</small></th>
											<th>Conectores SC APC</th>
											<th>Conectores SC PC</th>
											<th>Técnico</th>
											<th>Supervisor</th>
											<th>Apagar Instalação</th>
										</tr>
									</thead>
									<!-- Itens da tabela -->
									<tbody>
										<?php listarTabelaInstalacoesSuporte(); ?>
									</tbody>
								</table>
							</div><!-- /.box-body -->
						</div><!-- /.box-body -->
					</div><!-- /.box -->
					
				<h3>Estoque Mínimo</h3>
				<div class="box box-danger">
                    <div class="box-header with-border">
                      <h3 class="box-title"></h3>
                      <div class="box-tools pull-right">
                        <span class="label label-warning" style="font-size:14px;">Atenção Técnicos com Estoque Mínimo:</span>
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                      <ul class="users-list clearfix">

                      <?php listarItensFTTH() ?>
                      <?php listarItensFTTHTV() ?>
                      <?php listarItensSetupBOX() ?> 
                      <?php listarItensRadio() ?> 
                      <?php listarItensCombo() ?>  	

                      </ul><!-- /.users-list -->
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                      <a href="javascript::" class="uppercase"></a>
                    </div><!-- /.box-footer -->
              </div>
			</section><!-- /.content -->
		</div><!-- ./resources/wrapper -->
	</div>
	<!-- =================== Formulário para auxiliar no serialaze de apagar registros ==================== -->
	<form id="formAux">
		<input type="hidden" id="id_instalacao_aux" name="id_instalacao_aux"></input>
		<input type="hidden" id="tipo_aux" name="tipo_aux"></input>
		<input type="hidden" id="id_tecnico_aux" name="id_tecnico_aux"></input>
		<input type="hidden" id="nome_aux" name="nome_aux"></input>
		<input type="hidden" id="qnt_cabo_optico_aux" name="qnt_cabo_optico_aux" value="0"></input>
		<input type="hidden" id="qnt_conectores_aux" name="qnt_conectores_aux" value="0"></input>
		<input type="hidden" id="qnt_conectores2_aux" name="qnt_conectores2_aux" value="0"></input>
		<input type="hidden" id="qnt_cabo_rede_aux" name="qnt_cabo_rede_aux" value="0"></input>
		<input type="hidden" id="qnt_conectores_rj45_aux" name="qnt_conectores_rj45_aux" value="0"></input>
		<input type="hidden" id="qnt_bap_aux" name="qnt_bap_aux" value="0"></input>
		<input type="hidden" id="stb_aux" name="stb_aux" value="0"></input>
		<input type="hidden" id="radio_aux" name="radio_aux" value="0"></input>
		<input type="hidden" id="onu_aux" name="onu_aux" value="0"></input>
		<input type="hidden" id="telefones_aux" name="telefones_aux" value="0"></input>
	</form>
	<script type="text/javascript">
	

		function passValue(tipo, id_instalacao, id_tecnico, nome, a, b, c, d, e, f, g, h, i){
			switch (tipo){
				case "FTTH":
					$('#tipo_aux').val(tipo);
					$('#id_instalacao_aux').val(id_instalacao);
					$('#id_tecnico_aux').val(id_tecnico);
					$('#nome_aux').val(nome);
					$('#qnt_cabo_optico_aux').val(a);
					$('#qnt_conectores_aux').val(b);
					$('#qnt_conectores2_aux').val(c);
					$('#onu_aux').val(d);
					$('#qnt_bap_aux').val(e);
					apagar("instalacao");
					break;
				case "TV":
					$('#tipo_aux').val(tipo);
					$('#id_instalacao_aux').val(id_instalacao);
					$('#id_tecnico_aux').val(id_tecnico);
					$('#nome_aux').val(nome);
					$('#qnt_cabo_rede_aux').val(a);
					$('#qnt_conectores_rj45_aux').val(b);
					$('#stb_aux').val(c);
					$('#qnt_bap_aux').val(d);
					apagar("instalacao");
					break;
				case "Telefonia":
					$('#tipo_aux').val(tipo);
					$('#id_instalacao_aux').val(id_instalacao);
					$('#id_tecnico_aux').val(id_tecnico);
					$('#nome_aux').val(nome);
					$('#qnt_cabo_rede_aux').val(a);
					$('#qnt_conectores_rj45_aux').val(b);
					$('#telefones_aux').val(c);
					$('#qnt_bap_aux').val(d);
					apagar("instalacao");
					break;
				case "Radio":
					$('#tipo_aux').val(tipo);
					$('#id_instalacao_aux').val(id_instalacao);
					$('#id_tecnico_aux').val(id_tecnico);
					$('#nome_aux').val(nome);
					$('#qnt_cabo_rede_aux').val(a);
					$('#qnt_conectores_rj45_aux').val(b);
					$('#radio_aux').val(c);
					$('#qnt_bap_aux').val(d);
					apagar("instalacao");
					break;
				case "Combo":
					$('#tipo_aux').val(tipo);
					$('#id_instalacao_aux').val(id_instalacao);
					$('#id_tecnico_aux').val(id_tecnico);
					$('#nome_aux').val(nome);
					$('#qnt_cabo_rede_aux').val(a);
					$('#qnt_cabo_optico_aux').val(b);
					$('#qnt_conectores_rj45_aux').val(c);
					$('#qnt_conectores_aux').val(d);
					$('#qnt_conectores2_aux').val(e);
					$('#onu_aux').val(f);
					$('#stb_aux').val(g);
					$('#qnt_bap_aux').val(h);
					apagar("instalacao");
					break;
			}
		}
	</script>
	<!-- ======================================================FIM================================================================== -->
	
	<script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script src="../resources/dist/js/app.min.js"></script>
	<script src="../resources/dist/js/delete_registro.js"></script>
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
    <!-- InputMask -->

	</body>
</html>
