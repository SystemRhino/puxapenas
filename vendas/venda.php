<?php
  //Validando revendedor
if (!isset($_POST['id_vendedor'])) {
  echo "<script>javascript:history.go(-1)</script>";
}else{
$id = $_POST['id_vendedor'];
    require '../condb.php';

    $sql_revendedor = "SELECT * FROM tb_revendedor WHERE id = :id";
    $sql_revendedor = $conn->prepare($sql_revendedor);
    $sql_revendedor->bindValue("id", $id);
    $sql_revendedor->execute();
    $dado_revendedor = $sql_revendedor->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM tb_vendas WHERE id_vendedor = :id";
    $sql = $conn->prepare($sql);
    $sql->bindValue("id", $id);
    $sql->execute();
    $dado = $sql->fetch(PDO::FETCH_ASSOC);

    $sql_vendas_links = "SELECT * FROM tb_vendas WHERE id_vendedor = :id AND id_links = 1";
    $sql_vendas_links = $conn->prepare($sql_vendas_links);
    $sql_vendas_links->bindValue("id", $id);
    $sql_vendas_links->execute();
    $fetch_link = $sql_vendas_links->fetchAll();
    $dado_vendas_link = count($fetch_link);


    $sql_vendas_plano = "SELECT * FROM tb_vendas WHERE id_vendedor = :id AND id_planos = 1";
    $sql_vendas_plano = $conn->prepare($sql_vendas_plano);
    $sql_vendas_plano->bindValue("id", $id);
    $sql_vendas_plano->execute();
    $fetch_plano = $sql_vendas_plano->fetchAll();
    $dado_vendas_plano = count($fetch_plano);

    if ($sql_revendedor->rowCount() > 0) {
        //Add venda
      try{
      $stmt = $conn->prepare('INSERT INTO tb_vendas (id_vendedor,id_planos,id_links) VALUES(:id_vendedor, :id_planos, :id_links)');
      $stmt->execute(array(
        ':id_vendedor' => $id,
        ':id_planos' => $_POST['id_plano'],
        ':id_links' => $_POST['id_link']
      ));

            //Remove credito
    $creditos = $dado_revendedor['vl_creditos']-1;
    $sql_creditos_update = "UPDATE tb_revendedor SET vl_creditos='$creditos' WHERE id='$id'";
    $sql_creditos_update = $conn->prepare($sql_creditos_update);
    $sql_creditos_update->execute();

    
     //Add deve
    if ($_POST['id_plano'] === '1') {
      $vl_plano = 10;
    }elseif($_POST['id_plano'] === '2'){
      $vl_plano = 15;
    }elseif($_POST['id_plano'] === '3'){
      $vl_plano = 20;
    }elseif($_POST['id_plano'] === '0'){
      $vl_plano = 0;
    }

    if ($_POST['id_link'] !== '0') {
      $deve_links = 15;
    }else{
      $deve_links = 0;
    }
    if ($_POST['id_plano'] !== '0') {
      $deve_plano = $vl_plano;
    }else{
      $deve_plano = 0;
    }

    $deve = $dado_revendedor['vl_deve']+$deve_links+$deve_plano;
    echo $deve;
    $sql_deve_update = "UPDATE tb_revendedor SET vl_deve='$deve' WHERE id='$id'";
    $sql_deve_update = $conn->prepare($sql_deve_update);
    $sql_deve_update->execute();

      echo "ok";
    } catch(PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
    }else{
      echo 'erro ao add venda';
    }
}


?>