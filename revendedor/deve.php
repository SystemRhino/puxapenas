<?php
if (!isset($_POST['id_vendedor'])) {
	echo "<script>javascript:history.go(-1)</script>";
}else{
$id_vendedor = $_POST['id_vendedor'];
    require '../condb.php';

		$sql_vendas_painel = "SELECT COUNT(id_painel) FROM tb_vendas WHERE id_vendedor = :id_vendedor";
		$sql_vendas_painel = $conn->prepare($sql_vendas_painel);
		$sql_vendas_painel->bindValue("id_vendedor", $id_vendedor);
		$sql_vendas_painel->execute();
		$dado_painel = $sql_vendas_painel->fetch(PDO::FETCH_ASSOC);
		if ($sql_vendas_painel->rowCount() > 0) {
			$json = json_encode($dado_painel, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			print_r($json);
		}else{
			echo 'erro';
		}

		$sql_vendas_link = "SELECT COUNT(id_links) FROM tb_vendas WHERE id_vendedor = :id_vendedor";
		$sql_vendas_link = $conn->prepare($sql_vendas_link);
		$sql_vendas_link->bindValue("id_vendedor", $id_vendedor);
		$sql_vendas_link->execute();
		$dado_link = $sql_vendas_link->fetch(PDO::FETCH_ASSOC);
		if ($sql_vendas_link->rowCount() > 0) {
			$json = json_encode($dado_link, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			print_r($json);
		}else{
			echo 'erro';
		}
}
?>