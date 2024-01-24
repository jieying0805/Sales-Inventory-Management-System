<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$date = $_POST['date'];
  $amount = $_POST['amount']; 
  $agent = $_POST['agent']; 

	$sql = "INSERT INTO commission (date, amount, agent_id) 
	VALUES ('$date', '$amount', '$agent')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the commission payment record";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST