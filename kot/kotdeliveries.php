
<?php include_once "../assets/base.php"; 
require_once "../assets/config.php";

session_start();
if(!isset($_SESSION['user'])){
	header("location:login.php");
}


$statement = $db->prepare('SELECT * FROM cart_order ORDER BY time_date DESC');

$statement->execute();
$cartorders = $statement->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['delivered'])){
    $c_order_id  =  $_GET['c_order_id'];
    $stt = $db->prepare('SELECT * FROM cart_order_items WHERE order_id= :ordeid');
    $stt->bindValue(':ordeid', $c_order_id);
    $stt->execute();
    $orderitems = $stt->fetchAll(PDO::FETCH_ASSOC);

    echo '<script> window.onload =function openOnlinedeliver(){ document.getElementById("delivery_Items").style.display="block";}</script>';
}
if(isset($_GET['action'])){
    if($_GET['action']=='status_update'){
        $orderid = $_GET['order_id'];

        $statement = $db->prepare("UPDATE cart_order SET delivery= true WHERE order_id =:id");
        $statement->bindValue(':id', $orderid);
        $statement->execute();
        header('Location:kotdeliveries.php');
    }
}

?>

<body>
<div class="container-fluid">
    <div class="row">
    <div class="col-2 sidebar-menu">
        <?php include_once "kotsidebar.php"; ?>
    </div>
    <div class="col-10 menu-preview">
        <div class="col-10 menu-preview">
        <div class="container">
            <h4 style="color: #607D8B;" class="text-center mt-3">Deliveries</h4>
            <div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">order id</th>
                        <th scope="col">customer id</th>
                        <th scope="col">amount</th>
                        <th scope="col">date</th>
                        <th scope="col">Delivery status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cartorders as $i=> $cartorder): ?>
                        <tr>
                            <th scope="row"><?php echo $i + 1?></th>
                            <td><?php echo $cartorder['order_id'] ?></td>
                            <td><?php echo $cartorder['customer_id'] ?></td>
                            <td><?php echo $cartorder['total_amount'] ?></td>
                            <td><?php echo $cartorder['time_date'] ?></td>
                            </td>
                            <?php
                                if($cartorder['delivery'] == false):
                            ?>
                                <td>
                                    <form method="POST" action="kotdeliveries.php?c_order_id=<?php echo $cartorder['order_id']; ?>">
                                        <input type="hidden" name="c_order_id" value="<?php echo $cartorder['order_id']; ?>">
                                        <input class="btn btn-danger btn-sm" type="submit" name="delivered" value="Pending">
                                    </form>
                                </td>
                            <?php else: ?>
                                <td>
                                    <button class="btn btn-sm btn-success">Delivered</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
<div class="form-display" id="delivery_Items">

    <div class="container rounded-3 kotitems w-25 h-25 form-content">
        <div class="row">
            <div class="col-12">
                <button onclick="closeOnlinedelivery()" type="button" class="btn-close" aria-label="Close"></button>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <span class="text-center">Confirm Delivery?</span><br/>
                <a href="kotdeliveries.php?action=status_update&order_id=<?php echo $c_order_id;?>" class="btn btn-sm btn-success float-end mt-2">Clear</a>
            </div>
        </div>
    </div>
</div>

<?php include_once "../assets/basefooter.php"; ?>

</body>
</html>