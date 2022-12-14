<?php
require_once "../assets/config.php";
// session_start();
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
// 	header("location:customer_sign.php");
//     exit;
// }
session_start();
if(!isset($_SESSION['user'])){
	header("location:customer_sign.php");
}
require_once "../assets/functions.php";
require_once "../assets/functions.php";

require_once "../assets/productvalidation.php";

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
				// 'item_quantity' => 1
			);
			$_SESSION['shopping_cart'][$count] = $items_array;
			// var_dump($_SESSION['shopping_cart']);
			// exit();
		}
		else{
			echo '<script> alert("Item already added")</script>';
			// echo '<script> window.location="index.php"</script>';
		}
	}
	else{
	$items_array = array(
			'cart_item_id' => $_GET['item_id'],
			'item_image' => $_POST['hidden_image'],
			'item_name' => $_POST['hidden_name'],
			'item_price' => $_POST['hidden_price']
		);
	$_SESSION['shopping_cart'][$count] = $items_array;
	// var_dump($_SESSION['shopping_cart']);
	// 		exit();
	}
}

if(isset($_GET['action'])){
	if($_GET['action']=='delete_item'){
		foreach($_SESSION['shopping_cart'] as $keys => $values){
			if($values['cart_item_id']== $_GET['item_id']){
				unset($_SESSION['shopping_cart'][$keys]);
				// echo '<script> function openCustomerCart(){ document.getElementById("cartList").style.display="block";}</script>';
			}
		}
	}
}



?>

<?php include_once "../assets/base.php"; ?>
<html>
<body>
<?php include_once "header.php"; ?>
	<div class="container">
		<div class="row">
			<div class="form-display" id="cartList">

		        <div class="container delivery-preview w-50 form-content mt-5">
		            <form class="form" method="post" action="">
		                <div class="row">
		                    <!-- <div class="col-12">
		                        <button onclick="closeCustomerCart()" type="button" class="btn-close" aria-label="Close"></button>
		                    </div> -->
		                    <div class="col-12">
		                        <label class="fw-bold">Cart Summary</label>
		                    </div>
		                </div>
		                <div class="row pb-3 mt-1">
		                        <div class="col-4"><h6>Items: <span class="fw-bold">3</span></h6></div>
		                        <div class="col-4"><h6>Total: <span class="fw-bold">Ksh. 50000</span></h6></div>
		                        <div class="col-4"><a href="" class="btn btn-outline-secondary btn-sm">Checkout</a></div>
		                </div>
			            <div class="box-element shadow-sm mt-1">
			                <table class="table">
			                    <thead>
			                        <tr>
			                            <th>image</th>
			                            <th>Product Name</th>
			                            <th>Price</th>
			                            <th colspan="2">Qty</th>
			                            <th>Total</th>
			                            <th>activity</th>
			                        </tr>
			                    </thead>
			                    <?php
			                     if(!empty($_SESSION['shopping_cart'])){
			                     	$total = 0;
			                     	foreach($_SESSION['shopping_cart'] as $keys => $values){
			                    ?>
			                    <tr>
			                        <td><img style="height:40px;" class="cart-logo" src="../assets/<?php echo $values["item_image"]; ?>"></td>
			                        <td><?php echo $values['item_name']; ?></td>
			                        <td><?php echo $values['item_price']; ?></td>
			                        <td colspan="2">1</td>
			                        <td>450000</td>
			                        <td><a href="index.php?action=delete_item&item_id=<?php echo $values['cart_item_id'] ?>" class="btn btn-sm btn-outline-danger">Delete</a></td>
			                    </tr>
			                <?php 
			                	}
			                }
			                ?>

			                </table>
			            </div>
		            </form>
		        </div>
		    </div>
		</div>
	</div>


	<!--java script-->

	
<?php include_once "../assets/basefooter.php"; ?>
</body>
</html>