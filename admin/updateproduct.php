<?php

require_once "../assets/config.php";
require_once "../assets/functions.php";
session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}

$statement = $db->prepare("SELECT * FROM product_category");
$statement->execute();
$categorys = $statement->fetchAll(PDO::FETCH_ASSOC);

$product_id = $_GET['product_id'];
if(!$product_id){
    header('Location:product.php');
    exit;
}

$statement = $db->prepare('SELECT * FROM products WHERE product_id = :id');
$statement->bindValue(':id', $product_id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

$product_id = $product['product_id'];
$description = $product['description'];
$category = $product['category'];
$price = $product['price'];
$status = $product['status'];
$image = $product['image'];

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    require_once "../assets/imagevalidation.php";

    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $statement = $db->prepare("UPDATE products SET description= :description, category= :category, price= :price,
	 status= :status, image= :image WHERE product_id = :product_id");
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':category', $category);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':status', $status);
    $statement->bindValue(':image', $imagePath);
    $statement->execute();
    header('Location:products.php');
}

?>

<?php include_once "../assets/base.php"; ?>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-2 sidebar-menu">
				<?php include_once "sidebar.php"; ?>
			</div>
			<div class="col-10 menu-preview">
                <br>
            <p>
                <a href="products.php" type="button" class="btn btn-sm btn-success">view Products</a>
            </p>
            <div class="container">
                <h4>Update '<?php echo $product['description']?>'</h4><br>
                <?php include_once "productform.php" ?>
            </div>

			</div>
		</div>
	</div>

	
<?php include_once "../assets/basefooter.php"; ?>

</body>
</html>