var manageInventoryTable;

$(document).ready(function() {
	// top nav bar 
	$('#navInventory').addClass('active');
	// manage inventory data table
	manageInventoryTable = $('#manageInventoryTable').DataTable({
		'ajax': 'php_action/fetchInventory.php',
		'order': []
	});

	// add inventory modal btn clicked
	$("#addInventoryModalBtn").unbind('click').bind('click', function() {
		// // inventory form reset
		$("#submitInventoryForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		// submit inventory form
		$("#submitInventoryForm").unbind('submit').bind('submit', function() {

			// form validation
			var date = $("#date").val();
			var product = $("#product").val();
			var status = $("#status").val();
			var qtyOrdered = $("#qtyOrdered").val();
			var qtyReceived = $("#qtyReceived").val();
	
			if(date == "") {
				$("#date").after('<p class="text-danger">Order Date field is required</p>');
				$('#date').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#date").find('.text-danger').remove();
				// success out for form 
				$("#date").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(product == "") {
				$("#product").after('<p class="text-danger">Product field is required</p>');
				$('#product').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#product").find('.text-danger').remove();
				// success out for form 
				$("#product").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(status == "") {
				$("#status").after('<p class="text-danger">Status field is required</p>');
				$('#status').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#status").find('.text-danger').remove();
				// success out for form 
				$("#status").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(qtyOrdered == "") {
				$("#qtyOrdered").after('<p class="text-danger">Qty Ordered field is required</p>');
				$('#qtyOrdered').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#qtyOrdered").find('.text-danger').remove();
				// success out for form 
				$("#qtyOrdered").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(qtyReceived == "") {
				$("#qtyReceived").after('<p class="text-danger">Qty Received field is required</p>');
				$('#qtyReceived').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#qtyReceived").find('.text-danger').remove();
				// success out for form 
				$("#qtyReceived").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(date && product && status && qtyOrdered && qtyReceived) {
				// submit loading button
				$("#createInventoryBtn").button('loading');

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
							$("#createInventoryBtn").button('reset');
							
							$("#submitInventoryForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-inventory-messages').html('<div class="alert alert-success">'+
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
							manageInventoryTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success
						
					} // /success function
				}); // /ajax function
			}	 // /if validation is ok 					

			return false;
		}); // /submit inventory form

	}); // /add inventory modal btn clicked
	

	// remove inventory 	

}); // document.ready fucntion

function editInventory(inventoryId = null) {

	if(inventoryId) {
		$("#inventoryId").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedInventory.php',
			type: 'post',
			data: {inventoryId: inventoryId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.inventory_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				// inventory id 
				$(".editInventoryFooter").append('<input type="hidden" name="inventoryId" id="inventoryId" value="'+response.inventory_id+'" />');				
				$(".editInventoryPhotoFooter").append('<input type="hidden" name="inventoryId" id="inventoryId" value="'+response.inventory_id+'" />');				
				
				// inventory name
				$("#editDate").val(response.date);
				$("#editProduct").val(response.product_id);
				$("#editStatus").val(response.status);
				$("#editQtyOrdered").val(response.qty_ordered);
				// quantity
				$("#editQtyReceived").val(response.qty_received);

				// update the inventory data function
				$("#editInventoryForm").unbind('submit').bind('submit', function() {

					// form validation
					var date = $("#editDate").val();
					var product = $("#editProduct").val();
					var status = $("#editStatus").val();
					var qty_ordered = $("#editQtyOrdered").val();
					var qty_received = $("#editQtyReceived").val();
								

					if(date == "") {
						$("#editDate").after('<p class="text-danger">Date field is required</p>');
						$('#editDate').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editDate").find('.text-danger').remove();
						// success out for form 
						$("#editDate").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(product == "") {
						$("#editProduct").after('<p class="text-danger">Product field is required</p>');
						$('#editProduct').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editProduct").find('.text-danger').remove();
						// success out for form 
						$("#editProduct").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(status == "") {
						$("#editStatus").after('<p class="text-danger">Status field is required</p>');
						$('#editStatus').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editStatus").find('.text-danger').remove();
						// success out for form 
						$("#editStatus").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(qtyOrdered == "") {
						$("#editQtyOrdered").after('<p class="text-danger">Qty Ordered field is required</p>');
						$('#editQtyOrdered').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editQtyOrdered").find('.text-danger').remove();
						// success out for form 
						$("#editQtyOrdered").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(qtyReceived == "") {
						$("#editQtyReceived").after('<p class="text-danger">Qty Received field is required</p>');
						$('#editQtyReceived').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editQtyReceived").find('.text-danger').remove();
						// success out for form 
						$("#editQtyReceived").closest('.form-group').addClass('has-success');	  	
					}	// /else			

					if(date && product && status && qtyOrdered && qtyReceived) {
						// submit loading button
						$("#editInventoryBtn").button('loading');

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
									$("#editInventoryBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-inventory-messages').html('<div class="alert alert-success">'+
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
									manageInventoryTable.ajax.reload(null, true);

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

// remove inventory 
function removeInventory(inventoryId = null) {
	if(inventoryId) {
		// remove inventory button clicked
		$("#removeInventoryBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeInventoryBtn").button('loading');
			$.ajax({
				url: 'php_action/removeInventory.php',
				type: 'post',
				data: {inventoryId: inventoryId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeInventoryBtn").button('reset');
					if(response.success == true) {
						// remove inventory modal
						$("#removeInventoryModal").modal('hide');

						// update the inventory table
						manageInventoryTable.ajax.reload(null, false);

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
						$(".removeInventoryMessages").html('<div class="alert alert-success">'+
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
			}); // /ajax fucntion to remove the inventory
			return false;
		}); // /remove inventory btn clicked
	} // /if inventoryid
} // /remove inventory function

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