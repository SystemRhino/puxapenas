<?php
if (!isset($_POST['id_vendedor'])) {
  echo "<script>javascript:history.go(-1)</script>";
}else{
  //Validando revendedor
$id = $_POST['id_vendedor'];
    require '../condb.php';

    $sql = "SELECT * FROM tb_revendedor WHERE id = :id";
    $sql = $conn->prepare($sql);
    $sql->bindValue("id", $id);
    $sql->execute();
    $dado = $sql->fetch(PDO::FETCH_ASSOC);

    if ($sql->rowCount() > 0) {
      //Validando user
    $exist_user = "SELECT * FROM tb_users WHERE nm_user = :user";
    $exist_user = $conn->prepare($exist_user);
    $exist_user->bindValue("user", $_POST['login']);
    $exist_user->execute();
    $exist = $exist_user->fetch(PDO::FETCH_ASSOC);

    if ($exist_user->rowCount() > 0) {
      echo "erro user";
    }else{
        //Add user
      try{
      $stmt = $conn->prepare('INSERT INTO tb_users (nm_user,ds_senha,id_revendedor,id_plano,date_inicio,date_fim) VALUES(:nm_user, :ds_senha, :id_revendedor, :id_plano, :date_inicio, :date_fim)');
      $stmt->execute(array(
        ':nm_user' => $_POST['login'],
        ':ds_senha' => $_POST['pass'],
        ':id_revendedor' => $id,
        ':id_plano' => $_POST['id_plano'],
        ':date_inicio' => $_POST['date_inicio'],
        ':date_fim' => $_POST['date_fim']
      ));
      echo "ok";
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
}
    }else{
      echo 'erro revendedor';
    }
}

?>