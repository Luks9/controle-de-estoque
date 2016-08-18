<head>
  <meta charset="utf-8">
</head>
<script type="text/javascript">
              jQuery(document).ready(function() {
                 // Mascara de validação para os campos do form 
                  jQuery("#telefone").mask("(999) 9999-99999");
                  jQuery("#cpf").mask("999.999.999-99");
              })
 </script>
<!-- Modal de novo Usuario -->
<div class="modal fade" id="newMarcador" role="dialog">
  <div class="modal-dialog">
    <div class="box box-primary">
      <div class="modal-content">
        <div class="box-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="box-title">Cadastrar Usuário</h3>
        </div>
        <form method="POST" id="formularioCadastro">
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
                    <input id="nome" name="nome" type="text" class="form-control" placeholder="Nome" required="Este campo e requerido" autofocus>
                  </div>
                </div><!-- /.form-group -->
                <div class="form-group">
                  <label>Situação</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-edit"></i>
                    </div>
                    <select id="situacao" name="situacao"class="form-control" required="Este campo e requerido" style="width: 100%;">
                      <option value="" disabled selected>Situação</option>
                      <option value="true">Ativo</option>
                      <option value="false">Bloqueado</option>
                    </select>   
                    </div>
                </div><!-- /.form-group -->
              </div><!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Setor</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-warning"></i>
                    </div>
                    <select id="setor" name="setor"class="form-control" required="Este campo e requerido" style="width: 100%;">
                      <option value="" disabled selected>Selecione o Setor</option>
                      <option value="Suporte">Suporte</option>
                      <option value="Sac">Sac</option>
                      <option value="Comercial">Comercial</option>
                      <option value="Financeiro">Financeiro</option>
                      <option value="Suporte2">Suporte Empresa</option>
                      <option value="Recepcao">Recepção</option>
                    </select>
                  </div>
                </div><!-- /.form-group -->
                <div class="form-group">
                  <label>E-mail</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user-plus"></i>
                    </div>
                    <input id="email" name="email" placeholder="E-mail" type="email" class="form-control">
                  </div><!-- /.input group -->
                </div>
              </div><!-- /.col -->
              <div class="col-md-12">
                <div class="form-group">
                  <label class="text-center center-block">Dados Usuário</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </div>
                    <input id="usuario" name="usuario" required="Este campo e requerido" type="text" class="form-control" placeholder="Usuário">
                  </div><!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-keyboard-o"></i>
                    </div>
                    <input id="senha" name="senha" required="Este campo e requerido" type="password" class="form-control" placeholder="Senha">
                  </div><!-- /.input group -->
                </div>
              </div>
              <div class="col-md-12">
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-industry"></i>
                    </div>
                    <input id="cpf" name="cpf" type="text" class="form-control" placeholder="CPF">
                  </div><!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-mobile"></i>
                    </div>
                    <input id="telefone" name="telefone" type="text" class="form-control" placeholder="Telefone">
                  </div><!-- /.input group -->
                </div>
              </div>
            </div><!-- /.row -->
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Salvar Usuário</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
</form>

<!-- Fim do  Modal de novo Usuario -->

<div class="modal fade" id="addEscritorio" role="dialog">
  <div class="modal-dialog">
    <div class="box box-primary">
      <div class="modal-content">
        <div class="box-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="box-title">Cadastrar Escritório</h3>
        </div>
        <form method="POST" id="formularioCadastrarEscritorio">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nome do Escritório</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-edit"></i>
                    </div>
                    <input id="nome_escritorio" name="nome_escritorio" type="text" class="form-control" placeholder="Nome" required="Este campo e requerido" autofocus>
                  </div>
                </div><!-- /.form-group -->
                <div class="form-group">
                  <label>Endereço</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-edit"></i>
                    </div>
                    <input id="endereco" name="endereco" type="text" class="form-control" placeholder="Endereço" required="Este campo e requerido" autofocus>
                    </div>
                </div><!-- /.form-group -->
              </div><!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Responsável</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </div>
                    <input id="responsavel" name="responsavel" type="text" class="form-control" placeholder="Responśavel" required="Este campo e requerido" autofocus>
                  </div>
                </div><!-- /.form-group -->
                <div class="form-group">
                  <label>E-mail</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user-plus"></i>
                    </div>
                    <input id="email" name="email" placeholder="E-mail" type="email" class="form-control">
                  </div><!-- /.input group -->
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Salvar Escritório</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
</form>

