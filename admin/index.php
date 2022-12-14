<?php

require_once "../assets/config.php";
// require_once "adminfunctions.php";

session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}

$statement = $db->prepare("SELECT description, count(quantity) as quantity FROM cart_order_items group by description order by quantity DESC");
$statement->execute();
$onlinesales = $statement->fetchAll(PDO::FETCH_ASSOC);
// var_dump($onlinesales);
// exit();
$statement = $db->prepare("SELECT product_description, count(quantity) as quantity FROM kot_order_items group by product_description order by quantity DESC");
$statement->execute();
$kotsales = $statement->fetchAll(PDO::FETCH_ASSOC);

$today = date("Y-m-d");
// var_dump($today);
// exit();

// ......total sale orders........
$statement = $db->prepare("SELECT count(*) as quantity FROM cart_order WHERE time_date LIKE :today");
$statement->bindValue(':today', "%$today%");
$statement->execute();
$totalonlinesales = $statement->fetch(PDO::FETCH_ASSOC);

$statement = $db->prepare("SELECT count(*) as quantity FROM kot_order WHERE kot_date LIKE :today");
$statement->bindValue(':today', "%$today%");
$statement->execute();
$totalkotsales = $statement->fetch(PDO::FETCH_ASSOC);

// $statement = $db->prepare("SELECT sum(quantity) as quantity FROM cart_order_items JOIN cart_order ON cart_order_items.order_id = cart_order.order_id WHERE cart_order.time_date LIKE :today AND cart_order.status = true");
// $statement->bindValue(':today', "%$today%");
// $statement->execute();
// $totaldeliveries = $statement->fetch(PDO::FETCH_ASSOC);

//......total deliveries............
$statement = $db->prepare("SELECT count(*) as quantity FROM cart_order WHERE time_date LIKE :today AND delivery = true");
$statement->bindValue(':today', "%$today%");
$statement->execute();
$totaldeliveries = $statement->fetch(PDO::FETCH_ASSOC);

$statement = $db->prepare("SELECT count(*) as quantity FROM cart_order WHERE time_date LIKE :today AND delivery = false");
$statement->bindValue(':today', "%$today%");
$statement->execute();
$pendingdeliveries = $statement->fetch(PDO::FETCH_ASSOC);

//...........waiter performance...........
$statement = $db->prepare("SELECT waiter, count(*) as quantity FROM kot_order group by waiter");
$statement->execute();
$waitersales = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include_once "../assets/base.php"; ?>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-2 sidebar-menu">
				<?php include_once "sidebar.php"; ?>
			</div>
			<div class="col-10 menu-preview">
				<div class="container w-75">
				<header class="mt-2 mb-2 text-dark fs-3 text-center shadow-sm">Dashboard</header>
				<div class="row">
					<header class="mt-2 mb-2 text-dark fs-6">Today's Sales</header>
					<div class="col-9">
						<div class="row m-auto">
							<div class="col-4 rounded-3 mt-2 shadow mx-sm-3">
								<div class="row">
									<img class="dash-img" src="../images/logos/sale.png">									
									<span class="text-center text-secondary fs-4"><?php echo number_format($totalonlinesales['quantity'], 0); ?></span>
								</div>
								<div class="row bg-success">
									<a href="" class="text-center text-light fs-5">Total Online Sales</a>
								</div>
							</div>
							<div class="col-4 mt-2 rounded-3 shadow mx-sm-3">
								<div class="row">
									<img class="dash-img" src="../images/logos/restsale.png">									
									<span class="text-center text-secondary fs-4"><?php echo number_format($totalkotsales['quantity'], 0); ?></span>
								</div>
								<div class="row bg-secondary">
									<a href="" class="text-center text-light fs-5">Total KOT Sales</a>
								</div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-6">
								<header class="mt-3 mb-2 text-dark fs-6">Deliveries</header>
								<div class="row mt-3 w-50 m-auto">
									<div class="row">
										<img class="dash-img" src="../images/logos/delivered.png">									
										<span class="text-center text-secondary fs-4"><?php echo number_format($totaldeliveries['quantity'], 0); ?></span>
									</div>
									<div class="row bg-success">
										<a href="" class="text-center text-light fs-6">Total Delivered</a>
									</div>
								</div>
								<div class="row mt-3 w-50 m-auto">
									<div class="row">
										<img class="dash-img" src="../images/logos/pending.png">									
										<span class="text-center text-secondary fs-4"><?php echo number_format($pendingdeliveries['quantity'], 0); ?></span>
									</div>
									<div class="row bg-warning">
										<a href="" class="text-center text-dark fs-6">Pending Delivery</a>
									</div>
								</div>
							</div>
							<div class="col-4">
								<header class="mt-4 mb-2 text-secondary fs-6">Waiter Performance</header>
								<table>
								<?php foreach($waitersales as $keys => $waitersales): ?>
										<tr>
											<td><?php echo $waitersales['waiter'] ?></td>
											<td class="text-success float-end"><?php echo $waitersales['quantity'] ?></td>
										</tr>
								<?php endforeach?>
							</table>
							</div>							
						</div>
					</div>
					<div class="col-3 shadow h-100">
						<header class="mt-3 fs-5 text-secondary">Meal Performance</header>
						<header class="mt-2 text-light bg-secondary">Online</header>
						<div class="meals-rpt mt-3">							
							<table>
								<?php foreach($onlinesales as $keys => $onlinesales): ?>
										<tr>
											<td><?php echo $keys + 1?>. </td>
											<td class="mx-sm-2"><?php echo $onlinesales['description'] ?></td>
											<td class="text-success float-end"><?php echo $onlinesales['quantity'] ?></td>
										</tr>
								<?php endforeach?>
							</table>
								
						</div>
						<header class="mt-2 text-light bg-secondary">KOT Restaurant</header>
						<div class="meals-rpt mt-3">							
							<table>
								<?php foreach($kotsales as $keys => $kotsales): ?>
										<tr>
											<td><?php echo $keys + 1?>. </td>
											<td><?php echo $kotsales['product_description'] ?></td>
											<td class="text-success float-end"><?php echo $kotsales['quantity'] ?></td>
										</tr>
								<?php endforeach?>
							</table>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>

	
<?php include_once "../assets/basefooter.php"; ?>

</body>
</html>