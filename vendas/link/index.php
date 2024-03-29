<?php 
if (!isset($_POST['id_vendedor'])) {
	echo "<script>javascript:history.go(-1)</script>";
}else{
$id_vendedor = $_POST['id_vendedor'];
    require '../condb.php';

		$sql = "SELECT COUNT(id_links) FROM tb_vendas WHERE id_vendedor = :id_vendedor AND id_links = 1";
		$sql = $conn->prepare($sql);
		$sql->bindValue("id_vendedor", $id_vendedor);
		$sql->execute();
		$dado = $sql->fetch(PDO::FETCH_ASSOC);
		if ($sql->rowCount() > 0) {
			$json = json_encode($dado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			print_r($json);
		}else{
			echo 'erro';
		}
}
?>