 <?php 
session_start();
include_once("inc/db_connect.php");
include("inc/config.inc.php"); 
include("inc/header.php"); 
?>
<title>phpzag.com : Demo Build Shopping Cart with Ajax, PHP and MySQL</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/cart.js"></script>
<?php include('inc/container.php');?>
<div class="container">	
	<h2>Demo - Shopping Cart with Ajax, PHP and MySQL</h2>
	<div class="text-left">	
		<br><br>
		Your order placed successfully.
		<br><br><br>
		<a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a>
		
	</div>
</div>
<?php include('inc/footer.php');?>




