<?php

require_once "../assets/config.php";
require_once "../assets/functions.php";


$id= $_GET['product_id'];
if(!$id){
    header('Location:index.php');
    exit;
}

//fetching the product details

$stmt = $db->prepare('SELECT * FROM products WHERE product_id = :id');
$stmt->bindValue(':id', $id);
$stmt->execute();
$selected_product = $stmt->fetch(PDO::FETCH_ASSOC);

//assigning product to kot values
$product_id ='';
$kotproduct_id =randomId(10);
$product_id =$selected_product['product_id'];
$description = $selected_product['description'];
$price = $selected_product['price'];
$quantity = 1;
$total = $price * $quantity;

//verifying the product already exixts in kot
$querystmt = $db->prepare('SELECT COUNT(*) as num FROM temp_kot WHERE product_id  = :pid');
$querystmt->bindValue(':pid', $id);
$querystmt->execute();
$temp_kot_check = $querystmt->fetch(PDO::FETCH_ASSOC);

    if($temp_kot_check['num'] > 0){
        $querys = $db->prepare('SELECT * FROM temp_kot WHERE product_id  = :pid');
        $querys->bindValue(':pid', $id);
        $querys->execute();
        $temp_kot = $querys->fetch(PDO::FETCH_ASSOC);

        $quantity = $temp_kot['quantity'] + 1;
        $total = $price * $quantity;
        $statement = $db->prepare("UPDATE temp_kot SET quantity= :quantity, total =:total WHERE product_id =:id");
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':id', $product_id);
        $statement->bindValue(':total', $total);
        $statement->execute();
        header('Location:index.php');
        exit;
    }
    //add new product to kot if doesnt exist
    else{
        $statement = $db->prepare("INSERT INTO temp_kot(kotproduct_id, product_id,description, price, quantity, total) 
        VALUES(:kotproduct_id, :product_id, :description, :price, :quantity , :total)");
        $statement->bindValue(':kotproduct_id', $kotproduct_id);
        $statement->bindValue(':product_id', $product_id);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':total', $total);
        $statement->execute();
        header('Location:index.php');
        exit;
    }


?>