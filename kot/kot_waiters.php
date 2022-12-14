<?php

require_once "../assets/config.php";
require_once "../assets/functions.php";

session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");
}

$waitername = '';
$update = false;
$waiter_id = '';

$statement = $db->prepare("SELECT * FROM kot_waiters");
$statement->execute();
$waiters = $statement->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['save'])){

    $waiter_id = randomId(5);
    $waitername = $_POST['waitername'];

    $statement = $db->prepare("INSERT INTO kot_waiters(waiter_id, waitername) VALUES(:id ,:waitername)");
    $statement->bindValue(':id', $waiter_id);
    $statement->bindValue(':waitername', $waitername);
    $statement->execute();
    header('Location:kot_waiters.php');
}

if(isset($_GET['delete'])){
    $waiter_id = $_GET['delete'];
    if(!$waiter_id){
        header('Location:kot_waiters.php');
        exit;
    }

    $statement = $db->prepare('DELETE FROM kot_waiters WHERE waiter_id = :id');
    $statement->bindValue(':id', $waiter_id);
    $statement->execute();

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = 'danger';
    header('Location:kot_waiters.php');
}

if(isset($_GET['edit'])){
    $waiter_id = $_GET['edit'];
    $update = true;

    $statement = $db->prepare("SELECT * FROM kot_waiters WHERE waiter_id = :id");
    $statement->bindValue(':id', $waiter_id);
    $statement->execute();
    $waitervalues = $statement->fetch(PDO::FETCH_ASSOC);

    $waitername = $waitervalues['waitername'];
    $waiterid = $waitervalues['waiter_id'];
//    $_SESSION['message'] = "Record has been updated";
//    $_SESSION['msg_type'] = 'success';
    // header('Location:kot_waiters.php');
}

if(isset($_POST['update'])){
    $update_id = $_POST['waiterid'];
    $waitername = $_POST['waitername'];
    $update = false;

    $statement = $db->prepare("UPDATE kot_waiters SET waitername = :waitername WHERE waiter_id = :id");
    $statement->bindValue(':waitername', $waitername);
    $statement->bindValue(':id', $update_id);
    $statement->execute();

    //    $_SESSION['message'] = "Record has been updated";
    //    $_SESSION['msg_type'] = 'success';
    header('Location:kot_waiters.php');

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
                <h4>List Of Waiters</h4><br>
                <div class="row justify-content-center">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Waiter Name</label>
                            <input type="hidden" name="waiterid" class="form-control" value="<?php echo $waiterid ?>"/>
                            <input type="text" name="waitername" class="form-control" placeholder="Enter Waiter" value="<?php echo $waitername; ?>"/>
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
                            <th>Waiter</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <?php foreach ($waiters as $i=> $waiters): ?>
                            <tr>
                                <th scope="row"><?php echo $i + 1?></th>
                                <td><?php echo $waiters['waitername'] ?></td>
                                <td>
                                    <a href="kot_waiters.php?edit=<?php echo $waiters['waiter_id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="kot_waiters.php?delete=<?php echo $waiters['waiter_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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