<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$customerId = $_POST['customerId'];
	$customerName 		= $_POST['editCustomerName']; 
	$customerPhone 		= $_POST['editCustomerPhone'];
	$customerAddress 		= $_POST['editCustomerAddress'];

				
	$sql = "UPDATE customers SET cust_name = '$customerName', cust_phone = '$customerPhone', cust_address = '$customerAddress' WHERE cust_id = $customerId ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating customer info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
