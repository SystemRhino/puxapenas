<?php 
    require '../condb.php';

		$sql = "SELECT * FROM tb_atualizar";
		$sql = $conn->prepare($sql);
		$sql->execute();
		$dado = $sql->fetch(PDO::FETCH_ASSOC);
		if ($sql->rowCount() > 0) {
			$json = json_encode($dado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			print_r($json);
		}else{
			echo 'erro';
		}
?>