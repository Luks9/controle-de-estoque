<?php

function listTecnicosRecolhimento () {
    require ('conectarBD.php');
	$stmt = $conexao_pdo->prepare("SELECT tecnico_selecionado, status_equipamento, COUNT(status_equipamento) totalCount FROM t_recolhimento WHERE tipo = 'interno' GROUP BY tecnico_selecionado, status_equipamento
");
    $stmt->execute();
    $total = $stmt->rowCount();
    $result = array();
     while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {

     		switch ($r['status_equipamento']) {
     			case '':
     				# code...
     				break;
     			
     			default:
     				# code...
     				break;
     		}

           $result[] = $r;
              echo "<td>" .$r['tecnico_selecionado'] . "</td>";
              echo "<td>" .$r['status_equipamento'] . "</td>";
              echo "</tr>";         
           }

    }

?>