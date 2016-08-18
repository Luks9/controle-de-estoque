<?php
function mostrarSaidasLogs() {
		require ('conectarBD.php');
		$consultarSeriais = $conexao_pdo->prepare("SELECT * FROM t_saida_material_logs ORDER BY id_os_gerada DESC");
		$consultarSeriais->execute();
		$result = array();
		$TotalRegistros = $consultarSeriais->rowCount();
		while($v = $consultarSeriais->fetch(PDO::FETCH_ASSOC))  {
			$result[] = $v;
			$hora = $v['horario'];
			$hora2 = $hora[0].$hora[1].$hora[2].$hora[3].$hora[4].$hora[5].$hora[6].$hora[7];
			$id_os = $v['id_os_gerada'];
			echo "<td>" .$v['os'] . "</td>";
			echo "<td>" .$id_os . "</td>";
			echo "<td>" .$v['data_log'] . "</td>";
			echo "<td>" .$hora2 . "</td>";
			echo "<td>" .'Saída de Material' . "</td>";
			echo "<td>" .$v['usuario'] . "</td>";
			echo "<td>" .$v['base'] . "</td>";
			if ($v['base'] == 'Escritórios') {
			echo "<td>".'<a href="/sasInstalacoes/server/gerarPDF.php?valor=ok&id='.$id_os.'"><i class="fa fa-file-pdf-o"></a>'."</td>";
			}
			else {
			echo "<td>".'<a href="/sasInstalacoes/server/gerarPDF2.php?valor=ok&id='.$id_os.'"><i class="fa fa-file-pdf-o"></a>'."</td>";
			}
			echo "</tr>";
		}

		echo '
		<a class="btn btn-app">
		<span class="badge bg-red">'.$TotalRegistros.'</span>
		<i class="fa fa-barcode"></i> Total de Registros
		</a>

		<a href="logsTecnicos.php" class="btn btn-app">
		<span class="badge bg-orange"></span>
		<i class="fa fa-inbox"></i> Logs Técnicos
		</a>
		<a href="logsEscritorios.php" class="btn btn-app">
		<span class="badge bg-orange"></span>
		<i class="fa fa-inbox"></i> Logs Escritórios
		</a>
		';


	}

	function mostrarSolicitacoes() {
		require ('conectarBD.php');
		$consultarSeriais = $conexao_pdo->prepare("SELECT * FROM t_solicitacao_material ORDER BY id DESC");
		$consultarSeriais->execute();
		$result = array();
		$TotalRegistros = $consultarSeriais->rowCount();
		while($v = $consultarSeriais->fetch(PDO::FETCH_ASSOC))  {
			$result[] = $v;
			$span = $v['status'];

			switch ($span) {
				case 'Aguardando Estoquista':
					$span = '<span class="label label-danger" style="font-size:12px;">Aguardando Estoquista</span>';
					break;
				case 'Verificando':
					$span = '<span class="label label-primary" style="font-size:12px;">Verificando</span>';
					break;
				case 'Material Separado':
					$span = '<span class="label label-danger" style="font-size:12px;">Material Separado</span>';
					break;
				case 'Adiado':
					$span = '<span class="label label-warning" style="font-size:12px;">Solicitação Adiada</span>';
					break;
				case 'Finalizado':
					$span = '<span class="label label-success" style="font-size:12px;">Finalizado</span>';
					break;	
				default:
					break;
			}

			echo "<td>" .$v['id'] . "</td>";
			echo "<td>" .$v['supervisor'] . "</td>";
			echo "<td>" .$v['tecnico'] . "</td>";
			echo "<td>" .$v['data'] . "</td>";
			echo "<td>Solicitação de Material</td>";
			echo "<td>" .$span. "</td>";
			echo "<td>" .$v['estoquista']. "</td>";
			echo "<td>".'<a href="/sasInstalacoes/pages/mostrarMaterialSolicitado.php?metodo=mostrarMaterial&id='.$v['id'].'"><i class="fa fa-search-minus"></a>'."</td>";
			echo "</tr>";
		}

		echo '
		<a class="btn btn-app">
		<span class="badge bg-red">'.$TotalRegistros.'</span>
		<i class="fa fa-info"></i> Total de Solicitações
		</a>
		';


	}

	function mostrarSaidasLogsTecnico() {
		require ('conectarBD.php');
		$consultarSeriais = $conexao_pdo->prepare("SELECT * FROM t_saida_material_logs, t_tecnicos WHERE t_saida_material_logs.id_tecnico = t_tecnicos.id
        ORDER BY id_log DESC");
		$consultarSeriais->execute();
		$result = array();
		$TotalRegistros2 = $consultarSeriais->rowCount();
		while($v = $consultarSeriais->fetch(PDO::FETCH_ASSOC))  {
			$result[] = $v;
			$hora = $v['horario'];
			$hora2 = $hora[0].$hora[1].$hora[2].$hora[3].$hora[4].$hora[5].$hora[6].$hora[7];
			$data_log = $v['data_log'];
			$hora_log = $hora2;
			$usuario = $v['usuario'];
			$recebeu_material = $v['nome'];	
			$osIntranet = $v['os'];	
		 
		    echo '<p><pre><b>OS Intranet:</b> '.$osIntranet.' <b>Data:</b> '.$data_log.' <b>Hora:</b> '.$hora_log.' <b>Action:</b> '.'Saída de Material'.' <b>Estoquista:</b> '.$usuario.' <b>Para</b> ('.$recebeu_material.')</pre></p>';

		}

	}

	function mostrarSaidasLogsEscritorio() {
		require ('conectarBD.php');
		$consultarSeriais = $conexao_pdo->prepare("SELECT * FROM t_saida_material_logs, t_escritorios WHERE t_saida_material_logs.id_tecnico = t_escritorios.id
        ORDER BY id_log DESC");
		$consultarSeriais->execute();
		$result = array();
		$TotalRegistros2 = $consultarSeriais->rowCount();
		while($v = $consultarSeriais->fetch(PDO::FETCH_ASSOC))  {
			$result[] = $v;
			$hora = $v['horario'];
			$hora2 = $hora[0].$hora[1].$hora[2].$hora[3].$hora[4].$hora[5].$hora[6].$hora[7];
			$data_log = $v['data_log'];
			$hora_log = $hora2;
			$usuario = $v['usuario'];
			$recebeu_material = $v['nome_escritorio'];	
		 
		    echo '<p><pre><b>Data:</b> '.$data_log.' <b>Hora:</b> '.$hora_log.' <b>Action:</b> '.'Saída de Material'.' <b>Estoquista:</b> '.$usuario.' <b>Para</b> ('.$recebeu_material.') </pre></p>';

		}

	}

	function mostrarSaidaInstalacao() {
		require ('conectarBD.php');
		$consultaInstalacao = $conexao_pdo->prepare("SELECT * FROM t_instalacoes, t_tecnicos WHERE t_instalacoes.id_tecnico = t_tecnicos.id and (status = 'false' or status = 'Observação' )");
		$consultaInstalacao->execute();
		$result = array();
		while($v = $consultaInstalacao->fetch(PDO::FETCH_ASSOC))  {
			$result[] = $v;
			if ($v['status'] == 'Observação') {
			    $span = '<span class="badge bg-yellow">'.$v['status'].'</span>';
			}
			elseif ($v['status'] == 'false') {
				$span = '<span class="badge bg-red">Não Confirmado</span>';
			}

			echo "<td>" .$v['nome_cliente'] . "</td>";
			echo "<td>" .$v['tecnologia'] . "</td>";
			echo "<td>" .$v['data_instalacao'] . "</td>";
			echo "<td>" .$v['nome'] . "</td>";
			echo "<td>" .$v['nome_supervisor'] . "</td>";
			echo "<td>" .$v['tipo'] . "</td>";
			echo "<td>" .$span . "</td>";
			echo "<td> <button type='button' class='btn btn-default' data-toggle=\"modal\"  data-target=\"#confirmeMaterial\" id='form' onclick='passValue(". $v['id_instalacao'].", ". $v['id_tecnico'].", \"" . $v['nome_cliente'] . "\", \"" . $v['qnt_cabo_rede'] . "\", \"" . $v['qnt_cabo_optico'] . "\", \"" . $v['qnt_conectores_rj45'] . "\", \"" . $v['qnt_conectores'] . "\", \"" . $v['qnt_conectores2'] . "\",\"" . $v['onu'] . "\", \"" . $v['stb'] . "\", \"" . $v['qnt_bap'] . "\", \"" . $v['qnt_radio'] . "\", \"" . $v['telefone'] . "\", \"" . $v['data_instalacao'] . "\", \"" . $v['tecnologia'] . "\" )' > Visualizar </button> </td>";
			echo "</tr>";
		}

	}
   function mostrarRecolhimento() {
		require ('conectarBD.php');
		$material_recolhimento = $conexao_pdo->prepare("SELECT id_recolhimento, tecnico, cidade, motivo, cliente, status, equipamento, data, observacao, tipo FROM t_recolhimento WHERE tipo = 'tecnico' AND  status = 'Aguardando' OR status = 'Observaçao'");
		$material_recolhimento->execute();
		$result = array();
		while($v = $material_recolhimento->fetch(PDO::FETCH_ASSOC))  {
			$result[] = $v;
			if ($v['status'] == 'Observaçao') {
			    $span = '<span class="badge bg-yellow">'.$v['status'].'</span>';
			}
			elseif ($v['status'] == 'Aguardando') {
				$span = '<span class="badge bg-red">Não Confirmado</span>';
			}
			if ($v['equipamento'] == '1') {$equip= "Radio";}	
			elseif ($v['equipamento'] == '2') {$equip= "ONU";}
			elseif ($v['equipamento'] == '3') {$equip= "SetupBox";}
			$data = explode(" ", $v['data']);
			$data = explode("-", $data[0]);
			$data2 = $data[2]."-".$data[1]."-".$data[0];

			echo "<tr>";
			echo "<td>" .$v['id_recolhimento'] . "</td>";
			echo "<td>" .$v['tecnico'] . "</td>";
			echo "<td>" .$v['cidade'] . "</td>";
			echo "<td>" .$v['motivo'] . "</td>";
			echo "<td>" .$v['cliente']. "</td>";
			echo "<td>" .$equip."</td>";
			echo "<td>" .$data2. "</td>";
			echo "<td>" .$span . "</td>";
			echo "<td> <button type='button' class='btn btn-default' data-toggle=\"modal\"  data-target=\"#confirmeRecolhimento\" id='form2' onclick='passValue2(". $v['id_recolhimento'].", ". $v['equipamento'].", \"" .$v['tecnico']."\")' > Visualizar </button> </td>";
			echo "</tr>";
		}

	}

	   function mostrarRecolhimentoKIT() {
		require ('conectarBD.php');
		$material_recolhimento = $conexao_pdo->prepare("SELECT * FROM t_recolhimento WHERE tipo <> 'tecnico'
");
		$material_recolhimento->execute();
		$result = array();
		while($v = $material_recolhimento->fetch(PDO::FETCH_ASSOC))  {
			$result[] = $v;
			if ($v['status'] == 'Observaçao') {
			    $span = '<span class="badge bg-yellow">'.$v['status'].'</span>';
			}
			elseif ($v['status'] == 'Aguardando') {
				$span = '<span class="badge bg-red">Não Confirmado</span>';
			}
			elseif ($v['status'] == 'Ok') {
				$span = '<span class="badge bg-green">Confirmado</span>';
			}
			if ($v['equipamento'] == '1') {$equip= "Radio";}	
			elseif ($v['equipamento'] == '2') {$equip= "ONU";}
			elseif ($v['equipamento'] == '3') {$equip= "SetupBox";}
			elseif ($v['equipamento'] == '4') {$equip= "Combo";}
			elseif ($v['equipamento'] == '5') {$equip= "Celular";}
			$data = explode(" ", $v['data']);
			$data = explode("-", $data[0]);
			$data2 = $data[2]."-".$data[1]."-".$data[0];


			switch ($v['status_equipamento']) {
				case 'Estoque Local':
					$val = '<span class="badge bg-red">Estoque Local</span>';
					break;
				case 'Reutilizado':
					$val = '<span class="badge bg-green">Reutilizado</span>';
					break;
				case 'Migrado Estoque':
					$val = '<span class="badge bg-yellow">Migrado Estoque</span>';
					break;
				case 'Estoque do Técnico':
					$val = '<span class="badge bg-blue">Estoque do Técnico</span>';
					break;
				case 'Retornado a Central':
					$val = '<span class="badge bg-gray">Retornado a Central</span>';
					break;				
				default:
					# code...
					break;
			}

			echo "<tr>";
			echo "<td>" .$v['tecnico_selecionado'] . "</td>";
			echo "<td>" .$v['cidade'] . "</td>";
			echo "<td>" .$v['motivo'] . "</td>";
			echo "<td>" .$v['cliente']. "</td>";
			echo "<td>" .$equip."</td>";
			echo "<td>" .$v['data_recolhimento']. "</td>";
			echo "<td>" .$span . "</td>";
			echo "<td>" .$val. "</td>";
			echo "<td> <button type='button' class='btn btn-default' data-toggle=\"modal\"  data-target=\"#confirmeRecolhimento\" id='form2' onclick='passValue2(". $v['id_recolhimento'].", ". $v['equipamento'].", \"" .$v['tecnico_selecionado']."\")' > Visualizar </button> </td>";
			echo "<td><a href='#'><i class='fa fa-fw fa-edit' data-toggle=\"modal\"  data-target=\"#editRecolhimento\" id='form2' onclick='add_val(\"" .$v['id_recolhimento']."\", \"". $v['equipamento']."\", \"" .$v['tecnico_selecionado']."\", \"" .$v['cliente']."\", \"" .$v['motivo']."\", \"".$v['status_equipamento']."\", \"".$v['observacao']."\")'> </i></td>";
			echo "</tr>";
		}

	}


   // METODOS DA FUNCAO MOSTRAR MATERIAL
	if($_GET['metodo'] == 'alterarStatus')
    {
      try
      {
    require ('conectarBD.php');
    $estoquista = $_SESSION['nome_usuario'];
    $id_pagina = $_GET['id'];
    $valor = $_GET['valor'];
    $stmt = $conexao_pdo->prepare("UPDATE t_solicitacao_material SET status = :nome, estoquista = '$estoquista' WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->bindParam(':nome', $valor, PDO::PARAM_STR);
    $stmt->execute();
    echo "<script>alert('Alterado com Sucesso!')</script>";
    echo "<script>location.href = '/sasInstalacoes/pages/mostrarMaterialSolicitado.php?metodo=mostrarMaterial&id=$id_pagina'</script>";
      }
      catch(PDOException $e)
      {
    echo $e->getMessage();
      }
    }	



   function listTecnicosRecolhimento () {
    require ('conectarBD.php');
	$stmt = $conexao_pdo->prepare("SELECT * FROM t_tecnicos_recolhimento ORDER BY id");
    $stmt->execute();
    $total = $stmt->rowCount();
    $result = array();
     while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
           $result[] = $r;
              echo "<td>" .$r['nome'] . "</td>";
              echo "<td>" .$r['setor'] . "</td>";
              echo "<td>" .  '<a href="tecnicosRecolhimento.php?id='.$r['id'].'&nome='. $r['nome'] .'&setor='. $r['setor'] .'&metodo=Editar"><i class="fa fa-edit"></a>' . "</td>";
              echo "</tr>";         
           }

    }
 

    function listFerramentasEPI () {
    require ('conectarBD.php');
	$stmt = $conexao_pdo->prepare("SELECT * FROM t_ferramentas_cadastradas");
    $stmt->execute();
    $total = $stmt->rowCount();
    $result = array();
     while($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
           $result[] = $r;
              echo "<td>" .$r['nome'] . "</td>";
              echo "<td>" .$r['tipo'] . "</td>";
              echo "<td>" .$r['setor'] . "</td>";
              echo "<td>" .  '<a href="cadastrarFerramentas.php?id='.$r['id_fer'].'&nome='. $r['nome'].'&tipo='. $r['tipo'] .'&setor='. $r['setor'] .'&metodo=editarFerramentas"><i class="fa fa-edit"></a>' . "</td>";
              echo "</tr>";         
           }

    }


   // METODOS DA FUNCAO MOSTRAR MATERIAL
	if($_GET['metodo'] == 'alterarStatus')
    {
      try
      {
    require ('conectarBD.php');
    $estoquista = $_SESSION['nome_usuario'];
    $id_pagina = $_GET['id'];
    $valor = $_GET['valor'];
    $stmt = $conexao_pdo->prepare("UPDATE t_solicitacao_material SET status = :nome, estoquista = '$estoquista' WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->bindParam(':nome', $valor, PDO::PARAM_STR);
    $stmt->execute();
    echo "<script>alert('Alterado com Sucesso!')</script>";
    echo "<script>location.href = '/sasInstalacoes/pages/mostrarMaterialSolicitado.php?metodo=mostrarMaterial&id=$id_pagina'</script>";
      }
      catch(PDOException $e)
      {
    echo $e->getMessage();
      }
    }	



?>