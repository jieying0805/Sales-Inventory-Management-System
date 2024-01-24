<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Inventory Logs</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Inventory Logs</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addInventoryModalBtn" data-target="#addInventoryModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Inventory </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageInventoryTable">
					<thead>
						<tr>
							<th>Purchase ID</th>							
							<th>Puchase Date</th>							
							<th>Product</th>
							<th>Status</th>							
							<th>Qty Ordered</th>
							<th>Qty Received</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add Inventory -->
<div class="modal fade" id="addInventoryModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitInventoryForm" action="php_action/createInventory.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Inventory Logs</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-inventory-messages"></div>     	           	       

	        <div class="form-group">
	        	<label for="date" class="col-sm-3 control-label">Purchase Date: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="date" placeholder="Purchase Date" name="date" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	    

	        <div class="form-group">
	        	<label for="product" class="col-sm-3 control-label">Product: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="product" name="product">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT * FROM product";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while
								
				      	?>
				      </select>
					</div>
	        </div> <!-- /form-group-->        	 

	        <div class="form-group">
	        	<label for="status" class="col-sm-3 control-label">Status: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
					<select class="form-control" id="status" name="status">
				      	<option value="">~~SELECT~~</option>
						<option value="ordered">Ordered</option>
						<option value="received">Received</option>
					</select>
					</div>
	        </div> <!-- /form-group--> 
	        <div class="form-group">
	        	<label for="qtyOrdered" class="col-sm-3 control-label">Qty Ordered: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="qtyOrdered" placeholder="Qty Ordered" name="qtyOrdered" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	
	        <div class="form-group">
	        	<label for="qtyReceived" class="col-sm-3 control-label">Qty Received: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="qtyReceived" placeholder="Qty Received" name="qtyReceived" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	    	        
        	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createInventoryBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editInventoryModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Inventory Logs</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="edit-inventory-messages"></div>


		      <div class="edit-inventory-result">
     	           	       
				    
				    <!-- Inventory image -->
				    <div role="tabpanel" class="tab-pane" id="inventoryInfo">
				    	<form class="form-horizontal" id="editInventoryForm" action="php_action/editInventory.php" method="POST">				    
				    	<br />

				    	<div id="edit-inventory-messages"></div>

				    	<div class="form-group">
			        	<label for="editDate" class="col-sm-3 control-label">Purchase Date: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="date" class="form-control" id="editDate" placeholder="Purchase Date" name="editDate" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	   

			        <div class="form-group">
			        	<label for="editProduct" class="col-sm-3 control-label">Product: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
							  <select class="form-control" id="editProduct" name="editProduct">
								<option value="">~~SELECT~~</option>
								<?php 
								$sql = "SELECT * FROM product";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} // while
										
								?>
							  </select>
							</div>
			        </div> <!-- /form-group-->	   

			        <div class="form-group">
			        	<label for="editStatus" class="col-sm-3 control-label">Status: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
								<select class="form-control" id="editStatus" name="editStatus">
									<option value="">~~SELECT~~</option>
									<option value="ordered">Ordered</option>
									<option value="received">Received</option>
								</select>
						    </div>
			        </div> <!-- /form-group-->	        	 

			        <div class="form-group">
			        	<label for="editQtyOrdered" class="col-sm-3 control-label">Qty Ordered: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editQtyOrdered" placeholder="Qty Ordered" name="editQtyOrdered" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->		    	 

			        <div class="form-group">
			        	<label for="editQtyReceived" class="col-sm-3 control-label">Qty Received: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editQtyReceived" placeholder="Qty Received" name="editQtyReceived" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->		

			        <div class="modal-footer editInventoryFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				        
				        <button type="submit" class="btn btn-success" id="editInventoryBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				      </div> <!-- /modal-footer -->				     
			        </form> <!-- /.form -->				     	
				    </div>    
				    <!-- /Inventory info -->
				  </div>

				</div>
	      	
	      </div> <!-- /modal-body -->
	      	      
     	
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeInventoryModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Inventory</h4>
      </div>
      <div class="modal-body">

      	<div class="removeInventoryMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeInventoryFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeInventoryBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/inventory.js"></script>

<?php require_once 'includes/footer.php'; ?>