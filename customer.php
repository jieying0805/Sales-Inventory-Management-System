<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Customer</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-user"></i> Manage Customer</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addCustomerModalBtn" data-target="#addCustomerModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Customer </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageCustomerTable">
					<thead>
						<tr>
							<th>ID</th>							
							<th>Customer Name</th>
							<th>Phone</th>							
							<th>Address</th>							
							<th>Agent</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add Customer -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitCustomerForm" action="php_action/createCustomer.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Customer</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-customer-messages"></div>     	           	       

	        <div class="form-group">
	        	<label for="customerName" class="col-sm-3 control-label">Customer Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="customerName" placeholder="Customer Name" name="customerName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	    

	        <div class="form-group">
	        	<label for="customerPhone" class="col-sm-3 control-label">Phone Number: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="customerPhone" placeholder="Phone Number" name="customerPhone" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->        	 

	        <div class="form-group">
	        	<label for="customerAddress" class="col-sm-3 control-label">Address: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="textarea" class="form-control" id="customerAddress" placeholder="Address" name="customerAddress" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->     	    
        	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createCustomerBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Customer</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="edit-customer-messages"></div>


	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
	      	</div>

		      <div class="edit-customer-result">
     	           	       
				    
				    <!-- Customer image -->
				    <div role="tabpanel" class="tab-pane" id="customerInfo">
				    	<form class="form-horizontal" id="editCustomerForm" action="php_action/editCustomer.php" method="POST">				    
				    	<br />

				    	<div id="edit-customer-messages"></div>

				    	<div class="form-group">
			        	<label for="editCustomerName" class="col-sm-3 control-label">Customer Name: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editCustomerName" placeholder="Customer Name" name="editCustomerName" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	    

			        <div class="form-group">
			        	<label for="editCustomerPhone" class="col-sm-3 control-label">Phone Number: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editCustomerPhone" placeholder="Phone Number" name="editCustomerPhone" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	        	 

			        <div class="form-group">
			        	<label for="editCustomerAddress" class="col-sm-3 control-label">Address: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editCustomerAddress" placeholder="Address" name="editCustomerAddress" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->		     	 

			        <div class="modal-footer editCustomerFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				        
				        <button type="submit" class="btn btn-success" id="editCustomerBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				      </div> <!-- /modal-footer -->				     
			        </form> <!-- /.form -->				     	
				    </div>    
				    <!-- /Customer info -->
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
<div class="modal fade" tabindex="-1" role="dialog" id="removeCustomerModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Customer</h4>
      </div>
      <div class="modal-body">

      	<div class="removeCustomerMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeCustomerFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCustomerBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/customer.js"></script>

<?php require_once 'includes/footer.php'; ?>