$(document).ready(function() {
	// manage product data table
	manageProductSalesTable = $('#manageProductSalesTable').DataTable({
		'ajax': 'php_action/fetchProductSalesData.php',
		'order': []
	});

	// Live search
	$('#generateReportBtn').click(function() {
		var startDate = $('#startDate').val();
		var endDate = $('#endDate').val();

		if (startDate !== '' && endDate !== '') {
			$.ajax({
				url: 'php_action/fetchProductSalesDataByDate.php',
				method: 'POST',
				data: {
					startDate: startDate,
					endDate: endDate
				},
				success: function(response) {
					$('#manageProductSalesTable').DataTable().destroy();
					$('#manageProductSalesTable tbody').html(response);
					$('#manageProductSalesTable').DataTable();
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

