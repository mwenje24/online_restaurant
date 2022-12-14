<?php

require_once "../assets/config.php";

$id = $_POST['id'];
if(!$id){
    header('Location:user.php');
    exit;
}

$statement = $db->prepare('DELETE FROM user WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location:user.php');

?>