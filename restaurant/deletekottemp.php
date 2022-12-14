<?php

require_once "../assets/config.php";

$kottemp_id = $_POST['kotproduct_id'];
if(!$kottemp_id){
    header('Location:index.php');
    exit;
}

$statement = $db->prepare('DELETE FROM temp_kot WHERE kotproduct_id = :id');
$statement->bindValue(':id', $kottemp_id);
$statement->execute();

 header('Location:index.php');

?>