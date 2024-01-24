var manageAgentTable;

$(document).ready(function() {
	// top nav bar 
	$('#navAgent').addClass('active');
	// manage agent data table
	manageAgentTable = $('#manageAgentTable').DataTable({
		'ajax': 'php_action/fetchAgent.php',
		'order': []
	});

	// add agent modal btn clicked
	$("#addAgentModalBtn").unbind('click').bind('click', function() {
		// // agent form reset
		$("#submitAgentForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		// submit agent form
		$("#submitAgentForm").unbind('submit').bind('submit', function() {

			// form validation
			var agentName = $("#agentName").val();
			var agentPhone = $("#agentPhone").val();
			var agentEmail = $("#agentEmail").val();
			var username = $("#username").val();
	
			if(agentName == "") {
				$("#agentName").after('<p class="text-danger">Agent Name field is required</p>');
				$('#agentName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#agentName").find('.text-danger').remove();
				// success out for form 
				$("#agentName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(agentPhone == "") {
				$("#agentPhone").after('<p class="text-danger">Phone Number field is required</p>');
				$('#agentPhone').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#agentPhone").find('.text-danger').remove();
				// success out for form 
				$("#agentPhone").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(agentEmail == "") {
				$("#agentEmail").after('<p class="text-danger">Email field is required</p>');
				$('#agentEmail').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#agentEmail").find('.text-danger').remove();
				// success out for form 
				$("#agentEmail").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(username == "") {
				$("#username").after('<p class="text-danger">Username field is required</p>');
				$('#username').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#username").find('.text-danger').remove();
				// success out for form 
				$("#username").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(agentName && agentPhone && agentEmail && username) {
				// submit loading button
				$("#createAgentBtn").button('loading');

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
							$("#createAgentBtn").button('reset');
							
							$("#submitAgentForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-agent-messages').html('<div class="alert alert-success">'+
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
							manageAgentTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success
						
					} // /success function
				}); // /ajax function
			}	 // /if validation is ok 					

			return false;
		}); // /submit agent form

	}); // /add agent modal btn clicked
	

	// remove agent 	

}); // document.ready fucntion

function editAgent(agentId = null) {

	if(agentId) {
		$("#agentId").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedAgent.php',
			type: 'post',
			data: {agentId: agentId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.agent_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				

				// agent id 
				$(".editAgentFooter").append('<input type="hidden" name="agentId" id="agentId" value="'+response.agent_id+'" />');				
				
				// agent name
				$("#editAgentName").val(response.agent_name);
				$("#editAgentPhone").val(response.agent_phone);
				$("#editAgentEmail").val(response.agent_email);
				$("#editUsername").val(response.user_id);

				// update the agent data function
				$("#editAgentForm").unbind('submit').bind('submit', function() {

					// form validation
					var agentName = $("#editAgentName").val();
					var agentPhone = $("#editAgentPhone").val();
					var agentEmail = $("#editAgentEmail").val();
					var username = $("#editUsername").val();
								

					if(agentName == "") {
						$("#editAgentName").after('<p class="text-danger">Agent Name field is required</p>');
						$('#editAgentName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAgentName").find('.text-danger').remove();
						// success out for form 
						$("#editAgentName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(agentPhone == "") {
						$("#editAgentPhone").after('<p class="text-danger">Phone Number field is required</p>');
						$('#editAgentPhone').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAgentPhone").find('.text-danger').remove();
						// success out for form 
						$("#editAgentPhone").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(agentEmail == "") {
						$("#editAgentEmail").after('<p class="text-danger">Email field is required</p>');
						$('#editAgentEmail').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editAgentEmail").find('.text-danger').remove();
						// success out for form 
						$("#editAgentEmail").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(username == "") {
						$("#editUsername").after('<p class="text-danger">Username field is required</p>');
						$('#editUsername').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editUsername").find('.text-danger').remove();
						// success out for form 
						$("#editUsername").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(agentName && agentPhone && agentEmail && username) {
						// submit loading button
						$("#editAgentBtn").button('loading');

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
									$("#editAgentBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-agent-messages').html('<div class="alert alert-success">'+
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
									manageAgentTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // update the agent data function

			} // /success function
		}); // /ajax to fetch agent image

				
	} else {
		alert('error please refresh the page');
	}
} // /edit agent function

// remove agent 
function removeAgent(agentId = null) {
	if(agentId) {
		// remove agent button clicked
		$("#removeAgentBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeAgentBtn").button('loading');
			$.ajax({
				url: 'php_action/removeAgent.php',
				type: 'post',
				data: {agentId: agentId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeAgentBtn").button('reset');
					if(response.success == true) {
						// remove agent modal
						$("#removeAgentModal").modal('hide');

						// update the agent table
						manageAgentTable.ajax.reload(null, false);

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
						$(".removeAgentMessages").html('<div class="alert alert-success">'+
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
			}); // /ajax fucntion to remove the agent
			return false;
		}); // /remove agent btn clicked
	} // /if agentid
} // /remove agent function

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