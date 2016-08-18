<?php
// Chamamos o arquivo de conexão com o banco
 require('conectarBD.php');
// Prepara uma sentença para ser executada via POST
  $nome  = $_POST['nome'];
  $telefone = $_POST['telefone'];
  $usuario =  $_POST['usuario'];
  $senha =  $_POST['senha'];
  $setor =  $_POST['setor'];
  $email =  $_POST['email'];

  $consulta = $pdo->prepare("SELECT * FROM t_usuarios where usuario = :usuario;");
  $consulta->bindParam(':usuario', $_POST['usuario'], PDO::PARAM_STR);
  $consulta->execute();
  $linha = $consulta->fetch(PDO::FETCH_ASSOC);

  if ($linha == true) {
      echo "<script>alert('Usuário já existi'); history.back();</script>"
  }
   else {

  //else {

   $statement = $pdo->prepare('INSERT INTO t_usuarios (nome, telefone, usuario, senha, setor, email) VALUES (:nome,:telefone, :usuario, :senha, :setor, :email)');

    
   // Adiciona os dados acima para serem executados na sentença
   $statement->bindParam(':nome', $nome);
   $statement->bindParam(':telefone',$telefone);
   $statement->bindParam(':usuario', $usuario);
   $statement->bindParam(':senha', $senha);
   $statement->bindParam(':setor', $setor);
   $statement->bindParam(':email', $email);
   
   // Executa a sentença já com os valores
   if($statement->execute()){
   // Definimos a mensagem de sucesso
     $retorno = 1;
     json_encode($retorno);
   }else{
    // Definimos a mensagem de erro
    $_SESSION['message'] = 'Falha ao cadastrar usuário';
   //W}
  				}
  			
  		}
  	}
  ?>