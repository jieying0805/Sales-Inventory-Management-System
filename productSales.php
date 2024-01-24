<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Product Sales Report</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i>	Product Sales Report
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				<div class="form-group">
					<div class="col-md-4">
						<label for="startDate" class="col-sm-2 control-label">Start Date</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="endDate" class="col-sm-2 control-label">End Date</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
						</div>
					</div>
					<div class="col-md-4">
						<div class="col-md-6">
							<button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-primary" id="printReportBtn"><i class="glyphicon glyphicon-print"></i> Print Report</button>
						</div>
					</div>
				</div>
				<div>
					<div id="searchResult"></div>
				</div>
			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Product Sales Report</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>		
				<div id="printTableWrapper">	
				<table id="manageProductSalesTable" class="table table-striped">
					<thead>
						<tr>
							<th>Product ID</th>
							<th>Product Name</th>
							<th>Unit Cost</th>
							<th>Price</th>
							<th>Quantity Sold</th>
							<th>Total Sales</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<!-- /table -->
				</div>
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<script src="custom/js/productSales.js"></script>

<?php require_once 'includes/footer.php'; ?>