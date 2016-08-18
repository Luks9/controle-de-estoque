<head>
	<link href="../resources/dist/css/jquery.gritter.css" rel="stylesheet">
</head>
<!-- Modal de novo Marcador -->
<div class="modal fade" id="editUser" role="dialog">
	<div class="modal-dialog modal-lg">
		<form method="POST" id="form_editar_user">
			<div class="box box-primary">
				<div class="modal-content">
					<div class="box-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="box-title">Editar Usuário</h3>
					</div>
					<div class="modal-body">
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nome</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-edit"></i>
											</div>
											<input id="m_nome" name="m_nome" type="text" class="form-control" required autofocus>
										</div>
									</div><!-- /.form-group -->
									<div class="form-group" id="div_gerad">
										<label>E-mail</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-bolt"></i>
											</div>
											<input id="m_email" name="m_email" type="text" required class="form-control">
										</div>
									</div><!-- /.form-group -->
									<div class="form-group" id="div_cons">
										<label id="pot">Usuario</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-bolt"></i>
											</div>
											<input id="m_usuario" name="m_usuario" type="text" required class="form-control">
										</div>
									</div><!-- /.form-group -->
								</div><!-- /.col -->
								<div class="col-md-6">
									<div class="form-group">
										<label>CPF</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-edit"></i>
											</div>
											<input id="m_cpf" name="m_cpf" type="text" required class="form-control">
										</div>
									</div><!-- /.form-group -->
									<div class="form-group">
										<label>Setor</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-warning"></i>
											</div>
											<select name="m_setor" id="m_setor" class="form-control" required >
												<option value="" disabled selected>Setor</option>
												<option value="Agendamentos Externos">Agendamentos Externos</option>
												<option value="Instalações">Instalações</option>
												<option value="Liberação">Liberação</option>
												<option value="Suporte">Suporte</option>
												<option value="administrador">Administrador</option>
												<option value="Técnico Externo">Técnico Externo</option>
											</select>
										</div>
									</div><!-- /.form-group -->
									<div class="form-group">
										<label>Telefone</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-edit"></i>
											</div>
											<input type="hidden" id="m_id" name="m_id"  type="text" class="form-control" >
											<input id="m_telefone" name="m_telefone" type="text" required class="form-control">
										</div>
									</div>
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.box-body -->
					</div><!-- /.box -->
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Atualizar Dados</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- MODAL PARA EDIÇÃO DE SUPERVISOR-->
<div class="modal fade" id="editSuper" role="dialog">
	<div class="modal-dialog modal-lg">
		<form method="POST" id="form_editar_super">
			<div class="box box-primary">
				<div class="modal-content">
					<div class="box-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="box-title">Editar Escritório</h3>
					</div>
					<div class="modal-body">
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nome</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-edit"></i>
											</div>
											<input id="s_nome_escritorio" name="s_nome_escritorio" type="text" class="form-control" required autofocus>
										</div>
									</div><!-- /.form-group -->
									<div class="form-group" id="div_gerad">
										<label>Cidade</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-bolt"></i>
											</div>
											<input id="s_cidade" name="s_cidade" type="text" required class="form-control">
										</div>
									</div><!-- /.form-group -->
									<div class="form-group" id="div_cons">
										<label id="pot">Email</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-bolt"></i>
											</div>
											<input type="hidden" id="s_id" name="s_id"  type="text" class="form-control" >
											<input id="s_email" name="s_email" type="text" required class="form-control">
										</div>
									</div><!-- /.form-group -->
								</div><!-- /.col -->
								<div class="col-md-6">
									<div class="form-group">
										<label>Obervação</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-edit"></i>
											</div>
											<textarea class="form-control" id="s_obs" name="s_obs" rows="3"></textarea>
										</div>
									</div>
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.box-body -->
					</div><!-- /.box -->
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Atualizar Dados</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- MODAL PARA EDIÇÃO DE INSTALAÇÃO FTTH-->
<div class="modal fade" id="editFTTH" role="dialog">
	<div class="modal-dialog modal-lg">
		<form method="POST" id="form_editar_FTTH">
			<div class="box box-primary">
				<div class="modal-content">
					<div class="box-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="box-title">Editar Instalação</h3>
					</div>
					<div class="modal-body">
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group has-feedback">
										<label>Nome do Cliente</label>
										<input type="text" name="ftth_nome" id="ftth_nome" class="form-control" required placeholder="Nome" oninvalid="setCustomValidity('Informe seu nome neste campo ')" onchange="try{setCustomValidity('')}catch(e){}">
										<span class="glyphicon glyphicon-user form-control-feedback"></span>
									</div>
									<div class="form-group has-feedback">
										<label>Data da Instalação</label>
										<input type="text" id="ftth_data" name="ftth_data" class="form-control" required>
										<input type="hidden" id="ftth_id" name="ftth_id" class="form-control" required>
										<span class="glyphicon fa fa-list-alt form-control-feedback"></span>
									</div>
									<div class="form-group has-feedback">
										<label>Cabo Optico </label>
										<input type="number" id="ftth_cabo" name="ftth_cabo" required="" class="form-control">
										<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
									</div>
								</div><!-- /.col -->
								<div class="col-md-6">
									<div class="form-group has-feedback">
										<label>Quantidade de conectores SC APC</label>
										<input type="number" id="ftth_apc" name="ftth_apc" required="" class="form-control">
										<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
									</div>
									<div class="form-group has-feedback">
										<label>Quantidade de conectores SC PC</label>
										<input type="number" id="ftth_pc" name="ftth_pc" required="" class="form-control">
										<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
									</div>
									<div class="form-group has-feedback">
										<label>Quantidade ONU</label>
										<input type="number" id="ftth_onu" name="ftth_onu" required class="form-control">
										<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
									</div>
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- MODAL PARA EDIÇÃO DE INSTALAÇÃO FTTH-->
<div class="modal fade" id="modal_geral" role="dialog">
	<div class="modal-dialog modal-lg">
		<form method="POST" id="form_geral">
			<div class="box box-primary">
				<div class="modal-content">
					<div class="box-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="box-title">Editar Instalação</h3>
					</div>
					<div class="modal-body">
						<div class="box-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group has-feedback">
										<label>Nome do Cliente</label>
										<input type="text" name="ftth_nome" id="ftth_nome" class="form-control" required placeholder="Nome" oninvalid="setCustomValidity('Informe seu nome neste campo ')" onchange="try{setCustomValidity('')}catch(e){}">
										<span class="glyphicon glyphicon-user form-control-feedback"></span>
									</div>
									<div class="form-group has-feedback">
										<label>Data da Instalação</label>
										<input type="text" id="ftth_data" name="ftth_data" class="form-control" required>
										<input type="hidden" id="ftth_id" name="ftth_id" class="form-control" required>
										<span class="glyphicon fa fa-list-alt form-control-feedback"></span>
									</div>
									<div class="form-group has-feedback">
										<label>Cabo Optico </label>
										<input type="number" id="ftth_cabo" name="ftth_cabo" required="" class="form-control">
										<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
									</div>
								</div><!-- /.col -->
								<div class="col-md-6">
									<div class="form-group has-feedback">
										<label>Quantidade de conectores SC APC</label>
										<input type="number" id="ftth_apc" name="ftth_apc" required="" class="form-control">
										<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
									</div>
									<div class="form-group has-feedback">
										<label>Quantidade de conectores SC PC</label>
										<input type="number" id="ftth_pc" name="ftth_pc" required="" class="form-control">
										<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
									</div>
									<div class="form-group has-feedback">
										<label>Quantidade ONU</label>
										<input type="number" id="ftth_onu" name="ftth_onu" required class="form-control">
										<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
									</div>
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Slimscroll -->
<script src="../resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../resources/plugins/fastclick/fastclick.min.js"></script>
<!-- InputMask -->
<script src="../resources/plugins/input-mask/jquery.inputmask.js"></script>
<!-- InputMask -->
<script src="../resources/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<!-- InputMask -->
<script src="../resources/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- cadastro CPD -->
<script src="../resources/dist/js/jquery.gritter.min.js"></script>
<script src="../resources/dist/js/function_edit_user.js"></script>
<script src="../resources/dist/js/function_edit_super.js"></script>
<script src="../resources/dist/js/function_edit_ftth.js"></script>