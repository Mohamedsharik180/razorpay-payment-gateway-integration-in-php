<?php
session_start();
include_once("inc/db_connect.php");
include_once("inc/config.inc.php");
setlocale(LC_MONETARY,"en_US");
# add products in cart 
if(isset($_POST["product_code"])) {
	foreach($_POST as $key => $value){
		$product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
	}	
	$statement = $conn->prepare("SELECT product_name, product_price FROM shop_products WHERE product_code=? LIMIT 1");
	$statement->bind_param('s', $product['product_code']);
	$statement->execute();
	$statement->bind_result($product_name, $product_price);
	while($statement->fetch()){ 
		$product["product_name"] = $product_name;
		$product["product_price"] = $product_price;		
		if(isset($_SESSION["products"])){ 
			if(isset($_SESSION["products"][$product['product_code']])) {				
				$_SESSION["products"][$product['product_code']]["product_qty"] = $_SESSION["products"][$product['product_code']]["product_qty"] + $_POST["product_qty"];				
			} else {
				$_SESSION["products"][$product['product_code']] = $product;
			}			
		} else {
			$_SESSION["products"][$product['product_code']] = $product;
		}	
	}	
 	$total_product = count($_SESSION["products"]);
	die(json_encode(array('products'=>$total_product)));
}
# Remove products from cart
if(isset($_GET["remove_code"]) && isset($_SESSION["products"])) {
	$product_code  = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING);
	if(isset($_SESSION["products"][$product_code]))	{
		unset($_SESSION["products"][$product_code]);
	}	
 	$total_product = count($_SESSION["products"]);
	die(json_encode(array('products'=>$total_product)));
}
# Update cart product quantity
if(isset($_GET["update_quantity"]) && isset($_SESSION["products"])) {	
	if(isset($_GET["quantity"]) && $_GET["quantity"]>0) {		
		$_SESSION["products"][$_GET["update_quantity"]]["product_qty"] = $_GET["quantity"];	
	}
	$total_product = count($_SESSION["products"]);
	die(json_encode(array('products'=>$total_product)));
}	