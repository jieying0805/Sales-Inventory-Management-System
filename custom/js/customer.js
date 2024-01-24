var manageCustomerTable;

$(document).ready(function() {
	// top nav bar 
	$('#navCustomer').addClass('active');
	// manage Customer data table
	manageCustomerTable = $('#manageCustomerTable').DataTable({
		'ajax': 'php_action/fetchCustomer.php',
		'order': []
	});

	// add Customer modal btn clicked
	$("#addCustomerModalBtn").unbind('click').bind('click', function() {
		// // Customer form reset
		$("#submitCustomerForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success'); 

		// submit Customer form
		$("#submitCustomerForm").unbind('submit').bind('submit', function() {

			// form validation
			var customerName = $("#customerName").val();
			var customerPhone = $("#customerPhone").val();
			var customerAddress = $("#customerAddress").val();
			
			if(customerName == "") {
				$("#customerName").after('<p class="text-danger">Customer Name field is required</p>');
				$('#customerName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#customerName").find('.text-danger').remove();
				// success out for form 
				$("#customerName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(customerPhone == "") {
				$("#customerPhone").after('<p class="text-danger">Phone Number field is required</p>');
				$('#customerPhone').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#customerPhone").find('.text-danger').remove();
				// success out for form 
				$("#customerPhone").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(customerAddress == "") {
				$("#customerAddress").after('<p class="text-danger">Address field is required</p>');
				$('#customerAddress').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#customerAddress").find('.text-danger').remove();
				// success out for form 
				$("#customerAddress").closest('.form-group').addClass('has-success');	  	
			}	// /else


			if(customerName && customerPhone && customerAddress) {
				// submit loading button
				$("#createCustomerBtn").button('loading');

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
							$("#createCustomerBtn").button('reset');
							
							$("#submitCustomerForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-customer-messages').html('<div class="alert alert-success">'+
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
							manageCustomerTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success
						
					} // /success function
				}); // /ajax function
			}	 // /if validation is ok 					

			return false;
		}); // /submit Customer form

	}); // /add Customer modal btn clicked
	

	// remove Customer 	

}); // document.ready fucntion

function editCustomer(customerId = null) {

	if(customerId) {
		$("#customerId").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedCustomer.php',
			type: 'post',
			data: {customerId: customerId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.Customer_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');

				// $("#editProductImage").fileinput({
		  //     overwriteInitial: true,
			 //    maxFileSize: 2500,
			 //    showClose: false,
			 //    showCaption: false,
			 //    browseLabel: '',
			 //    removeLabel: '',
			 //    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
			 //    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
			 //    removeTitle: 'Cancel or reset changes',
			 //    elErrorContainer: '#kv-avatar-errors-1',
			 //    msgErrorClass: 'alert alert-block alert-danger',
			 //    defaultPreviewContent: '<img src="stock/'+response.product_image+'" alt="Profile Image" style="width:100%;">',
			 //    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
		  // 		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
				// });  

				// Customer id 
				$(".editCustomerFooter").append('<input type="hidden" name="customerId" id="customerId" value="'+response.cust_id+'" />');				
				$(".editCustomerPhotoFooter").append('<input type="hidden" name="customerId" id="customerId" value="'+response.cust_id+'" />');				
				
				// Customer name
				$("#editCustomerName").val(response.cust_name);
				// quantity
				$("#editCustomerPhone").val(response.cust_phone);
				// rate
				$("#editCustomerAddress").val(response.cust_address);
				// brand name
				$("#editAgentName").val(response.agent_id);

				// update the Customer data function
				$("#editCustomerForm").unbind('submit').bind('submit', function() {

					// form validation
					var customerName = $("#editCustomerName").val();
					var customerPhone = $("#editCustomerPhone").val();
					var customerAddress = $("#editCustomerAddress").val();
								

					if(customerName == "") {
						$("#editCustomerName").after('<p class="text-danger">Customer Name field is required</p>');
						$('#editCustomerName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editCustomerName").find('.text-danger').remove();
						// success out for form 
						$("#editCustomerName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(customerPhone == "") {
						$("#editCustomerPhone").after('<p class="text-danger">Phone field is required</p>');
						$('#editCustomerPhone').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editCustomerPhone").find('.text-danger').remove();
						// success out for form 
						$("#editCustomerPhone").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(customerAddress == "") {
						$("#editCustomerAddress").after('<p class="text-danger">Address field is required</p>');
						$('#editCustomerAddress').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editCustomerAddress").find('.text-danger').remove();
						// success out for form 
						$("#editCustomerAddress").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(customerName && customerPhone && customerAddress) {
						// submit loading button
						$("#editCustomerBtn").button('loading');

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
									$("#editCustomerBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-customer-messages').html('<div class="alert alert-success">'+
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
									manageCustomerTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // update the Customer data function

			} // /success function
		}); // /ajax to fetch Customer image
	
	} else {
		alert('error please refresh the page');
	}
} // /edit Customer function

// remove Customer 
function removeCustomer(customerId = null) {
	if(customerId) {
		// remove Customer button clicked
		$("#removeCustomerBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeCustomerBtn").button('loading');
			$.ajax({
				url: 'php_action/removeCustomer.php',
				type: 'post',
				data: {customerId: customerId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeCustomerBtn").button('reset');
					if(response.success == true) {
						// remove Customer modal
						$("#removeCustomerModal").modal('hide');

						// update the Customer table
						manageCustomerTable.ajax.reload(null, false);

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
						$(".removeCustomerMessages").html('<div class="alert alert-success">'+
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
			}); // /ajax fucntion to remove the Customer
			return false;
		}); // /remove Customer btn clicked
	} // /if Customerid
} // /remove Customer function

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