<?php 	

require_once 'core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT * FROM orders WHERE order_id = $orderId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);