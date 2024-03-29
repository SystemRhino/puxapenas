<?php
if (!isset($_POST['id_vendedor'])) {
	echo "<script>javascript:history.go(-1)</script>";
}else{
$id_vendedor = $_POST['id_vendedor'];
    require '../condb.php';

    $sql_revendedor = "SELECT * FROM tb_revendedor WHERE id = :id";
    $sql_revendedor = $conn->prepare($sql_revendedor);
    $sql_revendedor->bindValue("id", $id_vendedor);
    $sql_revendedor->execute();

    if ($sql_revendedor->rowCount() > 0) {
		$sql_link = "SELECT * FROM tb_links WHERE id = (SELECT max(id) from tb_links) AND id_vendedor = 0";
		$sql_link = $conn->prepare($sql_link);
		$sql_link->execute();

		if ($sql_link->rowCount() > 0) {
		$dado_link = $sql_link->fetch(PDO::FETCH_ASSOC);
		$id_link = $dado_link['id'];
			$json = json_encode($dado_link, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			print_r($json);
				if($json !== 'false'){
					$id_link = $dado_link['id'];
				try {
              			//Atualiza Link
    				$sql_link_update = "UPDATE tb_links SET id_vendedor='$id_vendedor' WHERE id='$id_link'";
    				$sql_link_update = $conn->prepare($sql_link_update);
    				$sql_link_update->execute();
            		} catch(PDOException $e) {
            			echo "erro delete";
            		}
				}
		}else{
		$sql_link = "SELECT * FROM tb_links WHERE id_vendedor=0 ORDER BY (id) ASC LIMIT 1";
		$sql_link = $conn->prepare($sql_link);
		$sql_link->execute();

		if ($sql_link->rowCount() > 0) {
		$dado_link = $sql_link->fetch(PDO::FETCH_ASSOC);
		$id_link = $dado_link['id'];
			$json = json_encode($dado_link, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			print_r($json);
				if($json !== 'false'){
					$id_link = $dado_link['id'];
				try {
              			//Atualiza Link
    				$sql_link_update = "UPDATE tb_links SET id_vendedor='$id_vendedor' WHERE id='$id_link'";
    				$sql_link_update = $conn->prepare($sql_link_update);
    				$sql_link_update->execute();
            		} catch(PDOException $e) {
            			echo "erro delete";
            		}
				}
		}else{
			echo 'erro';
		}
		}
}
}
?>