<?php 	
//ALTER TABLE `orders` ADD `payment_place` INT NOT NULL AFTER `payment_status`;
//TER TABLE `orders` ADD `gstn` VARCHAR(255) NOT NULL AFTER `payment_place`;
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

  $orderDate = date('Y-m-d', strtotime($_POST['orderDate']));	
  $cust_id = $_POST['customerName'];
  $subTotalValue = $_POST['subTotalValue'];
  $shipping =	$_POST['shippingValue'];
  $totalAmountValue = $_POST['totalAmountValue'];
  $subTotalCommValue = $_POST['subTotalCommValue'];
  $paymentType = $_POST['paymentType'];
  $paymentRef = $_POST['paymentRef'];
  $orderStatus = $_POST['orderStatus'];
  $tracking = $_POST['tracking'];
  $userid = $_SESSION['userId'];

				
	$sql = "INSERT INTO orders (order_date, cust_id, sub_total, shipping, total_amount, total_commission, payment_type, payment_ref,order_status,tracking,user_id) VALUES ('$orderDate', '$cust_id', '$subTotalValue', '$shipping', '$totalAmountValue', '$subTotalCommValue ', '$paymentType', '$paymentRef', '$orderStatus', '$tracking', $userid)";
	
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}

		
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);

				// add into order_item
				$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, price, commission, total, total_commission, order_item_status) 
				VALUES ('$order_id', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['priceValue'][$x]."', '".$_POST['commissionValue'][$x]."', '".$_POST['totalValue'][$x]."', '".$_POST['totalCommValue'][$x]."', 1)";

				$connect->query($orderItemSql);		

				if($x == count($_POST['productName'])) {
					$orderItemStatus = true;
				}		
		} // while	
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);