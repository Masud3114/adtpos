//From Validator//
$(function () {
	$('#sign_in').validate({
		highlight: function (input) {
			//console.log(input);
			$(input).parents('.form-line').addClass('error');
		},
		unhighlight: function (input) {
			$(input).parents('.form-line').removeClass('error');
		},
		errorPlacement: function (error, element) {
			$(element).parents('.input-group').append(error);
		}
	});
	$("form:not(#sign_in)").validate({
		rules: {
			'terms': {
				required: true
			},
			'confirm': {
				equalTo: '[name="dusr_pswd"]'
			}
		},
		highlight: function (input) {
			//console.log(input);
			$(input).parents('.form-line').addClass('error');
		},
		unhighlight: function (input) {
			$(input).parents('.form-line').removeClass('error');
		},
		errorPlacement: function (error, element) {
			$(element).parents('.form-group').append(error);
		}
	});
	$('.ac_massage').fadeIn('slow').delay(3000).fadeOut(500);
});