/**
 * Created by Julio on 30/08/2015.
 */

var EditaEvento = function () {

	var latitud, longitud;

	var touchSpin = function () {
		$("#costo").TouchSpin({
			buttondown_class: 'btn blue',
			buttonup_class  : 'btn blue',
			min             : 0,
			max             : 1000000000,
			step            : 10,
			boostat         : 5,
			maxboostedstep  : 10,
			prefix          : '$'
		});

		$("#cupo").TouchSpin({
			buttondown_class: 'btn blue',
			buttonup_class  : 'btn blue',
			min             : 0,
			max             : 1000000000,
			step            : 1,
			boostat         : 5,
			maxboostedstep  : 10
		});

	}

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

	var mapGeocoding = function () {

		var marker;
		var calle;

		var map = new GMaps({
			div: '#gmap_geocoding',
			lat: 20.3417485,
			lng: -102.76523259999999
		});

		$('#calle_registrada').focus(function () {
			var calle = $('input[name="direccion"]').val();
			$('#calle_registrada').val($.trim(calle));
		});

		var handleAction = function () {
			GMaps.geocode({
				address : $('#calle_registrada').val(),
				callback: function (results, status) {
					if (status == 'OK') {
						var latlng = results[0].geometry.location;
						map.setCenter(latlng.lat(), latlng.lng());
						if (marker) {
							marker.setPosition({lat: latlng.lat(), lng: latlng.lng()});
						}
						else {
							marker = map.addMarker({
								draggable: true,
								animation: google.maps.Animation.DROP,
								lat      : latlng.lat(),
								lng      : latlng.lng(),
								//icon: 'http://wcdn1.dataknet.com/static/resources/icons/set94/be39f3b7.png',
								drag     : function (e) {
									$('input[name="latitud"]').val(e.latLng.lat());
									$('input[name="longitud"]').val(e.latLng.lng());
								},
								dragend  : function (e) {
									map.setCenter(e.latLng.lat(), e.latLng.lng());
									GMaps.geocode(
										{
											location: {lat: e.latLng.lat(), lng: e.latLng.lng()},
											callback: function (results, status) {
												if (status == 'OK') {
													calle = results[0].address_components[0].long_name;

													$('#gmap_geocoding_address').val(results[0].formatted_address);
													$('input[name="latitud"]').val(e.latLng.lat());
													$('input[name="longitud"]').val(e.latLng.lng());
												}
											}
										});
								}
							});
						}

						updateGeocodingAddress(results);

						$('input[name="latitud"]').val(latlng.lat());
						$('input[name="longitud"]').val(latlng.lng());

						App.scrollTo($('#gmap_geocoding'));
					}
				}
			});

		}

		$('#gmap_address_replace').click(function (e) {
			e.preventDefault();
			if ($('#gmap_geocoding_address').val() != '') {
				swal({
					title             : "¿Estás seguro?",
					text              : "La dirección de Google Maps reemplazará la dirección que escribiste.",
					type              : "warning",
					showCancelButton  : true,
					confirmButtonColor: App.getBrandColor('red'),
					confirmButtonText : "Remplazar",
					cancelButtonText  : "Cancelar"
				}, function (isConfirm) {
					if (isConfirm) {
						$('#calle_registrada').val($('#gmap_geocoding_address').val()),
							$('input[name="calle"]').val(calle);
					}
				});
			}
		});

		$('#gmap_geocoding_btn').click(function (e) {
			e.preventDefault();
			handleAction();
		});

		$("#gmap_geocoding_address").keypress(function (e) {
			var keycode = (e.keyCode ? e.keyCode : e.which);
			if (keycode == '13') {
				e.preventDefault();
				handleAction();
			}
		});

	}

	var initMap = function () {
		latitud  = $('input[name="latitud"]').val();
		longitud = $('input[name="longitud"]').val();

		map = new GMaps({
			div : '#gmap_geocoding',
			lat : latitud,
			lng : longitud,
			zoom: 16
		});
	}

	var setMarker = function () {

		var inputLatitud  = $('input[name="latitud"]');
		var inputLongitud = $('input[name="longitud"]');

		GMaps.geocode({
			location: {
				lat: parseFloat(latitud),
				lng: parseFloat(longitud)
			},
			callback: function (results, status) {
				if (status == 'OK') {
					updateGeocodingAddress(results);
				}
			}
		});

		marker = map.addMarker({
			draggable: true,
			animation: google.maps.Animation.DROP,
			lat      : latitud,
			lng      : longitud,
			//icon: 'http://wcdn1.dataknet.com/static/resources/icons/set94/be39f3b7.png',
			drag     : function (e) {
				inputLatitud.val(e.latLng.lat());
				inputLongitud.val(e.latLng.lng());
			},
			dragend  : function (e) {
				map.setCenter(e.latLng.lat(), e.latLng.lng());
				GMaps.geocode({
					location: {
						lat: e.latLng.lat(),
						lng: e.latLng.lng()
					},
					callback: function (results, status) {
						if (status == 'OK') {
							updateGeocodingAddress(results);
							inputLatitud.val(e.latLng.lat());
							inputLongitud.val(e.latLng.lng());
						}
					}
				});
			}
		});
	}

	var updateGeocodingAddress = function (results) {
		if (results[0].address_components.length == 7) {
			calle = results[0].address_components[0].long_name;
			$('#gmap_geocoding_address').val(results[0].formatted_address);
		}
		else {
			$('#gmap_geocoding_address').val('');
			swal({
				title             : "Dirección no encontrada",
				text              : "Parece ser que la dirección no existe en Google Maps, intente cambiando la dirección.",
				type              : "error",
				confirmButtonColor: App.getBrandColor('red')
			});
		}
	}

	var dateRange = function () {

		var startDate = $('input[name="disp_inicio"]').val();
		var endDate   = $('input[name="disp_fin"]').val();

		moment.locale('es');
		var formato = 'LLLL';
		$('#reportrange').daterangepicker({
				opens              : 'left',
				drop : 'down',
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

				$('input[name="fecha_inicio"]').val(start.format("YYYY-MM-DD"));
				$('input[name="hora_inicio"]').val(start.format("HH:mm:ss"));
				$('input[name="fecha_termina"]').val(end.format("YYYY-MM-DD"));
				$('input[name="hora_termina"]').val(end.format("HH:mm:ss"));

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

	var maxLenght = function () {
		$("textarea[name='descripcion']").maxlength({
			limitReachedClass: "label label-danger",
			alwaysShow       : true
		});
	}

	var handleForm = function () {
		var form = $('.form-edita-evento');

		form.validate({
			errorElement: 'b', //default input error message containerz
			errorClass  : 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore      : "",  // validate all fields including form hidden input
			rules       : {
				nombre     : {
					required : true,
					maxlength: 45
				},
				slug       : {
					maxlength: 45
				},
				direccion  : {
					maxlength: 145
				},
				descripcion: {
					required : true,
					maxlength: 255
				},
				latitud    : {
					required : true,
					maxlength: 45
				},
				longitud   : {
					required : true,
					maxlength: 45
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
							cancelButtonText  : "Añadir nuevo evento",
							confirmButtonColor: App.getBrandColor('green'),
							confirmButtonText : "Listado de eventos"
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
			touchSpin();
			slugify();
			mapGeocoding();
			maxLenght();
			dateRange();
			handleForm();
			initMap();
			setMarker();
		}
	}
}();

jQuery(document).ready(function () {
	EditaEvento.init();
});