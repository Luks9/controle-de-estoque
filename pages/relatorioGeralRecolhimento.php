<?php
  // Chamados o arquivo com Menu
  include ('../_headerMenu.php');
  require ('../server/listarRelatorioRecolhimento.php');
?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Técnicos<small>Recolhimento</small></h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#">Recolhimento</a></li>
            <li class="active">Técnicos Recolhimento</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="col-md-13">
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
                          <th>Retirados<
                        </tr>
                      </thead>
                      <!-- Itens da tabela -->
                      <tbody>
                        <?php
                        listTecnicosRecolhimento();
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
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $("#cpf").inputmask("###.###.###-##");
        $("#telefone").inputmask("(###) ####-#####");
      });
    </script>
    <script type="text/javascript">
      $('#formCadastrarTecnicoRecolhimento').submit(function() {
        // Convertemos os dados do formulário para Objeto
        var dados = {};
        $('#formCadastrarTecnicoRecolhimento').serializeArray().map(function(x){dados[x.name] = x.value;}); 
        console.log(dados);
        // Configurações para a requisição Ajax
        $.ajax({
          type: "POST",
          url: "/sasInstalacoes/server/cadastrarTecnicoRecolhimento.php",
          data: dados,
          success: function( data ) {
            if (data == false) {
              jQuery.gritter.add({
                title: 'Técnico Cadastrado com Sucesso!',
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
                title: 'Técnico já Cadastrado !',
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
