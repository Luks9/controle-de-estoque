<?php
  require ('conectarBD.php');
  $usuario = $_POST['idtecnico'];
  //var_dump($usuario);
  // verifica se foi enviado um arquivo


  // verifica se foi enviado um arquivo .
  if(isset($_FILES['foto']['name']) && $_FILES["foto"]["error"] == 0){
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $nome = $_FILES['foto']['name'];
    // Pegamos a extensão
    $extensao = strrchr($nome, '.');
    $extensao = strtolower($extensao);
   
    //Verifica o tipo de arquivo
    if(strstr('.jpg;.jpeg;.png;', $extensao)){
        //Renomeia a foto
      $novoNome = md5(microtime()) . $extensao;
      $destino = 'Fotos/' . $novoNome;
          //Salva na pasta Fotos
      if( move_uploaded_file( $foto_tmp, $destino  )){
        try { // Aqui realizamos o try catch
          $pdo_insere = $conexao_pdo->prepare("UPDATE t_tecnicos SET foto = :novoNome WHERE id = :idtec");
          $pdo_insere->bindParam(':novoNome', $novoNome);
          $pdo_insere->bindParam(':idtec', $usuario);
          $pdo_insere->execute();
        } catch (Exception $e) {
          print_r($e);
        }       //Retornamos para o ajax True se de certo.
          $return = true;
          echo $return;
          //echo $usuario;
      } else {
                //Retornamos para o ajax False se de errado.
          $return1 = false;
          echo $return1;
      }
    } else {
      //erro
    }
  } else {
    //sem imagem
  }
?>