<?php 	

require_once 'core.php';

$agentId = $_POST['agentId'];

$sql = "SELECT * FROM agents INNER JOIN users ON agents.user_id=users.user_id WHERE agent_id = $agentId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);