<?php 
$id_v = $_GET['id_v'];
$id_u = $_GET['id_u'];
    require '../condb.php';
$sql = "SELECT * FROM tb_revendedor WHERE id = :id";
    $sql = $conn->prepare($sql);
    $sql->bindValue("id", $id_v);
    $sql->execute();
    $dado = $sql->fetch(PDO::FETCH_ASSOC);

    if ($sql->rowCount() > 0) {
		try {
			$deletar = $conn->prepare("DELETE FROM tb_users WHERE id='$id_u' AND id_revendedor='$id_v'");
			$deletar ->execute();
		} catch(PDOException $e) {
		    echo 'erro';
		}
	}else{
		echo "erro";
	}
?>