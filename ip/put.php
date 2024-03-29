<?php  
if (!isset($_POST['user']) || !isset($_POST['ip'])) {
	echo "<script>javascript:history.go(-1)</script>";
}else{
	$user = $_POST['user'];
	$ip = $_POST['ip'];
    require '../condb.php';
	try {
            //Atualiza IP
    	$sql_link_update = "UPDATE tb_users SET ip='$ip' WHERE nm_user='$user'";
    	$sql_link_update = $conn->prepare($sql_link_update);
    	$sql_link_update->execute();
    	echo "ok";
    } catch(PDOException $e) {
        echo "erro update ip";
    }
}
?>