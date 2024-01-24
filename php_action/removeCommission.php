<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$commissionId = $_POST['commissionId'];

if($commissionId) { 

 $sql = "DELETE FROM commission WHERE comm_payment_id = {$commissionId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the commission payment record";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST