
<?php include_once "../assets/base.php";
require_once "../assets/config.php";

require_once "../assets/fpdf/fpdf.php";
// $pdf = new FPDF();//
// $pdf->AddPage();
// $pdf->SetFont('Arial', '', '14');
// $pdf->Cell(100, 20, 'Hello World', 1, 0, 'C');

session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");
}

$search = isset($_POST['search']) ? $_POST['search'] :'';
if($search){
    $statement = $db->prepare('SELECT * FROM kot_order WHERE order_table LIKE :tableno ORDER BY kot_date DESC');
    $statement->bindValue(':tableno', "%$search%");
}
else{
    $statement = $db->prepare('SELECT * FROM kot_order ORDER BY kot_date DESC');
}
$statement->execute();
$kotorders = $statement->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['served'])){
    $k_order_id  =  $_GET['k_order_id'];
    $stt = $db->prepare('SELECT * FROM kot_order_items WHERE kot_order_id= :kotordeid');
    $stt->bindValue(':kotordeid', $k_order_id);
    $stt->execute();
    $kotorderitems = $stt->fetchAll(PDO::FETCH_ASSOC);

    echo '<script> window.onload =function openKotItems(){ document.getElementById("kot_Items").style.display="block";}</script>';
}
if(isset($_GET['action'])){
    if($_GET['action']=='status_update'){
        $orderid = $_GET['order_id'];

        $statement = $db->prepare("UPDATE kot_order SET status= true WHERE kot_order_id =:id");
        $statement->bindValue(':id', $orderid);
        $statement->execute();

        // $pdf = new FPDF();
        // $pdf->AddPage();
        // $pdf->SetFont('Arial', '', 12);

        // $x = 20;
        // $pdf->Cell(100, $x, 'Hello World', 0, 0, 'C');
        // $pdf->Cell(90, $x, 'Hello World two', 0, 0, 'C');
        // $pdf->Line(10, 25, 200, 25);
        // $pdf->Ln(5);

        // $pdf->Output();

        header('Location:kotmeal_orders.php');
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
        <div class="clr"></div>
        <div class="search shadow">
            <form class="d-flex" action="" method="post">
                <input class="form-control" name="search" value="<?php echo $search ?>" type="text" placeholder="Search order table ?">
                <button class="btn btn-outline-dark" type="submit">Search</button>
            </form>
        </div>
        <div class="container">
            <h4 style="color: #607D8B;" class="text-center mt-3">KOT Orders</h4>
            <div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">kot order id</th>
                        <th scope="col">kot date</th>
                        <th scope="col">order table</th>
                        <th scope="col">waiter</th>
                        <th scope="col">type</th>
                        <th scope="col">bill</th>
                        <th scope="col">status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($kotorders as $i=> $kotorder): ?>
                        <tr>
                            <th scope="row"><?php echo $i + 1?></th>
                            <td><?php echo $kotorder['kot_order_id'] ?></td>
                            <td><?php echo $kotorder['kot_date'] ?></td>
                            <td><?php echo $kotorder['order_table'] ?></td>
                            <td><?php echo $kotorder['waiter'] ?></td>
                            <td><?php echo $kotorder['type'] ?></td>
                            <td><?php echo $kotorder['bill'] ?></td>
                            <?php
                                if($kotorder['status'] == false):
                            ?>
                                <td>
                                    <form method="POST" action="kotmeal_orders.php?k_order_id=<?php echo $kotorder['kot_order_id']; ?>">
                                        <input type="hidden" name="k_order_id" value="<?php echo $kotorder['kot_order_id']; ?>">
                                        <input class="btn btn-danger btn-sm" type="submit" name="served" value="Pending">
                                    </form>
                                </td>
                            <?php else: ?>
                                <td>
                                    <button class="btn btn-sm btn-success">Served</button>
                                    <!-- <form method="POST" action="kotmeal_orders.php?k_order_id=<?php //echo $kotorder['kot_order_id']; ?>">
                                        <input type="hidden" name="k_order_id" value="<?php// echo $kotorder['kot_order_id']; ?>">
                                        <input class="btn btn-success btn-sm" type="submit" name="served" value="Served">
                                    </form>-->
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

<div class="form-display" id="kot_Items">

        <div class="container kotitems w-50 form-content">
            <div class="row">
                <div class="col-12">
                    <button onclick="closeKotItems()" type="button" class="btn-close" aria-label="Close"></button>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <?php $k_order_id  =  $_GET['k_order_id'];?>
                    <h5 style="color: #607D8B;" class="text-center mb-3">Order Items for(<?php echo $k_order_id;?>)</h5>
                    <div class="kottabledisplay" >                 
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">product id</th>
                                <th scope="col">description</th>
                                <th scope="col">quantity</th>
                                <th scope="col">total</th>
                                <th scope="col">activity</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                
                                $stt = $db->prepare('SELECT * FROM kot_order_items WHERE kot_order_id= :kotordeid');
                                $stt->bindValue(':kotordeid', $k_order_id);
                                $stt->execute();
                                $kotorderitems = $stt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($kotorderitems as $i=> $kotorderitem): ?>
                                <tr>
                                    <th scope="row"><?php echo $i + 1?></th>
                                    <td><?php echo $kotorderitem['product_id'] ?></td>
                                    <td><?php echo $kotorderitem['product_description'] ?></td>
                                    <td><?php echo $kotorderitem['quantity'] ?></td>
                                    <td><?php echo $kotorderitem['total'] ?></td>
                                    <td><button onclick="#" class="btn btn-sm btn-outline-danger">Delete</button></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="kotmeal_orders.php?action=status_update&order_id=<?php echo $k_order_id;?>" class="btn btn-sm btn-success float-end m-2">Clear</a>
                </div>
            </div>
        </div>
    </div>

<?php include_once "../assets/basefooter.php"; ?>

</body>
</html>