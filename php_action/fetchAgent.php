<?php 	



require_once 'core.php';

$sql = "SELECT * FROM agents 
		INNER JOIN users on agents.user_id=users.user_id";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$agentId = $row[0];

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editAgentModalBtn" data-target="#editAgentModal" onclick="editAgent('.$agentId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeAgentModal" id="removeAgentModalBtn" onclick="removeAgent('.$agentId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }

 	$output['data'][] = array( 
 		$row[0], 
 		$row[1],
 		$row[2], 	
 		$row[3],	
 		$row[6],
 		$button		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);