/**
 * Created by Luis Macias on 02/08/2015.
 */

var EditaServicios = function () {

	var slugify = function () {
		$('input[name="nombre"]').on('keyup', function () {
			var acentos  = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç";
			var original = "aaaaaeeeeiiiioooouuuuaaaaaeeeeiiiioooouuuunncc";
			var text     = $(this).val();
			for (var i = 0; i < acentos.length; i++) {
				text = text.replace(acentos.charAt(i), original.charAt(i));
			}

			var slug = text.toLowerCase()
				.replace(/\s+/g, '-')           // Replace spaces with -
				.replace(/_+/g, '-')           // Replace spaces with _
				.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
				.replace(/\-\-+/g, '-')         // Replace multiple - with single -
				.replace(/^-+/, '')             // Trim - from start of text
				.replace(/-+$/, '');            // Trim - from end of text
			$('input[name="slug"]').val(slug);
		});
	}

	var maxLenght = function () {
		$("textarea[name='descripcion']").maxlength({
			limitReachedClass: "label label-danger",
			alwaysShow       : true
		});

		$("textarea[name='descripcion_corta']").maxlength({
			limitReachedClass: "label label-danger",
			alwaysShow       : true
		});
	}

	var touchSpin = function () {
		$("#precio").TouchSpin({
			buttondown_class: 'btn blue',
			buttonup_class  : 'btn blue',
			min             : 0,
			max             : 1000000000,
			step            : 0.1,
			decimals        : 2,
			boostat         : 5,
			maxboostedstep  : 10,
			prefix          : '$'
		});

		$("#cantidad").TouchSpin({
			buttondown_class: 'btn blue',
			buttonup_class  : 'btn blue',
			min             : 0,
			max             : 1000000000,
			step            : 1,
			boostat         : 5,
			maxboostedstep  : 10
		});
	}

	var dateRange = function () {

		var startDate = $('input[name="disp_inicio"]').val();
		var endDate   = $('input[name="disp_fin"]').val();

		moment.locale('es');
		var formato = 'LLLL';
		$('#reportrange').daterangepicker({
				opens              : 'left',
				drops: 'up',
				startDate: moment(startDate),
				endDate  : moment(endDate),
				showDropdowns: true,
				showWeekNumbers: true,
				timePicker     : true,
				timePickerIncrement: 1,
				timePicker12Hour   : true,
				ranges             : {
					'Hoy'    : [moment(), moment()],
					'Mañana': [moment(), moment().add(1, 'days')],
					'7 Días': [moment(), moment().add(7, 'days')],
					'Un Mes': [moment(), moment().add(30, 'days')],
					'6 Meses': [moment(), moment().add(6, 'month')],
					'1 Año'  : [
						moment(),
						moment().add(1, 'year')
					]
				},
				buttonClasses      : ['btn'],
				applyClass         : 'green',
				cancelClass        : 'default',
				format             : 'DD/MM/YYYY',
				separator          : ' al ',
				locale             : {
					applyLabel      : 'Aplicar',
					fromLabel : 'Desde',
					toLabel   : 'a',
					customRangeLabel: 'Otro Rango',
					daysOfWeek      : ['D', 'L', 'M', 'I', 'J', 'V', 'S'],
					monthNames      : [
						'Enero',
						'Febrero',
						'Marzo',
						'Abril',
						'Mayo',
						'Junio',
						'Julio',
						'Agosto',
						'Septiembre',
						'Octubre',
						'Noviembre',
						'Diciembre'
					],
					firstDay        : 1
				}
			},
			function (start, end) {
				$('input[name="finicio"]').val(start.format(formato));
				$('input[name="ffin"]').val(end.format(formato));

				$('input[name="disp_inicio"]').val(start.format("YYYY-MM-DD HH:mm:ss"));
				$('input[name="disp_fin"]').val(end.format("YYYY-MM-DD HH:mm:ss"));
			}
		);
		//Set the initial state of the picker label
		$('input[name="finicio"]').val(moment(startDate).format(formato));
		$('input[name="ffin"]').val(moment(endDate).format(formato));

		$('input[name="disp_inicio"]').val(startDate);
		$('input[name="disp_fin"]').val(endDate);
	}

	var submitForm = function () {
		$('#agregar').on('click', function () {
			$('.form-edita-servicios').submit();
		});
	}

	var handleForm = function () {
		var form = $('.form-edita-servicios');

		form.validate({
			errorElement: 'b', //default input error message containerz
			errorClass  : 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore      : "",  // validate all fields including form hidden input
			rules       : {
				cliente_id       : {
					required: true
				},
				nombre           : {
					required : true,
					maxlength: 45
				},
				slug             : {
//                    required:  true,
					maxlength: 45
				},
				descripcion      : {
					required : true,
					maxlength: 255,
					minlength: 10
				},
				descripcion_corta: {
					required : true,
					maxlength: 45,
					minlength: 10
				},
				precio           : {
					required: true
				},
				disp_inicio      : {
					required: true
				},
				disp_fin         : {
					required: true
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
							cancelButtonText  : "Añadir nuevo servicio",
							confirmButtonColor: App.getBrandColor('green'),
							confirmButtonText : "Listado de servicios"
						}, function (isConfirm) {
							if (isConfirm) {
								window.location.href = data.url;
							}
							else {
								location.reload(true);
							}
						});
					});
				}

				MyApp.initAjax(url, data, success);
			}
		});

		$('.form-nuevo-servicios input').keypress(function (e) {
			if (e.which == 13) {
				if ($('.form-edita-servicios').validate().form()) {
					$('.form-edita-servicios').submit(); //form validation success, call ajax form submit
				}
				return false;
			}
		});
	}

	return {
		init: function () {
			slugify();
			maxLenght();
			touchSpin();
			dateRange();
			submitForm();
			handleForm();
		}
	}
}();

jQuery(document).ready(function () {
	EditaServicios.init();
});
