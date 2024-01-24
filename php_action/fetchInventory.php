<?php 	

require_once 'core.php';

$sql = "SELECT * FROM inventory INNER JOIN product ON inventory.product_id=product.product_id";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 


 while($row = $result->fetch_array()) {
	 
	if($row[3] == "ordered") { 		
 		$status = "<label class='label label-info'>Ordered</label>";
 	} else if($row[3] == "received") { 		
 		$status = "<label class='label label-success'>Received</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
		<li><a type="button" data-toggle="modal" id="editInventoryModalBtn" data-target="#editInventoryModal" onclick="editInventory('.$row[0].')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
		<li><a type="button" data-toggle="modal" data-target="#removeInventoryModal" id="removeInventoryModalBtn" onclick="removeInventory('.$row[0].')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
  </div>';

 	$output['data'][] = array( 		
 		$row[0], 	
 		$row[1], 
 		$row[7], 
 		$status,
 		$row[4],  
 		$row[5], 	
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);