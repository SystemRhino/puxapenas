<?php  
if (!isset($_POST['id_vendedor']) || !isset($_POST['id_user'])) {
	echo "<script>javascript:history.go(-1)</script>";
}else{
$id_v = $_POST['id_vendedor'];
$id_u = $_POST['id_user'];
    require '../condb.php';

    $sql_deve_update = "UPDATE tb_user SET id_plano='$id_plano', date_fim='$da_fim' WHERE id='$id_user'";
    $sql_deve_update = $conn->prepare($sql_deve_update);
    $sql_deve_update->execute();
}
?>