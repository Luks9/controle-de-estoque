<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT');
        require('conectarBD.php');
        $erro = false;
        $status = 'Aguardando Estoquista';
        $estoquista = 'Sistema';
        // Verifica se algo foi postado para publicar ou editar
        if ( isset( $_POST ) && ! empty( $_POST ) ) {

                //var_dump($_POST);
                // Cria as variáveis
                foreach ( $_POST as $chave => $valor ) {
                        $$chave = $valor;
                        // Verifica se existe algum campo em branco
                        if ( empty ( $valor ) ) {
                                // Preenche o erro
                                $erro = 'Existem campos em branco.';
                        }
                }
                // Verifica se as variáveis foram configuradas
                if ( empty( $tecnico ) ) {
                        $erro = 'Existem campos em branco.';
                }

        else {
        $pdo_insere = $conexao_pdo->prepare('INSERT INTO t_solicitacao_material (supervisor,tecnico,total_onu,total_stb,total_radio, total_conector_scapc, total_conector_scpc, total_conector_rj45, total_cabo_rede, total_cabo_optico,total_bap,status,observacao,estoquista,estoquista_solicitado) VALUES (?, ? ,? ,?, ?, ? ,? ,?, ?, ?, ?, ?, ?, ?, ?)');
        $pdo_insere->execute( array($supervisor, $tecnico, $total_onu, $total_stb, $total_radio, $total_conector_scapc, $total_conector_scpc, $total_conector_rj45,$total_cabo_rede,$total_cabo_optico,$total_bap,$status,$observacao,$estoquista,$estoquista_solicitado) );
        $return = true;
        echo $return;
                        }
                }
?>

