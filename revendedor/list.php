<?php 
$login = $_GET['l'];
$senha = $_GET['p'];
    require '../condb.php';

		$sql = "SELECT * FROM tb_revendedor WHERE nm_reven = :login AND ds_reven = :senha";
		$sql = $conn->prepare($sql);
		$sql->bindValue("login", $login);
		$sql->bindValue("senha", $senha);
		$sql->execute();
		$dado = $sql->fetch(PDO::FETCH_ASSOC);
		if ($sql->rowCount() > 0) {
			$json = json_encode($dado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			print_r($json);
		}else{
			echo 'erro';
		}
?>