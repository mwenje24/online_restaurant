
<div class="container-fluid shadow">
    <div class="row menu-bar1">
        <div class="col-4 header-list">
            <img class="home-logo" style="height: 40px;" src="../images/logos/fast-food.png">
        </div>
        <div class="col-8 header-list">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="customer_profile.php?id=<?php echo $_SESSION['id']?>">
                    <img class="user-logo" style="height: 30px; margin-top:-10px;" src="../images/logos/user2.png">
                    <span class="user-name">
                        <?php 
                        if(isset($_SESSION['user'])){
                            echo $_SESSION['user'];
                        }
                        ?></span></a></li>
                <!-- <li><a href="">FAQs</a></li> -->
                <li><a href="logout.php">Logout</a></li>
                <a onclick="openCustomerCart()"><img class="cart-logo" src="../images/logos/shopping-cart.png"></a>
                <span class="item_count bg-danger mt-1 text-light">
                    <?php
                        if(isset($count)){
                            echo $count;
                        } 
                    ?>
                    
                </span>
                <!-- <a onclick="openCustomerCart()"><img class="cart-logo" src="../images/logos/shopping-cart.png"></a>
                <span class="item_count bg-danger mt-1 text-light"><?php echo $count ?></span> -->
            </ul>
        </div>
    </div>
</div>