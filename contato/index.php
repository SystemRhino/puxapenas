<?php 
    require '../condb.php';

$sql = "SELECT * FROM tb_contato";
    $sql = $conn->prepare($sql);
    $sql->execute();
    if ($sql->rowCount() > 0) {
			while ($dado = $sql->fetch(PDO::FETCH_ASSOC)) {
			$json = json_encode($dado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			print_r($json);
			}
		}else{
			echo 'erro';
		}
?>