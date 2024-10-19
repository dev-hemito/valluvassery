/*
Abstract : Ajax Page Js File
File : dz.ajax.js
#CSS attributes: 
	.dzForm : Form class for ajax submission. 
	.dzFormMsg  : Div Class| Show Form validation error/success message on ajax form submission

#Javascript Variable
.dzRes : ajax request result variable
.dzFormAction : Form action variable
.dzFormData : Form serialize data variable

*/

function contactForm()
{
	window.verifyRecaptchaCallback = function (response) {
        $('input[data-recaptcha]').val(response).trigger('change');
    }

    window.expiredRecaptchaCallback = function () {
        $('input[data-recaptcha]').val("").trigger('change');
    }
	'use strict';
	var msgDiv;
	$(".dzForm").on('submit',function(e)
	{
		e.preventDefault();	//STOP default action
		$('.dzFormMsg').html('<div class="gen alert alert-success">Submitting..</div>');
		var dzFormAction = $(this).attr('action');
		var dzFormData = $(this).serialize();
		
		$.ajax({
			method: "POST",
			url: dzFormAction,
			data: dzFormData,
			dataType: 'json',
			success: function(dzRes){
				if(dzRes.status == 1){
					msgDiv = '<div class="gen alert alert-success">'+dzRes.msg+'</div>';
				}
				
				if(dzRes.status == 0){
					msgDiv = '<div class="err alert alert-danger">'+dzRes.msg+'</div>';
				}
				$('.dzFormMsg').html(msgDiv);
				
				
				setTimeout(function(){
					$('.dzFormMsg .alert').hide(1000);
				}, 10000);
				
				$('.dzForm')[0].reset();
                grecaptcha.reset();
			}
		})
	});
	
	
	$(document).ready(function() {
		$('.dzContact').submit(function(event) {
			event.preventDefault();
	
			// Change button text to indicate processing
			$('.dzContact .btn-primary').text('Submitting...');
	
			// Collect form data
			var formData = new FormData(this);
	
			// Perform AJAX request
			$.ajax({
				url: 'mailer/contact.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					// Update button text upon successful submission
					$('.dzContact .btn-primary').text('Submitted');
					// Reset the form after submission
					$('.dzContact')[0].reset();
				},
				error: function(xhr, status, error) {
					// Handle errors and update button text accordingly
					$('.dzContact .btn-primary').text('Submission Failed');
				}
			});
		});
	});

	$(document).ready(function() {
		$('.dzSubscribe').submit(function(event) {
			event.preventDefault();
	
			// Change button text to indicate processing
			$('.dzSubscribe .btn-primary').text('Subscribing...');
	
			// Collect form data
			var formData = new FormData(this);
	
			// Perform AJAX request
			$.ajax({
				url: 'mailer/subscribe.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					// Update button text upon successful submission
					$('.dzSubscribe .btn-primary').text('Subscribed');
					// Reset the form after submission
					$('.dzSubscribe')[0].reset();
				},
				error: function(xhr, status, error) {
					// Handle errors and update button text accordingly
					$('.dzSubscribe .btn-primary').text('Subscription Failed');
				}
			});
		});
	});

	
	/* This function is for mail champ subscription END*/
	
}


jQuery(document).ready(function() {
    'use strict';
	contactForm();
})	