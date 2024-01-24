<?php 	

require_once 'core.php';

$inventoryId = $_POST['inventoryId'];

$sql = "SELECT * FROM inventory WHERE po_id = $inventoryId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);