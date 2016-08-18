<?php
  // Chamados o arquivo com Menu
  include ('../_headerMenu.php');
  require ('../server/funcoesMaterias.php');
?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Cadastros<small>Ferramentas</small></h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#">Cadastros</a></li>
            <li class="active">Ferramentas</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="col-md-13">
          <?php
            if ($_GET['metodo'] == 'editarFerramentas') {
              $id2 = $_GET['id'];
              $nome = $_GET['nome'];
              $setor = $_GET['setor'];
              $tipo = $_GET['tipo'];

           echo '
            <div class="box box-primary box-solid ">
              <div class="box-header with-border">
                <h3 class="box-title">Editar Ferramentas</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <form method="post" id="editarFerramentas">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-6">
                        <!-- Nome -->
                        <div class="form-group has-feedback">
                        <label>Nome da Ferramenta:</label>
                          <input type="text" class="form-control"  autofocus placeholder="Nome" value="'.$nome.'" name="nome" id="nome">
                          <input type="hidden" id="id" value="'.$id2.'" name="id">

                          <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                      </div><!-- /.col-md-6 -->
                      <div class="col-md-6">
                  <div class="form-group">
                          <label>Setor:</label>
                          <select class="form-control" required="" name="setor" value="'.$setor.'"  id="setor">
                            <option value="" disabled selected>'.$setor.'</option>
                            <option value="Cabeamento">Cabeamento</option>
                            <option value="Instalação FTTH">Instalação FTTH</option>
                            <option value="Instalação de TV">Instalação de TV</option>
                            <option value="Instalação de Rádio">Instalação de Rádio</option>
                            <option value="Fusão">Fusão</option>
                            <option value="Shelter(Torres)">Shelter(Torres)</option>
                            <option value="Todos">Todos</option>
                          </select>
                        </div><!-- /.FIM -->
                      <div class="form-group">
                          <label>Tipo da Ferramenta:</label>
                          <select class="form-control" required="" name="tipo" value="'.$tipo.'"  id="tipo">
                            <option value="" disabled selected>'.$tipo.'</option>
                            <option value="EPI">EPI</option>
                            <option value="EPC">EPC</option>
                            <option value="Padrão">Padrão</option>
                          </select>
                        </div><!-- /.FIM-->
                      </div><!-- /.col-md-6 -->
                    </div><!-- /.row -->
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <div class="btn-group pull-right">
                      <button type="submit" class="btn btn-defult">
                        <i class="fa fa-edit"></i> Cadastrar
                      </button>
                      <br>
                      <br>
                    </div>
                  </div><!-- /.box-footer -->

                </form><!-- /#form_cadastro -->
              </div><!-- /.box-body -->
            </div><!-- /.box -->';
            }

            else {
              echo '<div class="box box-primary box-solid ">
              <div class="box-header with-border">
                <h3 class="box-title">Cadastrar Ferramentas</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <form method="post" id="cadastrarFerramentas">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-6">
                        <!-- Nome -->
                        <div class="form-group has-feedback">
                        <label>Nome da Ferramenta:</label>
                          <input type="text" class="form-control" required="" autofocus placeholder="Nome" name="nome" id="nome">
                          <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group">
                          <label>Serializada:</label>
                          <select class="form-control" name="serializada" required="" id="serializada">
                            <option value="" disabled selected>Serializada</option>
                            <option value="true">Sim</option>
                            <option value="false">Não</option>
                          </select>
                        </div><!-- /.FIM-->
                      </div><!-- /.col-md-6 -->
                      <div class="col-md-6">
                  <div class="form-group">
                          <label>Setor:</label>
                          <select class="form-control" name="setor" required="" id="setor">
                            <option value="" disabled selected>Setor</option>
                            <option value="Cabeamento">Cabeamento</option>
                            <option value="Instalação FTTH">Instalação FTTH</option>
                            <option value="Instalação de TV">Instalação de TV</option>
                            <option value="Instalação de Rádio">Instalação de Rádio</option>
                            <option value="Fusão">Fusão</option>
                            <option value="Shelter(Torres)">Shelter(Torres)</option>
                            <option value="Todos">Todos</option>
                          </select>
                        </div><!-- /.FIM -->
                      <div class="form-group">
                          <label>Tipo da Ferramenta:</label>
                          <select class="form-control" name="tipo" required="" id="tipo">
                            <option value="" disabled selected>Tipo da Ferramenta</option>
                            <option value="EPI">EPI</option>
                            <option value="EPC">EPC</option>
                            <option value="Padrão">Padrão</option>
                          </select>
                        </div><!-- /.FIM-->
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
            </div><!-- /.box -->';
            }
            ?>
            <div class="row">
              <div class="col-xs-12">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Lista de Técnicos</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                      <!-- Cabeçalho da tabela -->
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>Tipo</th>
                          <th>Setor</th>
                          <th>Editar</th>
                        </tr>
                      </thead>
                      <!-- Itens da tabela -->
                      <tbody>
                        <?php
                        listFerramentasEPI();
                        ?>
                      </tbody>
                    </table>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!-- /.col -->
            </div><!-- /.row -->
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










    <script type="text/javascript">
      $('#cadastrarFerramentas').submit(function() {
        // Convertemos os dados do formulário para Objeto
        var dados = {};
        $('#cadastrarFerramentas').serializeArray().map(function(x){dados[x.name] = x.value;}); 
        console.log(dados);
        // Configurações para a requisição Ajax
        $.ajax({
          type: "POST",
          url: "/sasInstalacoes/server/cadastrarFerramentas.php",
          data: dados,
          success: function( data ) {
            if (data == false) {
              jQuery.gritter.add({
                title: 'Ferramenta Cadastrada com Sucesso!',
                text: 'Você será redirecionado',
                class_name: 'growl-success',
                image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
                sticky: false,
                time: '2000',
              });
              window.setTimeout("location.href=''",1000);
            }
            else if(data == true) {
              jQuery.gritter.add({
                title: 'Ferramenta já Cadastrada !',
                text: 'Você será redirecionado',
                class_name: 'growl-warning',
                image: '/sasInstalacoes/resources/images/shield-warning-icon.png',
                sticky: false,
                time: '1000',
              });
              window.setTimeout("location.href=''",1000);
            }
          }
        });
        return false;
      })


        $('#editarFerramentas').submit(function() {
        // Convertemos os dados do formulário para Objeto
        var dados = {};
        $('#editarFerramentas').serializeArray().map(function(x){dados[x.name] = x.value;}); 
        console.log(dados);
        // Configurações para a requisição Ajax
        $.ajax({
          type: "POST",
          url: "/sasInstalacoes/server/editarFerramentas.php",
          data: dados,
          success: function( data ) {
            if (data == true) {
              jQuery.gritter.add({
                title: 'Ferramenta Editada com Sucesso!',
                text: 'Você será redirecionado',
                class_name: 'growl-success',
                image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
                sticky: false,
                time: '2000',
              });
              window.setTimeout("location.href='/sasInstalacoes/pages/cadastrarFerramentas.php'",1000);
            }
            else if(data == false) {
              jQuery.gritter.add({
                title: 'Erro ao Editar !',
                text: 'Você será redirecionado',
                class_name: 'growl-warning',
                image: '/sasInstalacoes/resources/images/shield-warning-icon.png',
                sticky: false,
                time: '1000',
              });
              window.setTimeout("location.href='/sasInstalacoes/pages/cadastrarFerramentas.php'",1000);
            }
          }
        });
        return false;
      })
    </script>









    <script type="text/javascript">
      $('#editarTecnicoRecolhimento').submit(function() {
        // Convertemos os dados do formulário para Objeto
        var dados = {};
        $('#editarTecnicoRecolhimento').serializeArray().map(function(x){dados[x.name] = x.value;}); 
        console.log(dados);
        // Configurações para a requisição Ajax
        $.ajax({
          type: "POST",
          url: "/sasInstalacoes/server/editarTecnicoRec.php",
          data: dados,
          success: function( data ) {
            if (data == false) {
              jQuery.gritter.add({
                title: 'Editado com Sucesso!',
                text: 'Você será redirecionado',
                class_name: 'growl-success',
                image: '/sasInstalacoes/resources/images/shield-ok-icon.png',
                sticky: false,
                time: '2000',
              });
              window.setTimeout("location.href='/sasInstalacoes/pages/tecnicosRecolhimento.php'",1000);
            }
            else if(data == true) {
              jQuery.gritter.add({
                title: 'Erro ao Editar !',
                text: 'Você será redirecionado',
                class_name: 'growl-warning',
                image: '/sasInstalacoes/resources/images/shield-warning-icon.png',
                sticky: false,
                time: '1000',
              });
              window.setTimeout("location.href=''",1000);
            }
          }
        });
        return false;
      })
    </script>

  </body>
</html>
