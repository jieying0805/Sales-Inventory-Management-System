<?php 	

require_once 'core.php';

$commissionId = $_POST['commissionId'];

$sql = "SELECT * FROM commission WHERE comm_payment_id = $commissionId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);