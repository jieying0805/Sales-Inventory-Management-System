<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$date = $_POST['date'];
  $product = $_POST['product']; 
  $qtyOrdered = $_POST['qtyOrdered']; 
  $status = $_POST['status']; 
  $qtyReceived = $_POST['qtyReceived']; 

	$sql = "INSERT INTO inventory (date, product_id, status, qty_ordered, qty_received) 
	VALUES ('$date', '$product', '$status', '$qtyOrdered', '$qtyReceived')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the inventory log";
	}

	
		$productName = $_POST['product'];
  
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = $productName";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity = $updateProductQuantityResult[0] + $_POST['qtyReceived'];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = $updateQuantity WHERE product_id = $productName";
				$connect->query($updateProductTable);

			if($connect->query($updateProductTable) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Successfully Added";	
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while adding the inventory log";
			}
		}		


	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST