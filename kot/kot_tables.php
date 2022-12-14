<?php

require_once "../assets/config.php";
require_once "../assets/functions.php";

session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");
}

$tablename = '';
$update = false;
$tableid = '';

$statement = $db->prepare("SELECT * FROM kot_tables");
$statement->execute();
$kottables = $statement->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['save'])){

    $table_id = randomId(5);
    $tablename = $_POST['tablename'];

    $statement = $db->prepare("INSERT INTO kot_tables(table_id, table_name) VALUES(:id ,:tablename)");
    $statement->bindValue(':id', $table_id);
    $statement->bindValue(':tablename', $tablename);
    $statement->execute();
    header('Location:kot_tables.php');
}

if(isset($_GET['delete'])){
    $table_id = $_GET['delete'];
    if(!$table_id){
        header('Location:kot_tables.php');
        exit;
    }

    $statement = $db->prepare('DELETE FROM kot_tables WHERE table_id = :id');
    $statement->bindValue(':id', $table_id);
    $statement->execute();

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = 'danger';
    header('Location:kot_tables.php');
}

if(isset($_GET['edit'])){
    $table_id = $_GET['edit'];
    $update = true;

    $statement = $db->prepare("SELECT * FROM kot_tables WHERE table_id = :id");
    $statement->bindValue(':id', $table_id);
    $statement->execute();
    $tablevalues = $statement->fetch(PDO::FETCH_ASSOC);

    $tablename = $tablevalues['table_name'];
    $tableid = $tablevalues['table_id'];
//    $_SESSION['message'] = "Record has been updated";
//    $_SESSION['msg_type'] = 'success';
    // header('Location:kot_tables.php');
}

if(isset($_POST['update'])){
    $update_id = $_POST['tableid'];
    $tablename = $_POST['tablename'];
    $update = false;

    $statement = $db->prepare("UPDATE kot_tables SET table_name = :tablename WHERE table_id = :id");
    $statement->bindValue(':tablename', $tablename);
    $statement->bindValue(':id', $update_id);
    $statement->execute();

    //    $_SESSION['message'] = "Record has been updated";
    //    $_SESSION['msg_type'] = 'success';
    header('Location:kot_tables.php');

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
                <h4>Restaurant Tables</h4><br>
                <div class="row justify-content-center">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Table Name</label>
                            <input type="hidden" name="tableid" class="form-control" value="<?php echo $tableid ?>"/>
                            <input type="text" name="tablename" class="form-control" placeholder="Enter Table" value="<?php echo $tablename; ?>"/>
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
                            <th>Tables</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <?php foreach ($kottables as $i=> $kottables): ?>
                            <tr>
                                <th scope="row"><?php echo $i + 1?></th>
                                <td><?php echo $kottables['table_name'] ?></td>
                                <td>
                                    <a href="kot_tables.php?edit=<?php echo $kottables['table_id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="kot_tables.php?delete=<?php echo $kottables['table_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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