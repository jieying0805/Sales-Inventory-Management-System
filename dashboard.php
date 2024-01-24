<?php require_once 'includes/header.php'; ?>

<?php 
$connect = mysqli_connect("localhost", "root", "", "la9");  

if ($_SESSION['typeId']==1) {
	$sql = "SELECT * FROM orders WHERE order_status='Pending'";
} elseif ($_SESSION['typeId']==2) {
	$userId = $_SESSION['userId'];
	$sql = "SELECT * FROM orders WHERE order_status='Pending' AND user_id=$userId";
}
$query = $connect->query($sql);
$countPending = $query->num_rows;

if ($_SESSION['typeId']==1) {
	$sql = "SELECT * FROM orders WHERE order_status='Processing'";
} elseif ($_SESSION['typeId']==2) {
	$userId = $_SESSION['userId'];
	$sql = "SELECT * FROM orders WHERE order_status='Processing' AND user_id=$userId";
}
$query = $connect->query($sql);
$countProcessing = $query->num_rows;

if ($_SESSION['typeId']==1) {
	$sql = "SELECT * FROM orders WHERE order_status='Shipped'";
} elseif ($_SESSION['typeId']==2) {
	$userId = $_SESSION['userId'];
	$sql = "SELECT * FROM orders WHERE order_status='Shipped' AND user_id=$userId";
}
$orderQuery = $connect->query($sql);
$countShipped = $orderQuery->num_rows;

if ($_SESSION['typeId']==1) {
	$sql = "SELECT * FROM orders WHERE order_status='Delivered'";
} elseif ($_SESSION['typeId']==2) {
	$userId = $_SESSION['userId'];
	$sql = "SELECT * FROM orders WHERE order_status='Delivered' AND user_id=$userId";
}
$orderQuery = $connect->query($sql);
$countDelivered = $orderQuery->num_rows;

$orderSql = "SELECT * FROM orders";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = 0;
while ($orderResult = $orderQuery->fetch_assoc()) {
	$totalRevenue += $orderResult['sub_total'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$notreceivedSql = "SELECT count(*) FROM inventory WHERE status='ordered'";
$notreceivedQuery = $connect->query($notreceivedSql);
$countnotreceived = $notreceivedQuery->num_rows;


if ($_SESSION['typeId']==1) {
	$tcommSql = "SELECT SUM(total_commission) AS total_commission FROM orders";
} elseif ($_SESSION['typeId']==2) {
	$userId = $_SESSION['userId'];
	$tcommSql = "SELECT SUM(total_commission) AS total_commission FROM orders WHERE user_id=$userId";
}
$tcommQuery = $connect->query($tcommSql);

if ($_SESSION['typeId']==1) {
	$tpaidSql = "SELECT SUM(amount) AS total_amount FROM commission";
} elseif ($_SESSION['typeId']==2) {
	$agentId = $_SESSION['agentId'];
	$tpaidSql = "SELECT SUM(amount) AS total_amount FROM commission WHERE agent_id=$agentId";
}
$tpaidQuery = $connect->query($tpaidSql);

if ($tcommQuery && $tpaidQuery) {
    $tcommRow = $tcommQuery->fetch_assoc();
    $tpaidRow = $tpaidQuery->fetch_assoc();

    $totalCommission = $tcommRow['total_commission'];
    $totalPaid = $tpaidRow['total_amount'];

    $unpaid = $totalCommission - $totalPaid;

    // Use the calculated $unpaid value as needed
} else {
    // Query execution failed
}

if ($_SESSION['typeId']==1) {
	$userwisesql = "SELECT users.username, SUM(orders.sub_total) as totalorder FROM orders INNER JOIN users ON orders.user_id = users.user_id GROUP BY orders.user_id";
} elseif ($_SESSION['typeId']==2) {
	$userId = $_SESSION['userId'];
	$userwisesql = "SELECT users.username, SUM(orders.sub_total) as totalorder FROM orders INNER JOIN users ON orders.user_id = users.user_id WHERE orders.user_id=$userId GROUP BY orders.user_id";
}
$userwiseQuery = $connect->query($userwisesql);
$userwieseOrder = $userwiseQuery->num_rows;

if ($_SESSION['typeId']==1) {
	$salessql = "SELECT sub_total, Year(order_date) AS yr, MonthName(order_date) AS mth FROM orders WHERE YEAR(order_date) = YEAR(CURDATE()) GROUP BY month(order_date) ORDER BY month(order_date)";
} elseif ($_SESSION['typeId']==2) {
	$userId = $_SESSION['userId'];
	$salessql = "SELECT sub_total, Year(order_date) AS yr, MonthName(order_date) AS mth FROM orders WHERE YEAR(order_date) = YEAR(CURDATE()) AND orders.user_id=$userId GROUP BY month(order_date) ORDER BY month(order_date)";
}
$salesperformance = mysqli_query($connect, $salessql);

$yearSql = "SELECT Year(order_date) AS yr FROM orders WHERE YEAR(order_date) = YEAR(CURDATE())";
$yearQuery = $connect->query($yearSql);
$row = $yearQuery->fetch_assoc();
$yr = $row['yr'];

$connect->close();

?>


<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
	<div class="col-md-3">
		<div class="panel panel-danger">
			<div class="panel-heading">
				
				<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
					Total Pending
					<span class="badge pull pull-right"><?php echo $countPending; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	<div class="col-md-3">
		<div class="panel panel-warning">
			<div class="panel-heading">
				
				<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
					Total Processing
					<span class="badge pull pull-right"><?php echo $countProcessing; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	<div class="col-md-3">
		<div class="panel panel-info">
			<div class="panel-heading">
				
				<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
					Total Shipped
					<span class="badge pull pull-right"><?php echo $countShipped; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	<div class="col-md-3">
		<div class="panel panel-success">
			<div class="panel-heading">
				
				<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
					Total Delivered
					<span class="badge pull pull-right"><?php echo $countDelivered; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
</div>	


<div class="row">
	<?php  if($_SESSION['typeId']==1) { ?>
	<div class="col-md-6">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="product.php" style="text-decoration:none;color:black;">
					Low Stock
					<span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->	
	
	<div class="col-md-6">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<a href="inventory.php" style="text-decoration:none;color:black;">
					Unreceived Purchase Orders
					<span class="badge pull pull-right"><?php echo $countnotreceived; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->	
</div>
	<?php } ?>
	
<div class="row">
	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader">
		    <h1><?php echo date('d'); ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p><?php echo date('l') .' '.date('d').', '.date('Y'); ?></p>
		  </div>
		</div> 
	</div>
	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php if($totalRevenue) {
		    	echo number_format($totalRevenue,2);
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> <?php if ($_SESSION['typeId']==1) { echo "Total Revenue (RM)"; } else { echo "My Sales (RM)"; } ?></p>
		  </div>
		</div> 
	</div>
	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php if($unpaid) {
		    	echo number_format($unpaid,2);
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> Total Commission Unpaid (RM)</p>
		  </div>
		</div> 
	</div>
</div>
<br><br>
<div class="row">	
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i>
				<?php
				if ($_SESSION['typeId'] == 1) {
					echo "Annual Sales in " . $yr . "";
				} else {
					echo "My Sales Performance in " . $yr . "";
				}
				?>
			</div>
			<div class="panel-body" id="sales">
			</div>	
		</div>
	</div> 
</div> <!--/row-->

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
			google.charts.load('current', {packages: ['corechart', 'line']});
			google.charts.setOnLoadCallback(drawBasic);

			function drawBasic() {

				  var data = google.visualization.arrayToDataTable([
					['Month', 'Total Sales'],  
                          <?php  
                          while($row = mysqli_fetch_array($salesperformance))  
                          {  
                               echo "['".$row["mth"]."', ".$row["sub_total"]."],";  
                          }  
                          ?>  
				  ]);

				  var options = {
					title: '',
					chartArea: {width: '50%'},
					hAxis: {
					  title: 'Month',
					  minValue: 0
					},
					vAxis: {
					  title: 'Total Sales'
					}
				  };

				  var chart = new google.visualization.LineChart(document.getElementById('sales'));

				  chart.draw(data, options);
				}
			</script>

<?php require_once 'includes/footer.php'; ?>