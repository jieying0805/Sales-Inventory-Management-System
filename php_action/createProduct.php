<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

  $productName 		= $_POST['productName'];
  $cost 					= $_POST['cost'];
  $price 					= $_POST['price'];
  $commission 					= $_POST['commission'];
  $quantity 			= $_POST['quantity'];
  $categoryName 	= $_POST['categoryName'];

	$sql = "INSERT INTO product (product_name, unit_cost, price, commission, quantity, categories_id) 
	VALUES ('$productName', '$cost', '$price', '$commission', '$quantity', '$categoryName')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the product";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST