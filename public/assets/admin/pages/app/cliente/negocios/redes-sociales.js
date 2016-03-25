/**
 * Created by Luis Macias on 04/09/2015.
 */

var RedesSociales = function () {

	var handleForm = function () {
		var form = $('.form-edita-cliente-redes-sociales');

		form.validate({
			errorElement: 'b', //default input error message containerz
			errorClass  : 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore      : "",  // validate all fields including form hidden input
			rules       : {
				cliente_id: {
					required: true
				},
				facebook  : {
					maxlength: 100,
					url      : true
				},
				twitter   : {
					maxlength: 100,
					url      : true
				},
				instagram : {
					maxlength: 100,
					url      : true
				},
				youtube   : {
					maxlength: 100,
					url      : true
				},
				googleplus: {
					maxlength: 100,
					url      : true
				}
			},

			invalidHandler: function (event, validator) { //display error alert on form submit
				App.scrollTo(form, -100);
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
					MyApp.removeLoader(500, function () {
						swal({
							title             : '<h3>' + data.titulo + '</h3>',
							text              : '<p>' + data.texto + '</p>',
							html              : true,
							type              : "success",
							animation         : 'slide-from-top',
							showCancelButton  : true,
							cancelButtonText  : "Ok",
							confirmButtonColor: App.getBrandColor('green'),
							confirmButtonText : "Listado de clientes"
						}, function (isConfirm) {
							if (isConfirm) {
								window.location.href = data.url;
							}
						});
					});
				}

				MyApp.initAjax(url, data, success);
			}
		});

		$('.login-form input').keypress(function (e) {
			if (e.which == 13) {
				if ($('.login-form').validate().form()) {
					$('.login-form').submit(); //form validation success, call ajax form submit
				}
				return false;
			}
		});
	}

	return {
		init: function () {
			handleForm();
		}
	}
}();

jQuery(document).ready(function () {
	RedesSociales.init();
});