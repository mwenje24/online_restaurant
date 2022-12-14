
<?php

require_once "../assets/config.php";
session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}

    $search = isset($_POST['search']) ? $_POST['search'] :'';
    if($search){
        $statement = $db->prepare('SELECT * FROM products WHERE description LIKE :description ORDER BY description DESC');
        $statement->bindValue(':description', "%$search%");
    }
    else{
        $statement = $db->prepare('SELECT * FROM products ORDER BY description DESC');
    }
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include_once "../assets/base.php"; ?>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-2 sidebar-menu">
				<?php include_once "sidebar.php"; ?>
			</div>
			<div class="col-10 menu-preview">
            <div class="clr"></div>
            <div class="search shadow">
                <form class="d-flex" action="" method="post">
                    <input class="form-control" name="search" value="<?php echo $search ?>" type="text" placeholder="Search Product ?">
                    <button class="btn btn-outline-dark" type="submit">Search</button>
                </form>
            </div>
            <div class="container">
                <h4>Products</h4>
                <div>
                        <p>
                            <a href="newproduct.php" type="button" class="btn btn-sm btn-success">Add Product</a>
                        </p>
                        <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">image</th>
                            <th scope="col">description</th>
                            <th scope="col">category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $i=> $product): ?>
                            <tr>
                                <th scope="row"><?php echo $i + 1?></th>
                                <td>
                                    <img src="../assets/<?php echo $product['image'] ?>" class="thumb-image" alt='image <?php echo $i ?>'>
                                </td>
                                <td><?php echo $product['description'] ?></td>
                                <td><?php echo $product['category'] ?></td>
                                <td><?php echo $product['price'] ?></td>
                                <td><?php echo $product['status'] ?></td>
                                <td>
                                <a href="updateproduct.php?product_id=<?php echo $product['product_id']?>" class="btn btn-sm btn-success">edit</a>
                                <form method="post" action="deleteproduct.php" style="display: inline-block">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                                </td>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        </table>
                    </div>
                </div>
			</div>
		</div>
	</div>

	
<?php include_once "../assets/basefooter.php"; ?>

</body>
</html>