<?php
header('Access-Control-Allow-Origin: *'); header('Access-Control-Allow-Methods: GET, POST, PUT');

    // chamamos a conexão PDO
        require('conectarBD.php');

    // checamos se todos os dados estão preenchidos

        if ( isset( $_POST ) && ! empty( $_POST ) ) {
                // Cria as variáveis
                foreach ( $_POST as $chave => $valor ) {
                        $$chave = $valor;
                        if ($chave == 'id_tecnico') {
                                $acesso = true;
                        } elseif ($chave == 'id_estoque') {
                                $acesso = false;
                        }

                        //echo $chave;
                }
                //echo $id_tecnico;
                if ($acesso) {
                        // verifico se o técnico já foi cadastrado para apenas atualizar seus dados
                        $stmt = $conexao_pdo->prepare("SELECT * FROM t_estoque_tecnico WHERE id_tecnico = '$id_tecnico' LIMIT 1");
                        $stmt->execute();
                        $result = array();
                        while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $result = $r['id'];
                                echo $result;
                                $stmtt = $conexao_pdo->prepare("SELECT * FROM t_estoque_serializados WHERE id_estoque_quantidade = '$result' AND status = true AND nome = '$equipamento'");
                                $stmtt->execute();
                                while ($rr = $stmtt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option value='" . $rr['serial'] . "'>" . $rr['serial'] . "</option>";
                                }
                        }
                } else {
                        $stmtt = $conexao_pdo->prepare("SELECT * FROM t_estoque_serializados WHERE id_estoque_quantidade = '$id_estoque' AND nome = '$equipamento'");
                        $stmtt->execute();
                        while ($rr = $stmtt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $rr['serial'] . "'>" . $rr['serial'] . "</option>";
                        }
                }
        }

?>
