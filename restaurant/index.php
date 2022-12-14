<?php


require_once "../assets/config.php";
require_once "../assets/functions.php";

require_once "../assets/productvalidation.php";

session_start();
if(!isset($_SESSION['user'])){
	header("location:login.php");
}

$total_items = 0;
$total_amount = 0;
$count = 0;
if(!isset($_SESSION['shopping_cart'])){
	$_SESSION['shopping_cart'] = array();
}

if(isset($_POST['add_cart'])){ 
	if(isset($_SESSION['shopping_cart'])){
		$items_id=array_column($_SESSION['shopping_cart'], 'cart_item_id');
		if(!in_array($_GET['item_id'], $items_id)){
			$count = 0;
			$count =$count + (count($_SESSION['shopping_cart']));
			$items_array = array(
				'cart_item_id' => $_GET['item_id'],
				'item_image' => $_POST['hidden_image'],
				'item_name' => $_POST['hidden_name'],
				'item_price' => $_POST['hidden_price'],
				'item_quantity' => 1
			);
			$_SESSION['shopping_cart'][$count] = $items_array;
			// var_dump($_SESSION['shopping_cart']);
			// exit();
		}
		else{
			foreach($_SESSION['shopping_cart'] as $keys => $values){
			if($values['cart_item_id']== $_GET['item_id']){
			 	$newquantity = $values['item_quantity'] + 1;
			 	$_SESSION['item_quantity'] = $newquantity;

			 	$_SESSION['shopping_cart'][$keys]['item_quantity'] = $_SESSION['item_quantity'];
				echo '<script> window.location="index.php"</script>';
				}
			}
		}
	}
	else{
	$items_array = array(
			'cart_item_id' => $_GET['item_id'],
			'item_image' => $_POST['hidden_image'],
			'item_name' => $_POST['hidden_name'],
			'item_price' => $_POST['hidden_price'],
			'item_quantity' => 1
		);
	$_SESSION['shopping_cart'][$count] = $items_array;
	// var_dump($_SESSION['shopping_cart']);
	// 		exit();
	}
}

if(isset($_GET['action'])){
	if($_GET['action']=='addnew_item'){
		foreach($_SESSION['shopping_cart'] as $keys => $values){
			if($values['cart_item_id']== $_GET['item_id']){
			 	$newquantity = $values['item_quantity'] + 1;
			 	$_SESSION['item_quantity'] = $newquantity;

			 	$_SESSION['shopping_cart'][$keys]['item_quantity'] = $_SESSION['item_quantity'];
			}
		echo '<script> window.location="index.php"</script>';
		}
	}
}

if(isset($_GET['action'])){
	if($_GET['action']=='reduce_item'){
		foreach($_SESSION['shopping_cart'] as $keys => $values){
			if($values['cart_item_id']== $_GET['item_id']){
			 	$newquantity = $values['item_quantity'] - 1;
			 	$_SESSION['item_quantity'] = $newquantity;

			 	$_SESSION['shopping_cart'][$keys]['item_quantity'] = $_SESSION['item_quantity'];
			 	if($_SESSION['item_quantity'] == 0){
			 		unset($_SESSION['shopping_cart'][$keys]);
			 	}
			}
			echo '<script> window.location="index.php"</script>';
		}
	}
}

if(isset($_GET['action'])){
	if($_GET['action']=='delete_item'){
		foreach($_SESSION['shopping_cart'] as $keys => $values){
			if($values['cart_item_id']== $_GET['item_id']){
				unset($_SESSION['shopping_cart'][$keys]);
			}
		}
		echo '<script> window.location="index.php"</script>';
	}
}

if(isset($_POST['submit_cart'])){
	if($_SERVER['REQUEST_METHOD'] ==='POST') {
		// echo '<script> alert("success")</script>';
		// exit();

        $order_id = randomId(10);
        $date = $_POST['kot_date'];
        $table = $_POST['table_name'];
        $waiter = $_POST['waiter'];
        $sumtotal = $_POST['sumtotal'];
        $discount = $_POST['kot_discount'];
        $bill = $_POST['bill_amount'];
        $type = $_POST['type'];

        // var_dump($bill);//
        // echo '<script> alert("success");</script>';
        // exit();

        $statement = $db->prepare("INSERT INTO kot_order(kot_order_id, kot_date,order_table, waiter, sumtotal, discount, bill, type, status) VALUES(:kotorderid, :kotdate, :kottable, :waiter , :sumtotal, :discount, :bill,:type, false)");
        $statement->bindValue(':kotorderid', $order_id);
        $statement->bindValue(':kotdate', $date);
        $statement->bindValue(':kottable', $table);
        $statement->bindValue(':waiter', $waiter);
        $statement->bindValue(':sumtotal', $sumtotal);
        $statement->bindValue(':discount', $discount);
        $statement->bindValue(':bill', $bill);
        $statement->bindValue(':type', $type);
        $statement->execute();

        $kot_order_id = $order_id;

		foreach($_SESSION['shopping_cart'] as $keys => $values){
			$orderid = $kot_order_id;
            $product_id = $values['cart_item_id'];
            $description = $values['item_name'];
            $price = $values['item_price'];
            $quantity = $values['item_quantity'];
            $total = ($price * $quantity);
            

            $statement = $db->prepare("INSERT INTO kot_order_items(kot_order_id, product_id,product_description, price, quantity, total) 
                VALUES(:orderid, :product_id, :description, :price, :quantity , :total)");
            $statement->bindValue(':orderid', $orderid);
            $statement->bindValue(':product_id', $product_id);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':quantity', $quantity);
            $statement->bindValue(':total', $total);
            $statement->execute();
		}
	}
	unset($_SESSION['shopping_cart']);
	echo '<script> window.location="index.php"</script>';
}

if(isset($_POST['served'])){
    $k_order_id  =  $_GET['k_order_id'];
    $stt = $db->prepare('SELECT * FROM kot_order_items WHERE kot_order_id= :kotordeid');
    $stt->bindValue(':kotordeid', $k_order_id);
    $stt->execute();
    $kotorderitems = $stt->fetchAll(PDO::FETCH_ASSOC);

    echo '<script> window.onload =function openKotItems(){ document.getElementById("kot_Items").style.display="block";}</script>';
}
if(isset($_GET['action'])){
    if($_GET['action']=='status_update'){
        $orderid = $_GET['order_id'];

        $statement = $db->prepare("UPDATE kot_order SET status= true WHERE kot_order_id =:id");
        $statement->bindValue(':id', $orderid);
        $statement->execute();

        header('Location:index.php');
    }
}

require_once "kotrequest.php";

?>


<?php include_once "../assets/base.php"; ?>
<body>
	<div class="header container-fluid">
		<div class="row w-75 m-auto">
			<div class="col-4">
				<img class="fd-logo  center" src="../images/logos/fast-food.png">
			</div>
			<div class="col-2">
				<button class="btn"><img class="menu-logo" src="../images/logos/user.png"><br><?php echo $_SESSION['user']?></button>
			</div>
			<div class="col-2"><button class="btn">
				<button class="btn" onclick="openDineinn()"><img class="menu-logo" src="../images/logos/table.png"><br>Dine Inn</button>
			</div>
			<div class="col-2">
				<button class="btn" onclick="openDelivery()"><img class="menu-logo" src="../images/logos/take-away.png"><br>Take_Away</button>
			</div>
			<!-- <div class="col-2">
				<button class="btn" onclick="openSalesReturn()"><img class="menu-logo" src="../images/logos/return.png"><br>Returns</button>
			</div>
			<div class="col-2">
				<button class="btn"><img class="menu-logo" src="../images/logos/new.png"><br>New</button>
			</div> -->
			<div class="col-2">
				<button class="btn text-dark"><a class="text-dark" href="logout.php"><img class="menu-logo" src="../images/logos/logout.png"><br>Logout</a></button>
			</div>
		</div>
	</div>
	<div class="clr"></div>
	<div class="container-fluid main-body">
		<div class="row">
			<!-- category list -->
			<div class="col-2 body-part" style="border-right: 1px solid #ffb74d">
				<div class="clr"></div>
				<div class="title-head">
					<h4>Categories</h4>
				</div>
				<div class="category">
					<ul class="" style="padding-top: 5px;">
			            <li class="search-result"><a href="">All Products</a></li>
						<?php foreach ($categorys as $category): ?>
			            	<li class="search-result"><a href=""><?php echo $category['category_name'] ?></a></li>
						<?php endforeach; ?>
			        </ul>
		        </div>
			</div>

			<!-- product list -->
			<div class="col-6 body-part" style="border-right: 1px solid #ffb74d">
				<div class="clr"></div>
				<div class="row  scrollspy" style="padding-top: 5px;">
				<?php foreach ($products as $i=> $product): ?>
					<div class="col-2 product-card">
						<div class="card">
							<img src="../assets/<?php echo $product['image'] ?>">
							<div class="card-body">
								<h6 class="card-title mt-2"><?php echo $product['description'] ?></h6>
								<!-- <h6>@ Ksh. <?php echo $product['price'] ?></h6> -->
							</div>
						</div>
						<form method="POST" action="index.php?action=add&item_id=<?php echo $product['product_id'] ?>" class="btn btn-secondary btn-sm text-light">
							<input type="hidden" name="hidden_image" value="<?php echo $product['image'] ?>">
							<input type="hidden" name="hidden_name" value="<?php echo $product['description'] ?>">
							<input type="hidden" name="hidden_price" value="<?php echo $product['price'] ?>">
							<input style="font-size:9px;" class="btn btn-secondary btn-sm" type="submit" name="add_cart" value="@ Ksh. <?php echo $product['price'] ?>">
						</form>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="col-4 body-part">
				<div class="table-preview">
					<table class="table">
			            <thead>
			                <tr style="font-size: 12px;">
			                    <th>Product Name</th>
			                    <th>Price</th>
			                    <th colspan="2">Qty</th>
			                    <th>Total</th>
			                	<th>Delete</th>
			                </tr>
			            </thead>
						<?php 
							$total = 0;
							foreach($_SESSION['shopping_cart'] as $keys => $values): ?>
							<tr style="font-size: 14px;">
								<td><?php echo $values['item_name']; ?></td>
								<td><?php echo $values['item_price']; ?></td>
								<td colspan="2">
									<!-- <div class="quantity" style="padding-top:-15px;"><p><?php //echo $temp_kot_product['quantity'] ?></p></div>
									<div class="quantity">
										<img class="image-quantity" src="../images/logos/up-arrow.png">
										<img class="image-quantity" src="../images/logos/down-arrow.png">
									</div> -->
									<div class="row">
									<div class="col-6">
									<?php echo $values['item_quantity']; ?></div>
									<div style="margin-top:-8px;" class="col-6 trans">
			                        		<a href="index.php?action=addnew_item&item_id=<?php echo $values['cart_item_id'] ?>" class=" trans_action"><img class="cart-arrow" src="../images/logos/up-arrow.png"></a>
			                        		<a href="index.php?action=reduce_item&item_id=<?php echo $values['cart_item_id'] ?>" class=" trans_action"><img class="cart-arrow" src="../images/logos/down-arrow.png"></a>
			                        	</div>
		                        	</div>
								</td>
								<td><?php echo number_format($values['item_price'] * $values['item_quantity'], 2) ?></td>
								<td>
									<a href="index.php?action=delete_item&item_id=<?php echo $values['cart_item_id'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
								</td>
							</tr>
						<?php $total_amount += $values['item_price'] * $values['item_quantity'];
						endforeach; ?>
			        </table>
		        </div>
		        <div class="row">
		        	<div class="col-12 total">
		        		<label>Total :<span class="text-danger"> Ksh.  
		        			<?php
			        			echo number_format($total_amount, 2); ?></span></label>
		        	</div>
		        	<div class="col-6 payment"><!-- <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-warning">Flash Cash<img class="pyt-logo" src="../images/logos/flash.png"></a> --></div>
		        	<div class="col-6 payment"><a onclick="openKotSubmission()" class="btn btn-secondary"><img class="pyt-logo" src="../images/logos/checkout.png">Check Out</a></div>
		        </div>
			</div>
		</div>
	</div>

	<!--form kot-->
	<div class="form-display" id="dineinn">
	 	<?php 
	 		$statement = $db->prepare('SELECT * FROM kot_order WHERE type= "DineInn" ORDER BY kot_date DESC');
			$statement->execute();
			$kotorders = $statement->fetchAll(PDO::FETCH_ASSOC);
	 	 ?>
		<div class="container form-content">
			<button onclick="closeDineinn()" type="button" class="btn-close" aria-label="Close"></button>
            <h4 style="color: #607D8B;" class="text-center mt-3">KOT Orders</h4>
            <div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">kot order id</th>
                        <th scope="col">kot date</th>
                        <th scope="col">order table</th>
                        <th scope="col">waiter</th>
                        <th scope="col">type</th>
                        <th scope="col">bill</th>
                        <!-- <th scope="col">status</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($kotorders as $i=> $kotorder): ?>
                        <tr>
                            <th scope="row"><?php echo $i + 1?></th>
                            <td><?php echo $kotorder['kot_order_id'] ?></td>
                            <td><?php echo $kotorder['kot_date'] ?></td>
                            <td><?php echo $kotorder['order_table'] ?></td>
                            <td><?php echo $kotorder['waiter'] ?></td>
                            <td><?php echo $kotorder['type'] ?></td>
                            <td><?php echo $kotorder['bill'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>



	 <div class="form-display" id="delivery">
	 	<?php 
	 		$statement = $db->prepare('SELECT * FROM kot_order WHERE type= "Take Away" ORDER BY kot_date DESC');
			$statement->execute();
			$kotorders = $statement->fetchAll(PDO::FETCH_ASSOC);
	 	 ?>
		<div class="container form-content">
			<button onclick="closeDelivery()" type="button" class="btn-close" aria-label="Close"></button>
            <h4 style="color: #607D8B;" class="text-center mt-3">KOT Orders</h4>
            <div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">kot order id</th>
                        <th scope="col">kot date</th>
                        <th scope="col">order table</th>
                        <th scope="col">waiter</th>
                        <th scope="col">type</th>
                        <th scope="col">bill</th>
                        <!-- <th scope="col">status</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($kotorders as $i=> $kotorder): ?>
                        <tr>
                            <th scope="row"><?php echo $i + 1?></th>
                            <td><?php echo $kotorder['kot_order_id'] ?></td>
                            <td><?php echo $kotorder['kot_date'] ?></td>
                            <td><?php echo $kotorder['order_table'] ?></td>
                            <td><?php echo $kotorder['waiter'] ?></td>
                            <td><?php echo $kotorder['type'] ?></td>
                            <td><?php echo $kotorder['bill'] ?></td>
                            <!-- <?php
                                if($kotorder['status'] == false):
                            ?>
                                <td>
                                    <form method="POST" action="kotmeal_orders.php?k_order_id=<?php echo $kotorder['kot_order_id']; ?>">
                                        <input type="hidden" name="k_order_id" value="<?php echo $kotorder['kot_order_id']; ?>">
                                        <input class="btn btn-danger btn-sm" type="submit" name="served" value="Pending">
                                    </form>
                                </td>
                            <?php else: ?>
                                <td>
                                    <button class="btn btn-sm btn-success">Served</button>
                                    <form method="POST" action="kotmeal_orders.php?k_order_id=<?php //echo $kotorder['kot_order_id']; ?>">
                                        <input type="hidden" name="k_order_id" value="<?php// echo $kotorder['kot_order_id']; ?>">
                                        <input class="btn btn-success btn-sm" type="submit" name="served" value="Served">
                                    </form>-->
                                </td>
                            <?php endif; ?> -->
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>

	<!--Sales Return and Reprint-->

	<div class="form-display" id="salesreturn">
		<div class="form-content">
			<form class="form" method="post">
					<div class="row">
						<div class="col-12">
							<button onclick="closeSalesReturn()" type="button" class="btn-close" aria-label="Close"></button>
						</div>
						<div class="col-5">
							<input type="text" name="invoiceno" placeholder="Invoice Number" class="form-control">
						</div>
					</div>
					<div class="clr"></div><br>
					<div class="row delivery-preview">
						<div class="col-12">
							<table class="table">
					            <thead>
					                <tr>
					                    <th>Inoice No</th>
					                    <th>Date</th>
					                    <th>Time</th>
					                    <th>Total</th>
					                	<th>Customer</th>
					                	<th colspan="2">Action</th>
					                </tr>
					            </thead>
					            <tr>
					                <td>1001</td>
					                <td>2021-04-02</td>
					                <td>12:10:08</td>
					                <td>620</td>
					                <td>Dine Inn</td>
					                <td colspan="2">
					                	<a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Return</a>
					                	<a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">RePrint</a></td>
					            </tr>
					            <tr>
					                <td>1001</td>
					                <td>2021-04-02</td>
					                <td>12:10:08</td>
					                <td>620</td>
					                <td>Dine Inn</td>
					                <td colspan="2">
					                	<a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Return</a>
					                	<a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">RePrint</a></td>
					            </tr>
					        </table>
						</div>
					</div>
			</form>
		</div>
	</div>

    <!--kot dine-inn product checkout-->

    <div class="form-display" id="kotsubmission">

        <div class="container delivery-preview w-50 form-content">
            <form class="form" method="POST" action="">
                <div class="row">
                    <div class="col-12">
                        <button onclick="closeKotSubmission()" type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="col-5">
                        <label class="col-6 fw-bold">Generate KOT</label>
                    </div>
                </div>
                <div class="clr"></div><br>
                <div class="row mb-4">
                    <label class="col-3">Date_Time</label>
                    <div class="col-9">
                        <input type="text" name="kot_date" value="<?php echo date("Y-m-d h:i:sa"); ?>" class="form-control text-center">
                    </div>            
                </div>
                <div class="row mb-4">
                    <label class="col-1">Table</label>
                    <div class="col-5">
                        <select class="form-select form-control sm" name="table_name">
                        <option selected>Table 0</option>
                        <?php foreach ($tables as $table): ?>
                            <option><?php echo $table['table_name'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <label class="col-1">Waiter</label>
                    <div class="col-5">
                        <select class="form-select form-control sm" name="waiter">
                            <option selected>Cashier</option>
                            <?php foreach ($waiters as $waiter): ?>
                                <option><?php echo $waiter['waitername'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-2">Sum Total ($)</label>
                    <div class="col-4">
                        <input type="text" id="sumtotal" name="sumtotal" class="form-control fw-bold text-center" value="<?php echo $total_amount; ?>">
                    </div>
                    <label class="col-2">Discount</label>
                    <div class="col-4">
                        <input type="text" id="dine_Discount" oninput="dineDiscount()" name="kot_discount" class="form-control" value="0.00">
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-2">Bill</label>
                    <div class="col-4">
                        <input type="text" id="calBill" name="bill_amount" class="form-control">
                    </div>
                    <label class="col-2">Type</label>
                    <div class="col-4">
                    <select class="form-select form-control sm" name="type">
                        <option selected>DienInn</option>
                        <option>Take Away</option>
                    </select>
                	</div>
                </div>
                <div class="row mb-4 float-end">
                    <div style="margin-right: 20px;">
                        <input class="btn btn-outline-success btn-sm mt-3 mb-3" type="submit" name="submit_cart" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

	<!--javascript-->

<?php include_once "../assets/basefooter.php"; ?>

</body>
</html>