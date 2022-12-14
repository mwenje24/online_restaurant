<?php

require_once "../assets/config.php";
session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}

$id = $_GET['email'];
if(!$id){
    header('Location:user.php');
    exit;
}

$statement = $db->prepare('SELECT * FROM user WHERE email = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$users = $statement->fetch(PDO::FETCH_ASSOC);

$fullnames = $users['full_names'];
$email = $users['email'];
$username = $users['username'];
$password = $users['password'];
$type = $users['type'];

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    $fullnames = $_POST['fullnames'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];
    

    $statement = $db->prepare("UPDATE user SET full_names =:fullnames ,email= :email, username= :username,
     password= :password, type =:type  WHERE email = :email");
    $statement->bindValue(':fullnames', $fullnames);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':type', $type);
    $statement->execute();
    header('Location:user.php');
    
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
                <h4>Update '<?php echo $users['full_names']?>'</h4><br>
                <?php include_once "userform.php" ?>
            </div>

			</div>
		</div>
	</div>

	
<?php include_once "../assets/basefooter.php"; ?>

</body>
</html>