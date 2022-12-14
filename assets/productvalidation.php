<?php

//product list
$statement = $db->prepare("SELECT * FROM products");
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

// if(isset($_GET['action'])){
// 	if($_GET['action']=='search'){
// 	// if($search){
// 		$search = $_GET['categoryname'];
// 	    $statement = $db->prepare("SELECT * FROM products WHERE category LIKE :category");
// 	    $statement->bindValue(':category', "%$search%");
// 	    $statement->execute();
// 	    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
// 	}
// }
// else{
//     $statement = $db->prepare("SELECT * FROM products");
//     $statement->execute();
//     $products = $statement->fetchAll(PDO::FETCH_ASSOC);
// }

//category list
$categorylist = $db->prepare("SELECT * FROM product_category");
$categorylist->execute();
$categorys = $categorylist->fetchAll(PDO::FETCH_ASSOC);

?>