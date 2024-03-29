<?php 
if (!isset($_POST['id_vendedor']) || !isset($_POST['id_user'])) {
	echo "<script>javascript:history.go(-1)</script>";
}else{
$id_vendedor = $_POST['id_vendedor'];
$id_usuario = $_POST['id_user'];
    require '../condb.php';
$sql = "SELECT * FROM tb_revendedor WHERE id = :id";
    $sql = $conn->prepare($sql);
    $sql->bindValue("id", $id_vendedor);
    $sql->execute();
    $dado = $sql->fetch(PDO::FETCH_ASSOC);

    if ($sql->rowCount() > 0) {
		try {
			$deletar = $conn->prepare("DELETE FROM tb_users WHERE id='$id_usuario' AND id_revendedor='$id_vendedor'");
			$deletar ->execute();
		} catch(PDOException $e) {
		    echo 'erro';
		}
	}else{
		echo "erro";
	}
}
?>