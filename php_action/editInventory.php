<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$inventoryId = $_POST['inventoryId'];
	$date = $_POST['editDate'];
  $product = $_POST['editProduct']; 
  $status = $_POST['editStatus'];
  $qtyOrdered = $_POST['editQtyOrdered'];
  $qtyReceived = $_POST['editQtyReceived'];

	$sql = "UPDATE inventory SET date = '$date', product_id = '$product', status = '$status', qty_ordered = '$qtyOrdered', qty_received = '$qtyReceived' WHERE po_id = '$inventoryId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the inventory logs";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST