<?php include_once "../assets/base.php";
require_once "../assets/config.php";

session_start();
if(!isset($_SESSION['user'])){
    header("location:login.php");
}
?>
<link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
<body>
<div class="form-display" id="cart_Items">

    <div class="container w-75 form-content">
        <div class="row">
            <div class="container">
            	<label class="float-end mt-4 mb-3">Driver: Beth See</label>
            	<table class="table table-striped">
                    <thead>
                    <tbody>
                    	<tr>
                    		<td>Customer Name</td>
                    		<td>David Msoi</td>
                    	</tr>
                    	<tr>
                    		<td>Address</td>
                    		<td>P. O Box 3343, Nambale</td>
                    	</tr>
                    	<tr>
                    		<td>Phone</td>
                    		<td>075689523</td>
                    	</tr>
                    </tbody>
                </table>
                <?php $c_order_id  =  "0O3TKHYXF6";?>
                <h5 style="color: #607D8B;" class="mb-3">Order Items for(<?php echo $c_order_id;?>)</h5>

                <button id="print-btn" onclick="window.print();" class="btn btn-outline-success float-end">Print</button>
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
                            $stt->bindValue(':ordeid', $c_order_id);
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