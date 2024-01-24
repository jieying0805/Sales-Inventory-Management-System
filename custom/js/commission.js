var manageCommissionTable;

$(document).ready(function() {
	// top nav bar 
	$('#navCommission').addClass('active');
	// manage commission data table
	manageCommissionTable = $('#manageCommissionTable').DataTable({
		'ajax': 'php_action/fetchCommission.php',
		'order': []
	});

	// add commission modal btn clicked
	$("#addCommissionModalBtn").unbind('click').bind('click', function() {
		// // commission form reset
		$("#submitCommissionForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		// submit commission form
		$("#submitCommissionForm").unbind('submit').bind('submit', function() {

			// form validation
			var date = $("#date").val();
			var amount = $("#amount").val();
			var agent = $("#agent").val();
	
			if(date == "") {
				$("#date").after('<p class="text-danger">Payment Date field is required</p>');
				$('#date').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#date").find('.text-danger').remove();
				// success out for form 
				$("#date").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(amount == "") {
				$("#amount").after('<p class="text-danger">Payment Amount field is required</p>');
				$('#amount').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#amount").find('.text-danger').remove();
				// success out for form 
				$("#amount").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(agent == "") {
				$("#agent").after('<p class="text-danger">Payee field is required</p>');
				$('#agent').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#agent").find('.text-danger').remove();
				// success out for form 
				$("#agent").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(date && amount && agent) {
				// submit loading button
				$("#createCommissionBtn").button('loading');

				var form = $(this);
				var formData = new FormData(this);

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {

						if(response.success == true) {
							// submit loading button
							$("#createCommissionBtn").button('reset');
							
							$("#submitCommissionForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-commission-messages').html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

							// remove the mesages
		          $(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert

		          // reload the manage student table
							manageCommissionTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success
						
					} // /success function
				}); // /ajax function
			}	 // /if validation is ok 					

			return false;
		}); // /submit commission form

	}); // /add commission modal btn clicked
	

	// remove commission 	

}); // document.ready fucntion

function editCommission(commissionId = null) {

	if(commissionId) {
		$("#commissionId").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedCommission.php',
			type: 'post',
			data: {commissionId: commissionId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.inventory_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				// inventory id 
				$(".editCommissionFooter").append('<input type="hidden" name="commissionId" id="commissionId" value="'+response.commission_id+'" />');				
				$(".editCommissionFooter").append('<input type="hidden" name="commissionId" id="commissionId" value="'+response.commission_id+'" />');				
				
				// inventory name
				$("#editDate").val(response.date);
				$("#editAmount").val(response.amount);
				$("#editAgent").val(response.agent_id);

				// update the inventory data function
				$("#editCommissionForm").unbind('submit').bind('submit', function() {

					// form validation
					var date = $("#editDate").val();
					var amount = $("#editAmount").val();
					var agent = $("#editAgent").val();
								

					if(date == "") {
						$("#editDate").after('<p class="text-danger">Payment Date field is required</p>');
						$('#editDate').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editDate").find('.text-danger').remove();
						// success out for form 
						$("#editDate").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(amount == "") {
						$("#editAmount").after('<p class="text-danger">Payment Amount field is required</p>');
						$('#editAmount').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAmount").find('.text-danger').remove();
						// success out for form 
						$("#editAmount").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(agent == "") {
						$("#editAgent").after('<p class="text-danger">Payee Name field is required</p>');
						$('#editAgent').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAgent").find('.text-danger').remove();
						// success out for form 
						$("#editAgent").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(date && amount && agent) {
						// submit loading button
						$("#editCommissionBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								console.log(response);
								if(response.success == true) {
									// submit loading button
									$("#editCommissionBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-commission-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

									// remove the mesages
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          // reload the manage student table
									manageCommissionTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // update the inventory data function

			} // /success function
		}); // /ajax to fetch inventory image

				
	} else {
		alert('error please refresh the page');
	}
} // /edit inventory function

// remove commission 
function removeCommission(commissionId = null) {
	if(commissionId) {
		// remove commission button clicked
		$("#removeCommissionBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeCommissionBtn").button('loading');
			$.ajax({
				url: 'php_action/removeCommission.php',
				type: 'post',
				data: {commissionId: commissionId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeCommissionBtn").button('reset');
					if(response.success == true) {
						// remove commission modal
						$("#removeCommissionModal").modal('hide');

						// update the commission table
						manageCommissionTable.ajax.reload(null, false);

						// remove success messages
						$(".remove-messages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} else {

						// remove success messages
						$(".removeCommissionMessages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert

					} // /error
				} // /success function
			}); // /ajax fucntion to remove the commission
			return false;
		}); // /remove commission btn clicked
	} // /if commissionid
} // /remove commission function

function clearForm(oForm) {
	// var frm_elements = oForm.elements;									
	// console.log(frm_elements);
	// 	for(i=0;i<frm_elements.length;i++) {
	// 		field_type = frm_elements[i].type.toLowerCase();									
	// 		switch (field_type) {
	// 	    case "text":
	// 	    case "password":
	// 	    case "textarea":
	// 	    case "hidden":
	// 	    case "select-one":	    
	// 	      frm_elements[i].value = "";
	// 	      break;
	// 	    case "radio":
	// 	    case "checkbox":	    
	// 	      if (frm_elements[i].checked)
	// 	      {
	// 	          frm_elements[i].checked = false;
	// 	      }
	// 	      break;
	// 	    case "file": 
	// 	    	if(frm_elements[i].options) {
	// 	    		frm_elements[i].options= false;
	// 	    	}
	// 	    default:
	// 	        break;
	//     } // /switch
	// 	} // for
}