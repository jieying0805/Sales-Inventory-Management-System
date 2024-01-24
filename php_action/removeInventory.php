<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$inventoryId = $_POST['inventoryId'];

if($inventoryId) { 

 $sql = "DELETE FROM inventory WHERE po_id = {$inventoryId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the inventory logs";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST