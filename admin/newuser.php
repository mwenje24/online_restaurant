<?php

require_once "../assets/config.php";
require_once "../assets/functions.php";

session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}

$fullnames = '';
$email = '';
$username = '';
$password = '';
$type = '';


if($_SERVER['REQUEST_METHOD'] ==='POST'){

    $fullnames = $_POST['fullnames'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    $statement = $db->prepare("INSERT INTO user(full_names,email, username, password, type)
     VALUES(:fullnames, :email, :username, :password, :type)");
    $statement->bindValue(':fullnames', $fullnames);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':type', $type);
    $statement->execute();
    header('Location:newuser.php');
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
                <a href="user.php" type="button" class="btn btn-sm btn-success">view users</a>
            </p>
            <div class="container">
                <h4>New User</h4><br>
                <?php include_once "userform.php" ?>
            </div>

			</div>
		</div>
	</div>

	
<?php include_once "../assets/basefooter.php"; ?>

</body>
</html>