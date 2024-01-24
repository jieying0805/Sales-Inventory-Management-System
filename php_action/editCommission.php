<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$commissionId = $_POST['commissionId'];
	$paymentDate		= $_POST['editDate'];
  $amount				= $_POST['editAmount'];
  $agent				= $_POST['editAgent'];

				
	$sql = "UPDATE commission SET date = '$paymentDate', amount = '$amount', agent_id = '$agent' WHERE comm_payment_id = '$commissionId' ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating commission payment record";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
