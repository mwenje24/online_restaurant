
<?php

require_once "../assets/config.php";
require_once "../assets/functions.php";

$firstname = '';
$lastname = '';
$email = '';
$phone = '';
$town = '';
$street = '';
$password = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $id =randomId(10);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $town = $_POST['town'];
    $street = $_POST['street'];
    $password = $_POST['password'];

    $statement = $db->prepare('INSERT INTO customer(id, firstname, lastname, email, phone, town, street, password) VALUES(:id, :firstname, :lastname, :email, :phone, :town, :street, :password)');
    $statement->bindValue(':id', $id);
    $statement->bindValue(':firstname', $firstname);
    $statement->bindValue(':lastname', $lastname);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':town', $town);
    $statement->bindValue(':street', $street);
    $statement->bindValue(':password', $password);
    $statement->execute();
    header('Location:customer_sign.php');
}



?>
<?php include_once "../assets/base.php"; ?>
</body>
	<div class="container">
	    <div class="row justify-content-center new-customer">
    	<div class="title-head">
			<h4>Welcome Customer</h4>
		</div>
	    <?php include_once "form.php"?>
        <button type="submit" class="btn btn-sm btn-success">Submit</button>
    </form>
          <div class="col-md-6">
            <a href="customer_sign.php">Already Have an account? Login</a>
        </div>
</div>
	</div>


    
<?php include_once "../assets/basefooter.php"; ?>
</body>
</html>