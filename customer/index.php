<?php
require_once "../assets/config.php";

session_start();
if(!isset($_SESSION['user'])){
	header("location:customer_sign.php");
}
require_once "../assets/functions.php";

require_once "../assets/productvalidation.php";

$total_items = 0;
$total_amount = 0;
$count = 0;
if(!isset($_SESSION['shopping_cart'])){
	$_SESSION['shopping_cart'] = array();
}

if(isset($_POST['add_cart'])){
	$total_items = 0;
    $total_amount = 0;
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
			 	$count =$count + (count($_SESSION['shopping_cart']));
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
	$count =$count + (count($_SESSION['shopping_cart']));
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
				echo '<script> window.onload =function openCustomerCart(){ document.getElementById("cartList").style.display="block";}</script>';
			}
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
				echo '<script> window.onload =function openCustomerCart(){ document.getElementById("cartList").style.display="block";}</script>';
			}
		}
	}
}

if(isset($_GET['action'])){
	if($_GET['action']=='delete_item'){
		foreach($_SESSION['shopping_cart'] as $keys => $values){
			if($values['cart_item_id']== $_GET['item_id']){
				unset($_SESSION['shopping_cart'][$keys]);
				echo '<script> window.onload =function openCustomerCart(){ document.getElementById("cartList").style.display="block";}</script>';
			}
		}
	}
}

if(isset($_POST['clear_cart'])){
	if($_SERVER['REQUEST_METHOD'] ==='POST') {
		// echo '<script> alert("success")</script>';
		// exit();
		foreach($_SESSION['shopping_cart'] as $keys => $values){
			$total_items += $values['item_quantity'];
			$total_amount += $values['item_price'] * $values['item_quantity'];
		}
		
	    $order_id = randomId(10);
	    $customer_id = $_POST['user_id'];
	    $total_bill = $total_amount;
	    $date = date("Y-m-d h:i:sa");

	    // var_dump($total_bill);
	    // exit();

	    $stmt = $db->prepare("INSERT INTO cart_order(order_id, customer_id, total_amount, time_date, status) VALUES(:orderid, :customerid, :totalbill, :time_date, false)");
	    $stmt->bindValue(':orderid', $order_id);
	    $stmt->bindValue(':customerid', $customer_id);
	    $stmt->bindValue(':totalbill', $total_bill);
	    $stmt->bindValue(':time_date', $date);
	    $stmt->execute();

	    $cart_orderid = $order_id;

		foreach($_SESSION['shopping_cart'] as $keys => $values){
			$orderid = $cart_orderid;
	        $product_id = $values['cart_item_id'];
	        $description = $values['item_name'];
	        $price = $values['item_price'];
	        $quantity = $values['item_quantity'];
	        $total = ($price * $quantity);
	        

	        $statement = $db->prepare("INSERT INTO cart_order_items(order_id, product_id,description, price, quantity, total) 
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



?>

<?php include_once "../assets/base.php"; ?>
<html>
<style type="text/css">
	.trans_action{
		display: block;
		margin: 0px;
	}
	.trans_action .cart-arrow{
		width: 10px;
		height: 15px;
		padding: 0px;
	}
	.food-list{
		margin: auto;
	}
</style>
<body>
<?php include_once "header.php"; ?>
	<div class="container">
		<div class="row">
			<!-- <div class="col-2 side-menu shadow-sm">
				<div class="clr"></div><br>
				<label class="title-bar row"><h5 style="text-align: center;">Categories<span class="opennav" onclick="openSidebar()">☰</span></h5></label>
				<div class="sidebar-home" id="side-menu">
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><a href="index.php">All Products</a></li>
						<?php foreach ($categorys as $category): ?>
							<li class="list-group-item"><a href="index.php?action=search&categoryname=<?php echo $category['category_name'] ?>"><?php echo $category['category_name'] ?></a></li>
						<?php endforeach; ?>
					</ul>
					<div class="col-12">
						<button onclick="closeSidebar()" type="button" class="btn-close" id="close-button" aria-label="Close"></button>
					</div>
				</div>
			</div> -->
			<div class="col-10 food-list body-part" style="border-left: 1px solid #000">
				<div class="clr"></div>
				<!-- <div class="search shadow">
					<form class="d-flex" action="" method="post">
						<input class="form-control" type="text" placeholder="Search Product ?">
					</form>
				</div> -->
				<div class="clr"></div>
				<div class="row  scrollspy" style="padding-top: 5px;">
				<?php foreach ($products as $i=> $product): ?>
					<div class="col-2 product-card">
						<div class="card-box">
							<img src="../assets/<?php echo $product['image'] ?>">
							<div class="card-box-body">
								<h6 class="card-box-title"><?php echo $product['description'] ?></h6>
								<h6>@ Ksh. <?php echo $product['price'] ?></h6>
							</div>
							<form method="POST" action="index.php?action=add&item_id=<?php echo $product['product_id'] ?>" class="text-center">
								<input type="hidden" name="hidden_image" value="<?php echo $product['image'] ?>">
								<input type="hidden" name="hidden_name" value="<?php echo $product['description'] ?>">
								<input type="hidden" name="hidden_price" value="<?php echo $product['price'] ?>">
								<input class="btn btn-secondary btn-sm" type="submit" name="add_cart" value="Add to Cart">
							</form>
						</div>
					</div>
				<?php endforeach; ?>
				</div>
		</div>
	</div>

	<!-- cart display -->
	<div class="form-display" id="cartList">

        <div class="container delivery-preview">
            <form class="form" method="post" action="">
                <div class="row">
                    <div class="col-12">
                        <button onclick="closeCustomerCart()" type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="col-12">
                        <label class="fw-bold">Cart Summary</label>
                    </div>
                </div>
                <div class="row pb-3 mt-1">
                        <div class="col-4"><h6>Items: <span class="fw-bold">
                        	<?php
                        		foreach($_SESSION['shopping_cart'] as $keys => $values){

                        			$total_items += $values['item_quantity'];
                        			$total_amount += $values['item_price'] * $values['item_quantity'];
                        		}
                        		echo $total_items;
                        	?></span></h6></div>
                        <div class="col-4"><h6>Total: <span class="fw-bold">Ksh. <?php echo number_format($total_amount, 2); ?></span></h6>

                        	<!-- trouble zone -->

                        	<input type="hidden" name="sum_amount" value="<?php echo number_format($total_amount, 2); ?>">
                        </div>
                        <div class="col-4"><a onclick="opencartCheckOut()" class="btn btn-outline-secondary btn-sm">Checkout</a></div>
                </div>
	            <div class="box-element shadow-sm mt-1">
	                <div class="table cart-table">
	                    <div class="row" style="font-size:14px;">
                            <div class="col fw-bold">image</div>
                            <div class="col-2 fw-bold">Product Name</div>
                            <div class="col fw-bold">Price</div>
                            <div class="col-2 fw-bold">Qty</div>
                            <div class="col fw-bold">Total</div>
                            <div class="col fw-bold del-item">activity</div>
	                    </div>
	                    <?php
	                     if(!empty($_SESSION['shopping_cart'])){
	                     	$total = 0;
	                     	foreach($_SESSION['shopping_cart'] as $keys => $values){
	                    ?>
	                    <div class="row">
	                        <div class="col"><img style="height:40px;" class="cart-logo rounded" src="../assets/<?php echo $values["item_image"]; ?>"></div>
	                        <div class="col-2" style="font-size:14px;"><?php echo $values['item_name']; ?></div>
	                        <div class="col" style="font-size:14px;"><?php echo $values['item_price']; ?></div>
	                        <div class="col-2">
		                        <div class="row">
		                        	<div class="col-6 qnty"><?php echo $values['item_quantity']; ?></div>
		                        	<div class="col-6 qnty">
			                        	<div class="trans">
			                        		<a href="index.php?action=addnew_item&item_id=<?php echo $values['cart_item_id'] ?>" class=" trans_action"><img class="cart-arrow" src="../images/logos/up-arrow.png"></a>
			                        		<a href="index.php?action=reduce_item&item_id=<?php echo $values['cart_item_id'] ?>" class=" trans_action"><img class="cart-arrow" src="../images/logos/down-arrow.png"></a>
			                        	</div>
			                        </div>
		                        </div>
	                        </div>
	                        <div class="col"><?php echo number_format($values['item_price'] * $values['item_quantity'], 2) ?></div>
	                        <div class="col del-item"><a href="index.php?action=delete_item&item_id=<?php echo $values['cart_item_id'] ?>" class="btn btn-sm btn-outline-danger">Delete</a></div>
	                    </div>
	                <?php 
	                	}
	                }
	                ?>

	                </div>
	            </div>
            </form>
        </div>
    </div>


<!-- checkout form -->
    <div class="form-display" id="cartCheckOut">
        <div class="container delivery-preview">
            <form class="form" method="POST" action="">
                <div class="row">
                    <div class="col-12">
                        <a onclick="closecartCheckOut()" type="button" class="btn-close" aria-label="Close"></a>
                    </div>
                    <div class="col-12">
                    	<label class="fw-bold">Check out Details</label><br><br>
                    	<a onclick="closecartCheckOut()" class="btn btn-sm btn-secondary">Back to Cart</a>
                    </div>
                    <div id="user-info" class="container">
                         <div class="row">
                            <div class="col-md-6">
                            	<input type="hidden" value="<?php echo $_SESSION['id']?>" name="user_id" class="form-control" required/>
                                <label class="form-label">Name</label>
                                <input type="text" value="<?php echo $_SESSION['usernames']?>" name="name" class="form-control" required/>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">email</label>
                                <input type="text" value="<?php echo $_SESSION['useremail']?>" name="email" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" value="<?php echo $_SESSION['userphone']?>" name="phone" class="form-control" required/>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">city</label>
                                <input type="text" value="<?php echo $_SESSION['usercity']?>" name="City" class="form-control" required/>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" value="<?php echo $_SESSION['useraddress']?>" name="address" class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                    	<input style="float:right;" class="btn btn-outline-success btn-sm mt-3 mb-3" type="submit" name="clear_cart" value="continue">
                    </div>
                </div>
            </form>
        </div>
    </div>

	<!--java script-->

	
<?php include_once "../assets/basefooter.php"; ?>
</body>
</html>