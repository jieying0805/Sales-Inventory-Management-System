<?php 	

require_once 'core.php';

if ($_SESSION['typeId'] == 2) {
    $userId = $_SESSION['userId']; // Store the session variable in a separate variable
    $sql = "SELECT * FROM orders INNER JOIN customers ON orders.cust_id=customers.cust_id WHERE orders.user_id=$userId";
} elseif ($_SESSION['typeId'] == 1) {
    $sql = "SELECT * FROM orders INNER JOIN customers ON orders.cust_id=customers.cust_id";
}

$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 
 $paymentStatus = ""; 
 $x = 1;

 while($row = $result->fetch_array()) {
 	$orderId = $row[0];

 	$countOrderItemSql = "SELECT count(*) FROM order_item WHERE order_id = $orderId";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();


 	// active 
 	if($row[9] == "Pending") { 		
 		$orderStatus = "<label class='label label-danger'>Pending</label>";
 	} else if($row[9] == "Processing") { 		
 		$orderStatus = "<label class='label label-warning'>Processing</label>";
 	} else if($row[9] == "Shipped") { 		
 		$orderStatus = "<label class='label label-info'>Shipped</label>";
 	} else if($row[9] == "Delivered") { 		
 		$orderStatus = "<label class='label label-success'>Delivered</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="orders.php?o=editOrd&i='.$orderId.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>

	    <li><a href="orders.php?o=printOrd&i='.$orderId.'" id="printOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Print</a></li>
	    
	    <li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';		

 	$output['data'][] = array( 
 		$row[0],
 		// order date
 		$row[1],
 		$row[13], 	
 		$itemCountRow, 
 		$row[3],
		$row[4],
		$row[5], 
		round($row[6],2),
		$orderStatus, 		
		$row[10], 
 		// button
 		$button 		
 		); 	
 	$x++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);