<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Commission</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-user"></i> Manage Commission</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addCommissionModalBtn" data-target="#addCommissionModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Commission </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageCommissionTable">
					<thead>
						<tr>
							<th>Commission Payment ID</th>							
							<th>Payment Date</th>
							<th>Amount</th>							
							<th>Payee (Agent Name)</th>		
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add Commission -->
<div class="modal fade" id="addCommissionModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitCommissionForm" action="php_action/createCommission.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Commission</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-commission-messages"></div>     	           	       

	        <div class="form-group">
	        	<label for="date" class="col-sm-3 control-label">Payment Date </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="date" placeholder="Payment Date" name="date" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	    

	        <div class="form-group">
	        	<label for="amount" class="col-sm-3 control-label">Amount (RM): </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="amount" placeholder="Payment Amount (RM)" name="amount" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->  	        

	        <div class="form-group">
	        	<label for="agent" class="col-sm-3 control-label">Payee (Agent Name): </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="agent" name="agent">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT * FROM agents";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while
								
				      	?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	  	    
        	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createCommissionBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editCommissionModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Commission Payment Record</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="edit-commission-messages"></div>


	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
	      	</div>

		      <div class="edit-commission-result">
     	           	       
				    
				    <!-- Commission image -->
				    <div role="tabpanel" class="tab-pane" id="commissionInfo">
				    	<form class="form-horizontal" id="editCommissionForm" action="php_action/editCommission.php" method="POST">				    
				    	<br />

				    	<div id="edit-commission-messages"></div>
						
				    	<div class="form-group">
			        	<label for="editDate" class="col-sm-3 control-label">Payment Date: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="date" class="form-control" id="editDate" placeholder="Payment Date" name="editDate" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	      

			        <div class="form-group">
			        	<label for="editAmount" class="col-sm-3 control-label">Payment Amount (RM): </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editAmount" placeholder="Payment Amount (RM)" name="editAmount" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->		        

			        <div class="form-group">
			        	<label for="editAgent" class="col-sm-3 control-label">Payee (Agent Name): </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="editAgent" name="editAgent">
						      	<option value="">~~SELECT~~</option>
						      	<?php 
						      	$sql = "SELECT * FROM agents";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} // while
										
						      	?>
						      </select>
						    </div>
			        </div> <!-- /form-group-->		     	 

			        <div class="modal-footer editCommissionFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				        
				        <button type="submit" class="btn btn-success" id="editCommissionBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				      </div> <!-- /modal-footer -->				     
			        </form> <!-- /.form -->				     	
				    </div>    
				    <!-- /Commission info -->
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
<div class="modal fade" tabindex="-1" role="dialog" id="removeCommissionModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Commission Payment Record</h4>
      </div>
      <div class="modal-body">

      	<div class="removeCommissionMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeCommissionFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCommissionBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/commission.js"></script>

<?php require_once 'includes/footer.php'; ?>