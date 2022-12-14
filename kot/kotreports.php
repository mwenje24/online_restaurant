
<?php include_once "../assets/base.php"; 

session_start();
if(!isset($_SESSION['user'])){
	header("location:login.php");
}

?>

<body>
<div class="container-fluid">
    <div class="row">
    <div class="col-2 sidebar-menu">
        <?php include_once "kotsidebar.php"; ?>
    </div>
    <div class="col-10 menu-preview">
        
    </div>
    </div>
</div>


<?php include_once "../assets/basefooter.php"; ?>
</body>
</html>