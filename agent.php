<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Agent</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-user"></i> Manage Agent</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addAgentModalBtn" data-target="#addAgentModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Agent </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageAgentTable">
					<thead>
						<tr>
							<th>ID</th>							
							<th>Agent Name</th>
							<th>Phone</th>							
							<th>Email</th>
							<th>Username</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add Agent -->
<div class="modal fade" id="addAgentModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitAgentForm" action="php_action/createAgent.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Agent</h4>
	      </div>

	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-agent-messages"></div>     	           	       

	        <div class="form-group">
	        	<label for="agentName" class="col-sm-3 control-label">Agent Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="agentName" placeholder="Agent Name" name="agentName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	    

	        <div class="form-group">
	        	<label for="agentPhone" class="col-sm-3 control-label">Phone Number: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="agentPhone" placeholder="Phone Number" name="agentPhone" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->        	 

	        <div class="form-group">
	        	<label for="agentEmail" class="col-sm-3 control-label">Email: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="agentEmail" placeholder="Email" name="agentEmail" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->     	        

	        <div class="form-group">
	        	<label for="username" class="col-sm-3 control-label">Username: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="username" name="username">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT * FROM users";
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
	        
	        <button type="submit" class="btn btn-primary" id="createAgentBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editAgentModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Agent</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="edit-agent-messages"></div>


	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
	      	</div>

		      <div class="edit-agent-result">
     	           	       
				    
				    <!-- Agent image -->
				    <div role="tabpanel" class="tab-pane" id="agentInfo">
				    	<form class="form-horizontal" id="editAgentForm" action="php_action/editAgent.php" method="POST">				    
				    	<br />

				    	<div id="edit-agent-messages"></div>

				    	<div class="form-group">
			        	<label for="editAgentName" class="col-sm-3 control-label">Agent Name: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editAgentName" placeholder="Agent Name" name="editAgentName" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	    

			        <div class="form-group">
			        	<label for="editAgentPhone" class="col-sm-3 control-label">Phone Number: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editAgentPhone" placeholder="Phone Number" name="editAgentPhone" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->	        	 

			        <div class="form-group">
			        	<label for="editAgentEmail" class="col-sm-3 control-label">Email: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editAgentEmail" placeholder="Email" name="editAgentEmail" autocomplete="off">
						    </div>
			        </div> <!-- /form-group-->		     	        

			        <div class="form-group">
			        	<label for="editUsername" class="col-sm-3 control-label">Username: </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <select class="form-control" id="editUsername" name="editUsername">
						      	<option value="">~~SELECT~~</option>
						      	<?php 
						      	$sql = "SELECT * FROM users";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} // while
										
						      	?>
						      </select>
						    </div>
			        </div> <!-- /form-group-->	

			        <div class="modal-footer editAgentFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				        
				        <button type="submit" class="btn btn-success" id="editAgentBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				      </div> <!-- /modal-footer -->				     
			        </form> <!-- /.form -->				     	
				    </div>    
				    <!-- /Agent info -->
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
<div class="modal fade" tabindex="-1" role="dialog" id="removeAgentModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Agent</h4>
      </div>
      <div class="modal-body">

      	<div class="removeAgentMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeAgentFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeAgentBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->


<script src="custom/js/agent.js"></script>

<?php require_once 'includes/footer.php'; ?>