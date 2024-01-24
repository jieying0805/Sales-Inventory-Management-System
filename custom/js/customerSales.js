$(document).ready(function() {
	// manage product data table
	manageCustomerSalesTable = $('#manageCustomerSalesTable').DataTable({
		'ajax': 'php_action/fetchCustomerSalesData.php',
		'order': []
	});

	// Live search
	$('#generateReportBtn').click(function() {
		var startDate = $('#startDate').val();
		var endDate = $('#endDate').val();

		if (startDate !== '' && endDate !== '') {
			$.ajax({
				url: 'php_action/fetchCustomerSalesDataByDate.php',
				method: 'POST',
				data: {
					startDate: startDate,
					endDate: endDate
				},
				success: function(response) {
					$('#manageCustomerSalesTable').DataTable().destroy();
					$('#manageCustomerSalesTable tbody').html(response);
					$('#manageCustomerSalesTable').DataTable();
				}
			});
		} else {
			alert('Please select both start date and end date.');
		}
	});
});

$(document).ready(function() {
	// ...existing code...

	// Print report button click event
	$('#printReportBtn').on('click', function() {
		var printContents = $('#printTableWrapper').html();
		var originalContents = $('body').html();
		
		$('body').empty().html(printContents);
		
		window.print();
		
		$('body').html(originalContents);
	});
});

