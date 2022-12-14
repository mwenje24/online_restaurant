<?php

require_once "../assets/config.php";
require_once "../assets/functions.php";

session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}

$product_id = '';
$description = '';
$category = '';
$price = '';
$status = '';
$product['image']= '';

//product list
$statement = $db->prepare("SELECT * FROM product_category");
$statement->execute();
$categorys = $statement->fetchAll(PDO::FETCH_ASSOC);


if(!is_dir('../assets/images')){
    mkdir('../assets/images');
}

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    require_once "../assets/imagevalidation.php";

    $product_id =randomId(10);
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $statement = $db->prepare("INSERT INTO products(product_id,description, category, price, status, image)
     VALUES(:product_id, :description, :category, :price, :status , :image)");
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':category', $category);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':status', $status);
    $statement->bindValue(':image', $imagePath);
    $statement->execute();
    header('Location:newproduct.php');
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
                <h4>New Product <span style="color: red; font-size: 22px;"></h4><br>
                <?php include_once "productform.php" ?>
            </div>

			</div>
		</div>
	</div>

	
<?php include_once "../assets/basefooter.php"; ?>

</body>
</html>