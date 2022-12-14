<?php

require_once "../assets/config.php";
session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}

    $search = isset($_POST['search']) ? $_POST['search'] :'';
    if($search){
        $statement = $db->prepare('SELECT * FROM customer WHERE lastnames LIKE :lastname ORDER BY town DESC');
        $statement->bindValue(':lastname', "%$search%");
    }
    else{
        $statement = $db->prepare('SELECT * FROM customer ORDER BY town DESC');
    }
    $statement->execute();
    $customers = $statement->fetchAll(PDO::FETCH_ASSOC);

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
                    <input class="form-control" name="search" value="<?php echo $search ?>" type="text" placeholder="Search Customer ?">
                    <button class="btn btn-outline-dark" type="submit">Search</button>
                </form>
            </div>
            <div class="container">
                <h4>Customer</h4>
                <div>
                        <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">lastname</th>
                            <th scope="col">email</th>
                            <th scope="col">phone</th>
                            <th scope="col">town</th>
                            <th scope="col">street</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($customers as $i=> $customer): ?>
                            <tr>
                                <th scope="row"><?php echo $i + 1?></th>
                                <td><?php echo $customer['lastname'] ?></td>
                                <td><?php echo $customer['email'] ?></td>
                                <td><?php echo $customer['phone'] ?></td>
                                <td><?php echo $customer['town'] ?></td>
                                <td><?php echo $customer['street'] ?></td>
                                <td>
                                <form method="post" action="deletecustomer.php" style="display: inline-block">
                                    <input type="hidden" name="id" value="<?php echo $customer['id']?>">
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