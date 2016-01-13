var registro = function () {

	var maskBday = function () {
		$('#fecha_nacimiento').inputmask("d/m/y", {"placeholder": "dd/mm/yyyy"});
	}

	var handleForm = function () {
		var form = $('#form-register');

		form.validate({
			errorElement: 'b', //default input error message containerz
			errorClass  : 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore      : "",  // validate all fields including form hidden input
			rules       : {
				nombre          : {
					required : true,
					maxlength: 45
				},
				apellido        : {
					required : true,
					maxlength: 45
				},
				nacimiento      : {
					required: true
				},
				email           : {
					required: true,
					email   : true
				},
				sexo            : {
					required: true
				},
				password        : {
					required: true
				},
				confirm_password: {
					required: true,
					equalTo: "#password"
				}
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

		$('#form-register input').keypress(function (e) {
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
		init: function () {
			maskBday();
			handleForm();
		}
	}
}();

jQuery(document).ready(function () {
	registro.init();
});

//$(document).ready(function () {
//	$.mockjax({
//		url            : "emails.action", response: function (settings) {
//			var email = settings.data.email, emails = [
//				"glen@marketo.com",
//				"george@bush.gov",
//				"me@god.com",
//				"aboutface@cooper.com",
//				"steam@valve.com",
//				"bill@gates.com"
//			];
//			this.responseText = "true";
//			if ($.inArray(email, emails) !== -1) {
//				this.responseText = "false";
//			}
//		}, responseTime: 500
//	});
//	jQuery.validator.addMethod("password", function (value, element) {
//		var result = this.optional(element) || value.length >= 6 && /\d/.test(value) && /[a-z]/i.test(value);
//		if (!result) {
//			element.value = "";
//			var validator = this;
//			setTimeout(function () {
//				validator.blockFocusCleanup = true;
//				element.focus();
//				validator.blockFocusCleanup = false;
//			}, 1);
//		}
//		return result;
//	}, "Your password must be at least 6 characters long and contain at least one number and one character.");
//	jQuery.validator.addMethod("defaultInvalid", function (value, element) {
//		return value != element.defaultValue;
//	}, "");
//	jQuery.validator.addMethod("billingRequired", function (value, element) {
//		if ($("#bill_to_co").is(":checked")) {
//			return $(element).parents(".subTable").length;
//		}
//		return !this.optional(element);
//	}, "");
//	jQuery.validator.messages.required = "";
//	$("form").validate({
//		invalidHandler: function (e, validator) {
//			var errors = validator.numberOfInvalids();
//			if (errors) {
//				var message = errors == 1 ? 'You missed 1 field. It has been highlighted below'
//					: 'You missed ' + errors + ' fields.  They have been highlighted below';
//				$("div.error span").html(message);
//				$("div.error").show();
//			}
//			else {
//				$("div.error").hide();
//			}
//		},
//		onkeyup       : false,
//		submitHandler : function () {
//			$("div.error").hide();
//			alert("submit! use link below to go to the other step");
//		},
//		messages      : {
//			password2: {required: " ", equalTo: "Please enter the same password as above"},
//			email    : {
//				required: " ",
//				email   : "Please enter a valid email address, example: you@yourdomain.com",
//				remote  : jQuery.validator.format("{0} is already taken, please enter a different address.")
//			}
//		},
//		debug         : true
//	});
//	$(".resize").vjustify();
//	$("div.buttonSubmit").hoverClass("buttonSubmitHover");
//	$("input.phone").mask("(999) 999-9999");
//	$("input.zipcode").mask("99999");
//	var creditcard = $("#creditcard").mask("9999 9999 9999 9999");
//	$("#cc_type").change(function () {
//		switch ($(this).val()) {
//			case'amex':
//				creditcard.unmask().mask("9999 999999 99999");
//				break;
//			default:
//				creditcard.unmask().mask("9999 9999 9999 9999");
//				break;
//		}
//	});
//	var subTableDiv = $("div.subTableDiv");
//	var toggleCheck = $("input.toggleCheck");
//	toggleCheck.is(":checked") ? subTableDiv.hide() : subTableDiv.show();
//	$("input.toggleCheck").click(function () {
//		if (this.checked == true) {
//			subTableDiv.slideUp("medium");
//			$("form").valid();
//		}
//		else {
//			subTableDiv.slideDown("medium");
//		}
//	});
//});
//$.fn.vjustify = function () {
//	var maxHeight = 0;
//	$(".resize").css("height", "auto");
//	this.each(function () {
//		if (this.offsetHeight > maxHeight) {
//			maxHeight = this.offsetHeight;
//		}
//	});
//	this.each(function () {
//		$(this).height(maxHeight);
//		if (this.offsetHeight > maxHeight) {
//			$(this).height((maxHeight - (this.offsetHeight - maxHeight)));
//		}
//	});
//};
//$.fn.hoverClass = function (classname) {
//	return this.hover(function () {
//		$(this).addClass(classname);
//	}, function () {
//		$(this).removeClass(classname);
//	});
//};