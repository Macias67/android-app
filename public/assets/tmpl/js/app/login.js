var Login = function() {

	var handleForm = function () {
		var form = $('#form-signin');

		form.validate({
			errorElement: 'b', //default input error message containerz
			errorClass  : 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore      : "",  // validate all fields including form hidden input
			rules       : {
				email           : {
					required: true,
					email   : true
				},
				password        : {
					required: true
				},
			},

			invalidHandler: function (event, validator) { //display error alert on form submit
				//Metronic.scrollTo(form, -100);
				sweetAlert("Oops...", "Algo está mal en el formulario.", "error");
			},

			highlight: function (element) { // hightlight error inputs
				$(element)
					.closest('.form-group').addClass('has-error'); // set error class to the control group
			},

			unhighlight: function (element) { // revert the change done by hightlight
				$(element)
					.closest('.form-group').removeClass('has-error'); // set error class to the control group
			},

			success: function (label) {
				label.closest('.form-group').removeClass('has-error');
				label.remove();
			},

			errorPlacement: function (error, element) {
				error.insertAfter(element);
			},

			submitHandler: function (form) {
				var url  = $(form).attr('action');
				var data = $(form).serialize();

				var success = function (data) {
					App.removeLoader(500, function () {
						if(data.exito) {
							window.location.href = data.url;
						} else {
							swal({
								title             : '<h3>' + data.titulo + '</h3>',
								text              : '<p>' + data.texto + '</p>',
								html              : true,
								type              : "error",
								animation         : 'slide-from-top',
								showCancelButton  : false,
								confirmButtonText : "Ok"
							});
						}
					});
				}

				App.initAjax(url, data, success);
			}
		});

		$('#form-signin input').keypress(function (e) {
			if (e.which == 13) {
				if ($('#form-register').validate().form()) {
					$('#form-register').validate().form().submit();
					//$('#form-register').submit(); //form validation success, call ajax form submit
				}
				return false;
			}
		});
	}

	return {
		init: function() {
			handleForm();
		}
	}
}()

jQuery(document).on('ready', function() {
	Login.init();
});