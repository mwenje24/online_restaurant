
<?php
require_once "../assets/config.php";

session_start();


if($_SERVER['REQUEST_METHOD'] ==='POST') {

    if(empty($_POST['email']) || empty($_POST['password'])){
        header("location:login.php?Empty=Please Fill the Blanks");
    }
    else{
        $username = $_POST['email'];
        $password = $_POST['password'];

        $statement = $db->prepare("SELECT * FROM user WHERE email= :email AND password = :password AND type = 'super admin'");
        $statement->bindValue(':email', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($statement->rowCount()> 0){
            $_SESSION['user'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['useremail'] = $user['email'];
            header("location:index.php");
        }
        else{
            header("location:login.php?Invalid=Please enter Correct username and password");
        }
    }

}

?>
<?php include_once "../assets/base.php"; ?>
<body class="text-center">
	<div class="container mt-5 form-signin" style="background: #ccc;">
	  <form method="POST" action="login.php">
	    <img class="mb-4" src="../images/logos/user.png" alt="" width="72" height="70">
	    <h1 class="h3">Please sign in</h1>
	    <?php
		if(@$_GET['Empty']==true){
			?>
			<div class="alert-light text-danger text-center py-3"><?php echo $_GET['Empty'] ?></div>
			<?php
		}
		?>
		<?php
		if(@$_GET['Invalid']==true){
			?>
			<div class="alert-light text-danger text-center py-3"><?php echo $_GET['Invalid'] ?></div>
			<?php
		}
		?>
	    <label for="inputEmail" class="form-label">Email address</label>
	    <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
	    <label for="inputPassword" class="form-label">Password</label>
	    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
	    <div class="checkbox mb-3">
	    </div>
	    <button class="w-100 mt-3 btn btn-lg btn-primary" type="submit">Sign in</button>
	  </form><br>
    <p class="mt-3 mb-3 text-muted">&copy; 2021</p>
	</div>

	<?php include_once "../assets/basefooter.php"; ?>
</body>
</html>
