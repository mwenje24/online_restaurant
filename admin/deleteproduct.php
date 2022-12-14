<?php

require_once "../assets/config.php";

$product_id = $_POST['product_id'];
if(!$product_id){
    header('Location:products.php');
    exit;
}

$statement = $db->prepare('DELETE FROM products WHERE product_id = :id');
$statement->bindValue(':id', $product_id);
$statement->execute();

header('Location:products.php');

?>