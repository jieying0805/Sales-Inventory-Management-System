$(document).ready(function() {
	// manage product data table
	manageReportTable = $('#manageReportTable').DataTable({
		'ajax': 'php_action/fetchReportData.php',
		'order': []
	});

	// Live search
	$('#generateReportBtn').click(function() {
		var startDate = $('#startDate').val();
		var endDate = $('#endDate').val();

		if (startDate !== '' && endDate !== '') {
			$.ajax({
				url: 'php_action/fetchReportDataByDate.php',
				method: 'POST',
				data: {
					startDate: startDate,
					endDate: endDate
				},
				success: function(response) {
					$('#manageReportTable').DataTable().destroy();
					$('#manageReportTable tbody').html(response);
					$('#manageReportTable').DataTable();
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

