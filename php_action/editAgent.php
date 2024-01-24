<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$agentId = $_POST['agentId'];
	$agentName 		= $_POST['editAgentName'];
  $agentPhone				= $_POST['editAgentPhone'];
  $agentEmail				= $_POST['editAgentEmail'];
  $userId 	= $_POST['editUsername'];

				
	$sql = "UPDATE agents SET agent_name = '$agentName', agent_phone = '$agentPhone', agent_email = '$agentEmail', user_id = '$userId' WHERE agent_id = $agentId ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
