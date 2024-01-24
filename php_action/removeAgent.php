<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$agentId = $_POST['agentId'];

if($agentId) { 

 $sql = "DELETE FROM agents WHERE agent_id = {$agentId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the agent";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST