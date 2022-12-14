<?php
/**
 * Created by PhpStorm.
 * User: Miya
 * Date: 7/16/2021
 * Time: 8:24 AM
 */
require_once "../assets/config.php";
require_once "../assets/functions.php";

require_once "../assets/productvalidation.php";

//fetching kot template values
$query = $db->prepare('SELECT * FROM temp_kot');
$query->execute();
$temp_kot_products = $query->fetchAll(PDO::FETCH_ASSOC);

//fetching the sum total
$sumquery = $db->prepare('SELECT sum(total) as sum FROM temp_kot');
$sumquery->execute();
$temp_kot_sum = $sumquery->fetch(PDO::FETCH_ASSOC);
$total_sum = $temp_kot_sum['sum'];

//fetching waiters
$waiterstmt = $db->prepare('SELECT * FROM kot_waiters');
$waiterstmt->execute();
$waiters = $waiterstmt->fetchAll(PDO::FETCH_ASSOC);

//fetching the tables
$tabletmt = $db->prepare('SELECT * FROM kot_tables ORDER BY table_name ASC');
$tabletmt->execute();
$tables = $tabletmt->fetchAll(PDO::FETCH_ASSOC);

//header('Location:index.php');
?>
