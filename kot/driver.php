<?php

require_once "../assets/config.php";
require_once "../assets/functions.php";

session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");//
}

$drivername = '';
$driverphone = '';
$update = false;
$driverid = '';

$statement = $db->prepare("SELECT * FROM driver");
$statement->execute();
$drivers = $statement->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['save'])){

    $driverid = randomId(5);
    $drivername = $_POST['drivername'];
    $driverphone = $_POST['driverphone'];

    $statement = $db->prepare("INSERT INTO driver(driverid, drivername, driverphone) VALUES(:id ,:drivername, :driverphone)");
    $statement->bindValue(':id', $driverid);
    $statement->bindValue(':drivername', $drivername);
    $statement->bindValue(':driverphone', $driverphone);
    $statement->execute();
    header('Location:driver.php');
}

if(isset($_GET['delete'])){
    $driverid = $_GET['delete'];
    if(!$driverid){
        header('Location:driver.php');
        exit;
    }

    $statement = $db->prepare('DELETE FROM driver WHERE driverid = :id');
    $statement->bindValue(':id', $driverid);
    $statement->execute();

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = 'danger';
    header('Location:driver.php');
}

if(isset($_GET['edit'])){
    $driverid = $_GET['edit'];
    $update = true;

    $statement = $db->prepare("SELECT * FROM driver WHERE driverid = :id");
    $statement->bindValue(':id', $driverid);
    $statement->execute();
    $drivervalues = $statement->fetch(PDO::FETCH_ASSOC);

    $drivername = $drivervalues['drivername'];
    $driverphone = $drivervalues['driverphone'];
    $driverid = $drivervalues['driverid'];
//    $_SESSION['message'] = "Record has been updated";
//    $_SESSION['msg_type'] = 'success';
    // header('Location:kot_waiters.php');
}

if(isset($_POST['update'])){
    $update_id = $_POST['driverid'];
    $drivername = $_POST['drivername'];
    $update = false;

    $statement = $db->prepare("UPDATE driver SET drivername = :drivername, driverphone = :driverphone WHERE driverid = :id");
    $statement->bindValue(':drivername', $drivername);
    $statement->bindValue(':driverphone', $driverphone);
    $statement->bindValue(':id', $update_id);
    $statement->execute();

    //    $_SESSION['message'] = "Record has been updated";
    //    $_SESSION['msg_type'] = 'success';
    header('Location:driver.php');

}
?>


<?php include_once "../assets/base.php"; ?>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-2 sidebar-menu">
            <?php include_once "kotsidebar.php"; ?>
        </div>
        <div class="col-10 menu-preview">
            <div class="container">
                <br>
                <h4>List Of Drivers</h4><br>
                <div class="row justify-content-center">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Driver Name</label>
                            <input type="hidden" name="driverid" class="form-control" value="<?php echo $driverid ?>"/>
                            <input type="text" name="drivername" class="form-control mb-2" placeholder="Enter Driver Name" value="<?php echo $drivername; ?>"/>
                            <label>Phone</label>
                            <input type="text" name="driverphone" class="form-control" placeholder="Enter Driver Phone Number" value="<?php echo $driverphone; ?>"/>
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
                            <th>Driver</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <?php foreach ($drivers as $i=> $drivers): ?>
                            <tr>
                                <th scope="row"><?php echo $i + 1?></th>
                                <td><?php echo $drivers['drivername'] ?></td>
                                <td><?php echo $drivers['driverphone'] ?></td>
                                <td>
                                    <a href="driver.php?edit=<?php echo $drivers['driverid']; ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="driver.php?delete=<?php echo $drivers['driverid']; ?>" class="btn btn-danger btn-sm">Delete</a>
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