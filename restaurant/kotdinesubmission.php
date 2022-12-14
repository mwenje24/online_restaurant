<?php

require_once "../assets/config.php";
require_once "../assets/functions.php";

require_once "../assets/productvalidation.php";

$query = $db->prepare('SELECT * FROM temp_kot');
$query->execute();
$temp_kot_products = $query->fetchAll(PDO::FETCH_ASSOC);


if($_SERVER['REQUEST_METHOD'] ==='POST') {
    $order_id = randomId(10);
    $date = $_POST['kot_date'];
    $time = $_POST['kot_time'];
    $table = $_POST['table_name'];
    $waiter = $_POST['waiter'];
    $sumtotal = $_POST['sumtotal'];
    $discount = $_POST['kot_discount'];
    $bill = $_POST['bill_amount'];

    $statement = $db->prepare("INSERT INTO kot_order(kot_order_id, kot_date,kot_time,order_table, waiter, sumtotal, discount, bill) 
            VALUES(:kotorderid, :kotdate, :kottime, :kottable, :waiter , :sumtotal, :discount, :bill)");
    $statement->bindValue(':kotorderid', $order_id);
    $statement->bindValue(':kotdate', $date);
    $statement->bindValue(':kottime', $time);
    $statement->bindValue(':kottable', $table);
    $statement->bindValue(':waiter', $waiter);
    $statement->bindValue(':sumtotal', $sumtotal);
    $statement->bindValue(':discount', $discount);
    $statement->bindValue(':bill', $bill);
    $statement->execute();

    foreach ($temp_kot_products as $data) {
        $product_id = $data['product_id'];
        $description = $data['description'];
        $price = $data['price'];
        $quantity = $data['quantity'];
        $total = $data['total'];
        $kot_order_id = $order_id;

        $statement = $db->prepare("INSERT INTO kot_order_items(kot_order_id, product_id,product_description, price, quantity, total) 
            VALUES(:kotproduct_id, :product_id, :description, :price, :quantity , :total)");
        $statement->bindValue(':kotproduct_id', $kot_order_id);
        $statement->bindValue(':product_id', $product_id);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':total', $total);
        $statement->execute();
    }

    $deletequery = $db->prepare('DELETE FROM temp_kot');
    $deletequery->execute();

    header('Location:index.php');
    exit;
}
?>