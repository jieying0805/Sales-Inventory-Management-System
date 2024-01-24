<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$customerName = $_POST['customerName'];
  // $productImage 	= $_POST['productImage'];
  $customerPhone = $_POST['customerPhone'];
  $customerAddress = $_POST['customerAddress'];
  if ($_SESSION['typeId']==1) {
	  $agentName = 0;
  } elseif ($_SESSION['typeId']==2) {
	  $agentName = $_SESSION['agentId'];
  }

	$sql = "INSERT INTO customers (cust_name, cust_phone, cust_address, agent_id) 
			VALUES ('$customerName','$customerPhone', '$customerAddress', '$agentName')";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}

			}	else {
				return false;
			}	// /else	
		 // if
	 // if in_array 		

	$connect->close();

	echo json_encode($valid);
