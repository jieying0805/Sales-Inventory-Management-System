<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

  $agentName = $_POST['agentName'];
  $agentPhone = $_POST['agentPhone'];
  $agentEmail = $_POST['agentEmail'];
  $username = $_POST['username'];

	$sql = "INSERT INTO agents (agent_name, agent_phone, agent_email, user_id) 
			VALUES ('$agentName','$agentPhone', '$agentEmail', '$username')";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the agents";
				}

			}	else {
				return false;
			}	// /else	
		 // if
	 // if in_array 		

	$connect->close();

	echo json_encode($valid);
