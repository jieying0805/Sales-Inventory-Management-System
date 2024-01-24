<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$customerId = $_POST['customerId'];

if($customerId) { 

 $sql = "DELETE FROM customers WHERE cust_id = {$customerId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the customer";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST