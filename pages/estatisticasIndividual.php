<?php
	// Chamados o arquivo com Menu
	include ('../_headerMenu.php');
	require ('../server/FuncoesDinamicas.php');
?>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<?php 
						$nome = $_GET['nome'];
						echo "<h1>".$nome."</h1>";
					?>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li><a href="listarEstoque.php">Listar</a></li>
						<li class="active">Estoque Individual</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="col-md-13">
						<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Instalações</a></li>
              <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
              <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <table style="width:100%" class="table table-bordered table-hover">
				  <tr>
				    <th>id</th>
				    <th>Cliente</th> 
				    <th>Tecnologia</th>
				    <th>Data</th>
				    <th>Codigo Sigem</th>
				    <th>Cabo Optico</th>
				    <th>Conectores SC APC</th>
				    <th>Conectores SC PC</th>
				    <th>Tipo</th>
				    <th>Apagar Serviço</th>
				  </tr>
				  <tr>
					<?php listarTabelaInstalacoes() ?>
				  </tr>
			 	</table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                The European languages are members of the same family. Their separate existence is a myth.
                For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                in their grammar, their pronunciation and their most common words. Everyone realizes why a
                new common language would be desirable: one could refuse to pay expensive translators. To
                achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                words. If several languages coalesce, the grammar of the resulting language is more simple
                and regular than that of the individual languages.
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

					</div>
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Versão</b> 1.3.0
				</div>
				<strong>Copyright © 2016 <a href="http://www.brisanet.com.br">SAS - Brisanet Telecomunicações</a>.</strong>
			</footer>
		</div><!-- ./resources/wrapper -->
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

		<!-- jQuery 2.1.4 -->
		<script src="../resources/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../resources/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../resources/dist/js/app.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
		<!-- InputMask -->
		<script src="../resources/plugins/input-mask/jquery.inputmask.extensions.js"></script>
		<script src="../resources/plugins/fastclick/fastclick.min.js"></script>
		<script src="../resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- page script -->
		<script type="text/javascript">
			$("#teste").DataTable();
		</script>
		<script src="../resources/dist/js/delete_registro.js"></script>
	</body>

	<script type="text/javascript">
		
		function passValue(tipo, id_instalacao, id_tecnico, nome, a, b, c, d, e, f, g, h, i, nome_tecnico){
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
					apagar(id_tecnico, nome_tecnico);
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
					apagar(id_tecnico, nome_tecnico);
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
					apagar(id_tecnico, nome_tecnico);
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
					apagar(id_tecnico, nome_tecnico);
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
					apagar(id_tecnico, nome_tecnico);
					break;
			}
		}
	
	function apagar(id_tecnico, nome_tecnico){
		url = '/sasInstalacoes/pages/estatisticasIndividual.php?id='+id_tecnico+'&nome='+nome_tecnico;
		var dados = {};
		$('#formAux').serializeArray().map(function(x){dados[x.name] = x.value;});
		// Configurações para a requisição Ajax
		var apagar = confirm('Deseja realmente excluir este registro?');
		console.log(id_tecnico);
		if (apagar) {
			$.ajax({
				type: "POST",
				url: "/sasInstalacoes/server/delete_registro.php",
				data: dados,
				success: function( data ) {
					if (data == false) {
						jQuery.gritter.add({
							title: 'Registro Apagado',
							text: 'Instalação apagada com sucesso.',
							class_name: 'growl-success',
							image: 'http://localhost/Luke/images/shield-ok-icon.png',
							sticky: false,
							time: '2000',
						});
						window.setTimeout("location.href=url",1300);
					}
				}
			});
		}	
	}
	$(function() {
		var vars = [], hash;
	    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	    for(var i = 0; i < hashes.length; i++)
	    {
	        hash = hashes[i].split('=');
	        vars.push(hash[0]);
	        vars[hash[0]] = hash[1];
	    }
	    var id = vars['id'];


	});
	</script>
</html>
