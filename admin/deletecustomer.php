<?php

require_once "../assets/config.php";

$id = $_POST['id'];
if(!$id){
    header('Location:customers.php');
    exit;
}

$statement = $db->prepare('DELETE FROM customer WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location:customers.php');

?>