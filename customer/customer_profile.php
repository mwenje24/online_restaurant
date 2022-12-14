
<?php

require_once "../assets/config.php";
require_once "../assets/functions.php";

$id = $_GET['id'];
if(!$id){
    header('Location:index.php');
    exit;
}

$statement = $db->prepare('SELECT * FROM customer WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$customer = $statement->fetch(PDO::FETCH_ASSOC);

$firstname = $customer['firstname'];
$lastname = $customer['lastname'];
$email = $customer['email'];
$phone = $customer['phone'];
$town = $customer['town'];
$street = $customer['street'];
$password = $customer['password'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $town = $_POST['town'];
    $street = $_POST['street'];
    $password = $_POST['password'];

    $statement = $db->prepare('UPDATE customer SET firstname= :firstname, lastname= :lastname, email= :email, phone= :phone, town =:town, street= :street, password= :password WHERE id= :id');
    $statement->bindValue(':firstname', $firstname);
    $statement->bindValue(':lastname', $lastname);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':town', $town);
    $statement->bindValue(':street', $street);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':id', $id);
    $statement->execute();
    header('Location:index.php');
}



?>
<?php include_once "../assets/base.php"; ?>
</body>
<?php include_once "header.php"; ?>
	<div class="container">
	    <div class="row justify-content-center new-customer">
    	<div class="title-head">
			<h4>Update Profile</h4>
		</div>
	    <?php include_once "form.php"?>
        <button type="submit" class="btn btn-sm btn-success">Update</button>
    </form>
</div>
	</div>


    
<?php include_once "../assets/basefooter.php"; ?>
</body>
</html>