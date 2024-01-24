<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$productId = $_POST['productId'];
	$productName 		= $_POST['editProductName'];
  $cost					= $_POST['editCost'];
  $price					= $_POST['editPrice'];
  $commission				= $_POST['editCommission']; 
  $quantity 			= $_POST['editQuantity'];
  $categoryName 	= $_POST['editCategoryName'];

				
	$sql = "UPDATE product SET product_name = '$productName', unit_cost = '$cost', price = '$price', commission = '$commission', quantity = '$quantity', categories_id = '$categoryName' WHERE product_id = $productId ";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
