<?php

require_once "../assets/config.php";

$supplier_id = $_POST['supplier_id'];
if(!$supplier_id){
    header('Location:supplier.php');
    exit;
}

$statement = $db->prepare('DELETE FROM supplier WHERE supplier_id = :id');
$statement->bindValue(':id', $supplier_id);
$statement->execute();

header('Location:supplier.php');

?>