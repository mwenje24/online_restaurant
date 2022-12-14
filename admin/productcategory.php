<?php

require_once "../assets/config.php";
require_once "../assets/functions.php";

session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}

$categoryname = '';
$update = false;
$categoryid = '';

$statement = $db->prepare("SELECT * FROM product_category");
$statement->execute();
$category = $statement->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['save'])){

    $category_id = randomId(5);
    $categoryname = $_POST['categoryname'];

    $statement = $db->prepare("INSERT INTO product_category(category_id, category_name) VALUES(:id ,:categoryname)");
    $statement->bindValue(':id', $category_id);
    $statement->bindValue(':categoryname', $categoryname);
    $statement->execute();
    header('Location:productcategory.php');
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    if(!$id){
        header('Location:productcategory.php');
        exit;
    }

    $statement = $db->prepare('DELETE FROM product_category WHERE category_id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = 'danger';
    header('Location:productcategory.php');
}

if(isset($_GET['edit'])){
   $edit_id = $_GET['edit'];
    $update = true;

    $statement = $db->prepare("SELECT * FROM product_category WHERE category_id = :id");
    $statement->bindValue(':id', $edit_id);
    $statement->execute();

    $categoryvalues = $statement->fetch(PDO::FETCH_ASSOC);
    $categoryname = $categoryvalues['category_name'];
    $categoryid = $categoryvalues['category_id'];
    //    $_SESSION['message'] = "Record has been updated";
    //    $_SESSION['msg_type'] = 'success';
    //     header('Location:productcategory.php');

}

if(isset($_POST['update'])){
    $update_id = $_POST['categoryid'];
    $categoryname = $_POST['categoryname'];
    $update = false;

    $statement = $db->prepare("UPDATE product_category SET category_name = :categoryname WHERE category_id = :id");
    $statement->bindValue(':categoryname', $categoryname);
    $statement->bindValue(':id', $update_id);
    $statement->execute();

    //    $_SESSION['message'] = "Record has been updated";
    //    $_SESSION['msg_type'] = 'success';
    header('Location:productcategory.php');

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
            <div class="container">
                    <br>
                    <h4>Product Category</h4><br>
                    <div class="row justify-content-center">
						<form method="POST" action="">
							<div class="form-group">
                                <label>Category</label>
                                <input type="hidden" name="categoryid" class="form-control" value="<?php echo $categoryid ?>"/>
								<input type="text" name="categoryname" class="form-control" placeholder="Enter Category" value="<?php echo $categoryname ?>"/>
							</div><br>
							<div class="form-group">
                                <?php
                                    if($update==true):
                                ?>
                                <button class="btn btn-info" type="submit" name="update">Update</button>
                                <?php else: ?>
								<button class="btn btn-primary" type="submit" name="save">Save</button>
                                <?php endif; ?>
							</div>
						</form>
					</div><br>
						<div class="row justify-content-center">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Category</th>
										<th>Action</th>
									</tr>
								</thead>
								<?php foreach ($category as $i=> $category): ?>
								<tr>
                                    <th scope="row"><?php echo $i + 1?></th>
									<td><?php echo $category['category_name'] ?></td>
									<td>
										<a href="productcategory.php?edit=<?php echo $category['category_id']; ?>" class="btn btn-success btn-sm">Edit</a>
										<a href="productcategory.php?delete=<?php echo $category['category_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
									</td>
								</tr>
								<?php endforeach; ?>
							</table>
						</div>
					</div>

			</div>
		</div>
	</div>

	
<?php include_once "../assets/basefooter.php"; ?>

</body>
</html>