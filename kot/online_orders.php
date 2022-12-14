
<?php include_once "../assets/base.php";
require_once "../assets/config.php";

session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");
}


$search = isset($_POST['search']) ? $_POST['search'] :'';
if($search){
    $statement = $db->prepare('SELECT * FROM cart_order WHERE order_id LIKE :orderid ORDER BY time_date DESC');
    $statement->bindValue(':orderid', "%$search%");
}
else{
    $statement = $db->prepare('SELECT * FROM cart_order ORDER BY time_date DESC');
}
$statement->execute();
$cartorders = $statement->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['served'])){
    $c_order_id  =  $_GET['c_order_id'];
    $stt = $db->prepare('SELECT * FROM cart_order_items WHERE order_id= :ordeid');
    $stt->bindValue(':ordeid', $c_order_id);
    $stt->execute();
    $orderitems = $stt->fetchAll(PDO::FETCH_ASSOC);

    // $_SESSION['order-ref'] = $orderitems['order_id'];

    echo '<script> window.onload =function opencartItems(){ document.getElementById("cart_Items").style.display="block";}</script>';
}

        // $driverid = $_GET['driverid'];
        // $customerid = $_GET['customerid'];

if(isset($_GET['action'])){
    if($_GET['action']=='status_update'){
        $orderid = $_GET['order_id'];
        // $driver = $_POST['driver-name'];
        // $driverid = $_GET['driverid'];
        // $customerid = $_GET['customerid'];
        
        // var_dump($driverid);
        // exit();

        // $stmt = $db->prepare("INSERT INTO delivery(order_id, driverid, customerid) VALUES(:order, :driver, :customer)");
        // $stmt->bindValue(':order', $orderid);
        // $stmt->bindValue(':driver', $driverid);
        // $stmt->bindValue(':customer', $customerid);
        // $stmt->execute();


        $statement = $db->prepare("UPDATE cart_order SET status= true WHERE order_id =:id");
        $statement->bindValue(':id', $orderid);
        $statement->execute();

        echo '<script> window.onload =function openprint(){ document.getElementById("print-page").style.display="block";}</script>';

        // header('Location:online_orders.php');
    }
}

$statement = $db->prepare("SELECT * FROM driver");
$statement->execute();
$drivers = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
<body>
<div class="container-fluid">
    <div class="row">
    <div class="col-2 sidebar-menu">
        <?php include_once "kotsidebar.php"; ?>
    </div>
    <div class="col-10 menu-preview">
        <div class="clr"></div>
        <div class="search shadow">
            <form class="d-flex" action="" method="post">
                <input class="form-control" name="search" value="<?php echo $search ?>" type="text" placeholder="Search order_id ?">
                <button class="btn btn-outline-dark" type="submit">Search</button>
            </form>
        </div>
        <div class="container">
            <h4 style="color: #607D8B;" class="text-center mt-3">Online Orders</h4>
            <div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">order id</th>
                        <th scope="col">customer id</th>
                        <th scope="col">amount</th>
                        <th scope="col">date</th>
                        <th scope="col">status</th>
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
                                if($cartorder['status'] == false):
                            ?>
                                <td>
                                    <form method="POST" action="online_orders.php?c_order_id=<?php echo $cartorder['order_id']; ?>">
                                        <input type="hidden" name="c_order_id" value="<?php echo $cartorder['order_id']; ?>">
                                        <input type="hidden" name="customerid" value="<?php echo $cartorder['customer_id']; ?>">
                                        <input class="btn btn-danger btn-sm" type="submit" name="served" value="Pending">
                                    </form>
                                </td>
                            <?php else: ?>
                                <td>
                                    <button class="btn btn-sm btn-success">Served</button>
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

<!-- kot items display -->

<div class="form-display" id="cart_Items">

    <div class="container mt-5 kotitems w-25 form-content">
        <div class="row">
            <div class="col-12">
                <button onclick="closecartItems()" type="button" class="btn-close" aria-label="Close"></button>
            </div>
        </div>
        <div class="row bg-light">
            <label>select driver</label>
            <div class="col-12 mt-1">
                <form action="" method="POST">
                    <select class="form-select form-control sm shadow" name="driver-name">
                        <?php foreach ($drivers as $i=> $drivers): ?>
                            <option value="<?php echo $drivers['drivername'] ?>"><?php echo $drivers['drivername']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="driver-name" value="<?php echo $drivers['drivername'] ?>">
                </form>
            </div>
            <di class="float-end">
                <a href="online_orders.php?action=status_update&order_id=<?php echo $c_order_id;?>" class="btn btn-sm btn-success float-end m-2" onclick="openprint()">Clear</a>
            </di>
        </div>
    </div>
</div>

<!-- printout -->
<div class="form-display" id="print-page">

    <div class="container w-75 form-content">
        <div id="print-btn" class="row">
            <div class="col-12">
                <button onclick="closeprint()" type="button" class="btn-close" aria-label="Close"></button>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <label class="float-end mt-4 mb-3">Driver: Bethsheba Davids</label>
                <table class="table table-striped">
                    <thead>
                    <tbody>
                        <tr>
                            <td>Customer Name</td>
                            <td>samwel Lee</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>Busia, Nambale</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>075689523</td>
                        </tr>
                    </tbody>
                </table>
                <h5 style="color: #607D8B;" class="text-center mb-3">Order Items for(<?php echo $orderid;?>)</h5>
                <di class="col-2 float-end">
                        <a id="print-btn" href="online_orders.php?action=status_update&order_id=<?php echo $c_order_id;?>" class="btn btn-sm btn-outline-success float-end m-2" onclick="window.print();">print</a>
                    </di>
                <!-- <button id="print-btn" onclick="window.print();" class="btn btn-outline-success float-end">Print</button> -->
                <div class="kottabledisplay" >                 
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">product id</th>
                            <th scope="col">description</th>
                            <th scope="col">quantity</th>
                            <th scope="col">total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            
                            $stt = $db->prepare('SELECT * FROM cart_order_items WHERE order_id= :ordeid');
                            $stt->bindValue(':ordeid', $orderid);
                            $stt->execute();
                            $cartorderitems = $stt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($cartorderitems as $i=> $cartorderitem): ?>
                            <tr>
                                <th scope="row"><?php echo $i + 1?></th>
                                <td><?php echo $cartorderitem['product_id'] ?></td>
                                <td><?php echo $cartorderitem['description'] ?></td>
                                <td><?php echo $cartorderitem['quantity'] ?></td>
                                <td><?php echo $cartorderitem['total'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "../assets/basefooter.php"; ?>

</body>
</html>