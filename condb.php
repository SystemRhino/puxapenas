<?php
try {
  $conn = new PDO('mysql:host=localhost;dbname=id20249541_puxapenas', 'id20249541_rhino2018', 'Rhino2018#@');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>