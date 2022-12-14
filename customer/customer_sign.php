
<?php
require_once "../assets/config.php";

session_start();


if($_SERVER['REQUEST_METHOD'] ==='POST') {

    if(empty($_POST['email']) || empty($_POST['password'])){
        header("location:customer_sign.php?Empty=Please Fill the Blanks");
    }
    else{
        $username = $_POST['email'];
        $password = $_POST['password'];

        $statement = $db->prepare('SELECT * FROM customer WHERE email= :email AND password = :password');
        $statement->bindValue(':email', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $customer = $statement->fetch(PDO::FETCH_ASSOC);

        if($statement->rowCount()> 0){
            $_SESSION['user'] = $customer['lastname'];
            $_SESSION['id'] = $customer['id'];
            $_SESSION['usernames'] = $customer['firstname']." ".$customer['lastname'];
            $_SESSION['useremail'] = $customer['email'];
            $_SESSION['userphone'] = $customer['phone'];
            $_SESSION['usercity'] = $customer['town'];
            $_SESSION['useraddress'] = $customer['street'];
            header("location:index.php");
        }
        else{
            header("location:customer_sign.php?Invalid=Please enter Correct username and password");
        }
    }

}

?>
<?php include_once "../assets/base.php"; ?>
<body class="text-center">
	<div class="container mt-5 form-signin" style="background: #ccc;">
	  <form method="POST" action="customer_sign.php">
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
	  <div class="row">
        <a href="newcustomer.php">New Customer? Create an account..</a>
    </div>
    <p class="mt-3 mb-3 text-muted">&copy; 2021</p>
	</div>

	<?php include_once "../assets/basefooter.php"; ?>
</body>
</html>
