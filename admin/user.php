
<?php

require_once "../assets/config.php";

session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}

    $search = isset($_POST['search']) ? $_POST['search'] :'';
    if($search){
        $statement = $db->prepare('SELECT * FROM user WHERE full_names LIKE :fullname ORDER BY type DESC');
        $statement->bindValue(':fullname', "%$search%");
    }
    else{
        $statement = $db->prepare('SELECT * FROM user ORDER BY type DESC');
    }
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

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
            <div class="container">
                <h4 class="mt-3">Users</h4>
                <div>
                        <p>
                            <a href="newuser.php" type="button" class="btn btn-sm btn-success">Add User</a>
                        </p>
                        <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">full names</th>
                            <th scope="col">email</th>
                            <th scope="col">username</th>
                            <th scope="col">password</th>
                            <th scope="col">type</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $i=> $user): ?>
                            <tr>
                                <th scope="row"><?php echo $i + 1?></th>
                                <td><?php echo $user['full_names'] ?></td>
                                <td><?php echo $user['email'] ?></td>
                                <td><?php echo $user['username'] ?></td>
                                <td><?php echo $user['password'] ?></td>
                                <td><?php echo $user['type'] ?></td>
                                <td>
                                <a href="updateuser.php?email=<?php echo $user['email']?>" class="btn btn-sm btn-success">edit</a>
                                <form method="post" action="deleteuser.php" style="display: inline-block">
                                    <input type="hidden" name="email" value="<?php echo $user['email']?>">
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