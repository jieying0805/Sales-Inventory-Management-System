<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

if($_GET['o'] == 'add') { 
// add order
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} else if($_GET['o'] == 'printOrd') { 
	echo "<div class='div-request div-hide'>printOrd</div>";
} // /else manage order


?>

<ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li>Order</li>
  <li class="active">
  	<?php if($_GET['o'] == 'add') { ?>
  		Add Order
		<?php } else if($_GET['o'] == 'manord') { ?>
			Manage Order
		<?php } // /else manage order ?>
  </li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "Add Order";
	} else if($_GET['o'] == 'manord') { 
		echo "Manage Order";
	} else if($_GET['o'] == 'editOrd') { 
		echo "Edit Order";
	}
	?>	
</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="glyphicon glyphicon-plus-sign"></i>	Add Order
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="glyphicon glyphicon-edit"></i> Manage Order
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="glyphicon glyphicon-edit"></i> Edit Order
		<?php } else if($_GET['o'] == 'printOrd') { ?>
			<i class="glyphicon glyphicon-edit"></i> Print Order
		<?php } ?>

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			// add order
			?>			

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="customerName" class="col-sm-2 control-label">Customer Name</label>
			    <div class="col-sm-10">				
					<select class="form-control" id="customerName" name="customerName" onchange="getCustomerData()" >
						<option value="">~~SELECT~~</option>
						<?php
						if ($_SESSION['typeId']==1) {
							$productSql = "SELECT * FROM customers";
						} elseif ($_SESSION['typeId']==2) {
							$agentId = $_SESSION['agentId'];
							$productSql = "SELECT * FROM customers WHERE agent_id=$agentId";
						}
						$productData = $connect->query($productSql);

						while($row = $productData->fetch_array()) {									 		
						echo "<option value='".$row['cust_id']."'>".$row['cust_name']."</option>";
						} // /while 

						?>
					</select>
			    </div>				
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="customerPhone" class="col-sm-2 control-label">Phone Number</label>
			    <div class="col-sm-10">
			  		<input type="text" id="customerPhone" autocomplete="off" disabled="true" class="form-control" />	  					
			    </div>
			  </div> <!--/form-group-->	
			  <div class="form-group">
			    <label for="customerAddress" class="col-sm-2 control-label">Address</label>
			    <div class="col-sm-10">
			  		<input type="text" id="customerAddress" autocomplete="off" disabled="true" class="form-control" />	  					
			    </div>
			  </div> <!--/form-group-->				  

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:30%;">Product</th>
			  			<th style="width:15%;">Price</th>						
			  			<th style="width:15%;">Commission</th>
			  			<th style="width:10%;">Available Quantity</th>
			  			<th style="width:10%;">Quantity</th>			  			
			  			<th style="width:30%;">Total Amount</th>				  			
			  			<th style="width:30%;">Total Commission</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 2; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:10px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="price[]" id="price<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="priceValue[]" id="priceValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>							
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="commission[]" id="commission<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="commissionValue[]" id="commissionValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
							<td style="padding-left:10px;">
			  					<div class="form-group">
									<p id="available_quantity<?php echo $x; ?>"></p>
			  					</div>
			  				</td>
			  				<td style="padding-left:10px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="totalComm[]" id="totalComm<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalCommValue[]" id="totalCommValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="shipping" class="col-sm-3 control-label">Shipping</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="shipping" name="shipping" disabled="true" />
				      <input type="hidden" class="form-control" id="shippingValue" name="shippingValue" />
				    </div>
				  </div> <!--/form-group-->	
				   <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Commission</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotalComm" name="subTotalComm" disabled="true"/>
				      <input type="hidden" class="form-control" id="subTotalCommValue" name="subTotalCommValue" />
				    </div>
				  </div> <!--/form-group-->			  	  		  			  	  		  
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">	
			  	<div class="form-group">
				    <label for="paymentType" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paymentType" name="paymentType" autocomplete="off" placeholder="e.g. Bank Islam" />
				    </div>
				  </div> <!--/form-group-->							  
			  	<div class="form-group">
				    <label for="paymentRef" class="col-sm-3 control-label">Payment Ref. No.</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paymentRef" name="paymentRef" autocomplete="off" />
				    </div>
				  </div> <!--/form-group-->		
			  	<div class="form-group">
				    <label for="orderStatus" class="col-sm-3 control-label">Order Status</label>
				    <div class="col-sm-9">
			  					<select class="form-control" name="orderStatus" id="orderStatus" >
			  						<option value="">~~SELECT~~</option>
									<option value="Pending" selected >Pending Payment</option>
									<option value="Processing">Processing</option>
									<option value="Shipped">Shipped</option>
									<option value="Delivered">Delivered</option>
		  						</select>				    
					</div>
				  </div> <!--/form-group-->					  	
				  <div class="form-group">
				    <label for="tracking" class="col-sm-3 control-label">Tracking Number</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="tracking" name="tracking" autocomplete="off" />
				    </div>
				  </div> <!--/form-group-->						  
			  </div> <!--/col-md-6-->


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

			      <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
			    </div>
			  </div>
			</form>
		<?php } else if($_GET['o'] == 'manord') { 
			// manage order
			?>

			<div id="success-messages"></div>
			
			<table class="table" id="manageOrderTable">
				<thead>
					<tr>
						<th>Order ID</th>
						<th>Order Date</th>
						<th>Customer Name</th>
						<th>Total Order Item</th>
						<th>Sub Total</th>
						<th>Shipping</th>
						<th>Net Total</th>
						<th>Total Commission</th>
						<th>Order Status</th>
						<th>Tracking No</th>
						<th>Option</th>
					</tr>
				</thead>
			</table>

		<?php 
		// /else manage order
		} else if($_GET['o'] == 'editOrd') {
			// get order
			?>
			
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderForm">

  			<?php $orderId = $_GET['i'];

  			$sql = "SELECT * FROM orders JOIN customers ON orders.cust_id=customers.cust_id WHERE orders.order_id = {$orderId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();
  			?>

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" value="<?php echo $data[1] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="customerName" class="col-sm-2 control-label">Customer Name</label>
			    <div class="col-sm-10">				
			  					<select class="form-control" id="customerName" name="customerName" onchange="getCustomerData()" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$custSql = "SELECT * FROM customers";
			  							$custData = $connect->query($custSql);

			  							while($row = $custData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['cust_id'] == $data[2]) {
			  									$selected = "selected";
			  								} else {
			  									$selected = "";
			  								}

			  								echo "<option value='".$row['cust_id']."' ".$selected." >".$row['cust_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			    </div>				
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="customerPhone" class="col-sm-2 control-label">Phone Number</label>
			    <div class="col-sm-10">
			  		<input type="text" id="customerPhone" autocomplete="off" disabled="true" class="form-control" value="<?php echo $data[14] ?>"/>	  					
			    </div>
			  </div> <!--/form-group-->	
			  <div class="form-group">
			    <label for="customerAddress" class="col-sm-2 control-label">Address</label>
			    <div class="col-sm-10">
			  		<input type="text" id="customerAddress" autocomplete="off" disabled="true" class="form-control" value="<?php echo $data[15] ?>"/>	  					
			    </div>
			  </div> <!--/form-group-->				  

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:30%;">Product</th>
			  			<th style="width:15%;">Price</th>						
			  			<th style="width:15%;">Commission</th>
			  			<th style="width:10%;">Available Quantity</th>
			  			<th style="width:10%;">Quantity</th>			  			
			  			<th style="width:30%;">Total Amount</th>				  			
			  			<th style="width:30%;">Total Commission</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$orderItemSql = "SELECT * FROM order_item WHERE order_item.order_id = {$orderId}";
						$orderItemResult = $connect->query($orderItemSql);
						// $orderItemData = $orderItemResult->fetch_all();						
						
						// print_r($orderItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($orderItemData); $x++) {
			  		$x = 1;
			  		while($orderItemData = $orderItemResult->fetch_array()) { 
			  			// print_r($orderItemData); ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:10px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $orderItemData['product_id']) {
			  									$selected = "selected";
			  								} else {
			  									$selected = "";
			  								}

			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="price[]" id="price<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="<?php echo $orderItemData['price']; ?>" />			  					
			  					<input type="hidden" name="priceValue[]" id="priceValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['price']; ?>" />			  					
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="commission[]" id="commission<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="<?php echo $orderItemData['commission']; ?>" />			  					
			  					<input type="hidden" name="commissionValue[]" id="commissionValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['commission']; ?>" />			  					
			  				</td>							
							<td style="padding-left:10px;">
			  					<div class="form-group">
									<?php
			  							$productSql = "SELECT * FROM product";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $orderItemData['product_id']) { 
			  									echo "<p id='available_quantity".$row['product_id']."'>".$row['quantity']."</p>";
											}
			  								 else {
			  									$selected = "";
			  								}

			  								//echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
										 	} // /while 

			  						?>
									
			  					</div>
			  				</td>
			  				<td style="padding-left:10px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['quantity']; ?>" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="totalComm[]" id="totalComm<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $orderItemData['total_commission']; ?>"/>			  					
			  					<input type="hidden" name="totalCommValue[]" id="totalCommValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['total_commission']; ?>"/>			  					
			  				</td>
							
							<td>
			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true"  value="<?php echo $data[3] ?>"/>
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="<?php echo $data[3] ?>"/>
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="shipping" class="col-sm-3 control-label">Shipping</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="shipping" name="shipping" disabled="true" value="<?php echo $data[4] ?>" />
				      <input type="hidden" class="form-control" id="shippingValue" name="shippingValue" value="<?php echo $data[4] ?>" />
				    </div>
				  </div> <!--/form-group-->	
				   <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="<?php echo $data[5] ?>" />
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" value="<?php echo $data[5] ?>" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Commission</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotalComm" name="subTotalComm" disabled="true" value="<?php echo $data[6] ?>" />
				      <input type="hidden" class="form-control" id="subTotalCommValue" name="subTotalCommValue" value="<?php echo $data[6] ?>" />
				    </div>
				  </div> <!--/form-group-->			  	  		  			  	  		  
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">	
			  	<div class="form-group">
				    <label for="paymentType" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paymentType" name="paymentType" autocomplete="off" placeholder="e.g. Bank Islam" value="<?php echo $data[7] ?>" />
				    </div>
				  </div> <!--/form-group-->							  
			  	<div class="form-group">
				    <label for="paymentRef" class="col-sm-3 control-label">Payment Ref. No.</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paymentRef" name="paymentRef" autocomplete="off" value="<?php echo $data[8] ?>" />
				    </div>
				  </div> <!--/form-group-->		
			  	<div class="form-group">
				    <label for="orderStatus" class="col-sm-3 control-label">Order Status</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="orderStatus" id="orderStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="Pending" <?php if($data[9] == "Pending") {
				      		echo "selected";
				      	} ?>  >Pending</option>
				      	<option value="Processing" <?php if($data[9] == "Processing") {
				      		echo "selected";
				      	} ?> >Processing</option>
				      	<option value="Shipped" <?php if($data[9] == "Shipped") {
				      		echo "selected";
				      	} ?> >Shipped</option>
				      	<option value="Delivered" <?php if($data[9] == "Delivered") {
				      		echo "selected";
				      	} ?> >Delivered</option>						
				      </select>				    
					</div>
				  </div> <!--/form-group-->					  	
				  <div class="form-group">
				    <label for="tracking" class="col-sm-3 control-label">Tracking Number</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="tracking" name="tracking" autocomplete="off" value="<?php echo $data[10] ?>" />
				    </div>
				  </div> <!--/form-group-->						  
			  </div> <!--/col-md-6-->

			  <div class="form-group editButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

			    <input type="hidden" name="orderId" id="orderId" value="<?php echo $_GET['i']; ?>" />

			    <button type="submit" id="editOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			      
			    </div>
			  </div>
			</form>
			
			<?php 
		// /else manage order
		} else if($_GET['o'] == 'printOrd') {
			// get order
			?>
			
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST">		
				<div id="printTableWrapper">

  			<?php $orderId = $_GET['i'];

  			$sql = "SELECT * FROM orders JOIN customers ON orders.cust_id=customers.cust_id WHERE orders.order_id = {$orderId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();
  			?>

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <?php echo $data[1] ?>
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="customerName" class="col-sm-2 control-label">Customer Name:</label>
			    <div class="col-sm-10">				
			  		<?php echo $data[13] ?>
			    </div>				
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="customerPhone" class="col-sm-2 control-label">Phone Number:</label>
			    <div class="col-sm-10">
			  		<?php echo $data[14] ?>				
			    </div>
			  </div> <!--/form-group-->	
			  <div class="form-group">
			    <label for="customerAddress" class="col-sm-2 control-label">Address:</label>
			    <div class="col-sm-10">
			  		<?php echo $data[15] ?> 					
			    </div>
			  </div> <!--/form-group-->				  

			  <table id="productTable" class="table table-striped dataTable no-footer">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:30%;">Product</th>
			  			<th style="width:10%;">Price</th>						
			  			<th style="width:10%;">Commission</th>
			  			<th style="width:10%;">Quantity</th>			  			
			  			<th style="width:10%;">Total Amount</th>				  			
			  			<th style="width:10%;">Total Commission</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$orderItemSql = "SELECT * FROM order_item INNER JOIN product ON order_item.product_id=product.product_id WHERE order_item.order_id = {$orderId}";
						$orderItemResult = $connect->query($orderItemSql);
						// $orderItemData = $orderItemResult->fetch_all();						
						
						// print_r($orderItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($orderItemData); $x++) {
			  		$x = 1;
			  		while($orderItemData = $orderItemResult->fetch_array()) { 
			  			// print_r($orderItemData); ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:10px;">
			  					<?php echo $orderItemData['product_name']; ?>	
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<?php echo $orderItemData['price']; ?>	  								  					
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<?php echo $orderItemData['commission']; ?>	
			  				</td>			
			  				<td style="padding-left:10px;">
			  					<div class="form-group">
			  					<?php echo $orderItemData['quantity']; ?>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<?php echo $orderItemData['total']; ?>	  					
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<?php echo $orderItemData['total_commission']; ?>				  					
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>
			  <br><br>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount:</label>
				    <div class="col-sm-9">
				      <?php echo $data[3] ?>
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="shipping" class="col-sm-3 control-label">Shipping:</label>
				    <div class="col-sm-9">
				      <?php echo $data[4] ?>
				    </div>
				  </div> <!--/form-group-->	
				   <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount:</label>
				    <div class="col-sm-9">
				      <?php echo $data[5] ?>
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Commission:</label>
				    <div class="col-sm-9">
				      <?php echo $data[6] ?>
				    </div>
				  </div> <!--/form-group-->			  	  		  			  	  		  
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">	
			  	<div class="form-group">
				    <label for="paymentType" class="col-sm-3 control-label">Payment Type:</label>
				    <div class="col-sm-9">
				      <?php echo $data[7] ?>
				    </div>
				  </div> <!--/form-group-->							  
			  	<div class="form-group">
				    <label for="paymentRef" class="col-sm-3 control-label">Payment Ref. No.:</label>
				    <div class="col-sm-9">
				      <?php echo $data[8] ?>
				    </div>
				  </div> <!--/form-group-->		
			  	<div class="form-group">
				    <label for="orderStatus" class="col-sm-3 control-label">Order Status:</label>
				    <div class="col-sm-9">
				      <?php echo $data[9] ?>		    
					</div>
				  </div> <!--/form-group-->					  	
				  <div class="form-group">
				    <label for="tracking" class="col-sm-3 control-label">Tracking Number:</label>
				    <div class="col-sm-9">
				      <?php echo $data[10] ?>
				    </div>
				  </div> <!--/form-group-->						  
			  </div> <!--/col-md-6-->

			  <div class="form-group printButtonFooter">
			    <input type="hidden" name="orderId" id="orderId" value="<?php echo $_GET['i']; ?>" />
				<label for="printOrderBtn" class="col-sm-1 control-label"></label>
			    <button type="submit" id="printOrderBtn" data-loading-text="Loading..." class="btn btn-success"></i>Print Order Details</button>
			  </div>
			</form>

			<?php
		} // /get order else  ?>

		</div>
	</div> <!--/panel-->	
</div> <!--/panel-->	

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Order</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->


<script>
  function printOrderDetails() {
    // Hide the print button
    document.getElementById("printOrderBtn").style.display = "none";
    // Print the order details
    window.print();
    // Show the print button again after printing is done
    document.getElementById("printOrderBtn").style.display = "block";
  }
</script>
<script src="custom/js/orders.js"></script>

<?php require_once 'includes/footer.php'; ?>


	