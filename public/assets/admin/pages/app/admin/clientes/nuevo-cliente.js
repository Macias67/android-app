/**
 * Created by Luis Macias on 02/08/2015.
 */

var NuevoCliente = function () {

	var selectPropietario = function () {
		$('#propietario').select2({
			placeholder       : "Lista de Propietarios",
			allowClear        : true,
			minimumInputLength: 1,
			ajax              : {
				url        : $('#propietario').attr('data-url'),
				type       : 'post',
				dataType   : 'json',
				quietMillis: 500,
				data       : function (term, page) {
					return {
						q         : term, // search term
						page_limit: 2
					};
				},
				results    : function (data, page) { // parse the results into the format expected by Select2.
					// since we are using custom formatting functions we do not need to alter remote JSON data
					return {results: data};
				}
			}
		});
	}

	var selectCategoria = function () {
		var selects = function (categoria, subcategoria) {
			categoria.on('change', function () {
				subcategoria.select2('destroy');

				var url  = $(this).attr('data-url') + '/' + $(this).val();
				var text = categoria.children("option:selected").text();

				if (text == "") {
					subcategoria.html('');
				}
				else {
					$.get(url, function (data) {
						subcategoria.html(data);
						subcategoria.select2({
							placeholder: "Subcategorias de " + text,
							allowClear : true
						});
					}, 'html');
				}

			});

			subcategoria.select2({
				placeholder: "Lista de Subcategorias",
				allowClear : true
			});
		}
		selects($('#categoria'), $('#subcategoria'));
		selects($('#categoria2'), $('#subcategoria2'));
		selects($('#categoria3'), $('#subcategoria3'));
	}

	var inputMask = function () {
		$("input[name='codigo_postal']").inputmask("mask", {
			"mask": "99999"
		});
	}

	var updateGeocodingAddress = function (results) {
		if (results[0].address_components.length == 7) {
			numero        = results[0].address_components[0].long_name;
			calle         = results[0].address_components[1].long_name;
			colonia       = results[0].address_components[2].long_name;
			codigo_postal = results[0].address_components[6].long_name;
			$('#gmap_geocoding_address').val(results[0].formatted_address);
		}
		else {
			swal({
				title             : "Dirección no encontrada",
				text              : "Parece ser que la dirección no existe en Google Maps, intente cambiando la dirección.",
				type              : "error",
				confirmButtonColor: Metronic.getBrandColor('red')
			});
		}
	}

	var updateGeocodingAddress = function (results) {
		console.log(results[0]);
		console.log(results[0].formatted_address);
		console.log(results[0].address_components);
		if (results[0].address_components.length == 7) {
			numero        = results[0].address_components[0].long_name;
			calle         = results[0].address_components[1].long_name;
			colonia       = results[0].address_components[2].long_name;
			codigo_postal = results[0].address_components[6].long_name;
			$('#gmap_geocoding_address').val(results[0].formatted_address);
		}
		else {
			$('#gmap_geocoding_address').val('');
			swal({
				title             : "Dirección no encontrada",
				text              : "Parece ser que la dirección no existe en Google Maps, intente cambiando la dirección.",
				type              : "error",
				confirmButtonColor: Metronic.getBrandColor('red')
			});
		}
	}

	var mapGeocoding = function () {

		$('#calle_registrada').focus(function () {
			var calle =
				    $.trim($('input[name="calle"]').val()) + ' ' +
				    $.trim($('input[name="numero"]').val()) + ', ' +
				    $.trim($('input[name="colonia"]').val()) + ' ' +
				    $.trim($('input[name="codigo_postal"]').val()) + ' ' +
				    $('select[name="ciudad_id"] option:selected').text();

			$('#calle_registrada').val($.trim(calle));
		});

		var marker;
		var calle, numero, colonia, codigo_postal;

		var map = new GMaps({
			div: '#gmap_geocoding',
			lat: 20.3417485,
			lng: -102.76523259999999
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
													updateGeocodingAddress(results);
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

						Metronic.scrollTo($('#gmap_geocoding'));
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
					confirmButtonColor: Metronic.getBrandColor('red'),
					confirmButtonText : "Remplazar",
					cancelButtonText  : "Cancelar"
				}, function (isConfirm) {
					if (isConfirm) {
						$('#calle_registrada').val($('#gmap_geocoding_address').val());
						$('input[name="calle"]').val(calle);
						$('input[name="numero"]').val(numero);
						$('input[name="colonia"]').val(colonia);
						$('input[name="codigo_postal"]').val(codigo_postal);
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

	var handleForm = function () {
		var form = $('.form-nuevo-cliente');

		form.validate({
			errorElement: 'b', //default input error message containerz
			errorClass  : 'help-block help-block-error', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore      : "",  // validate all fields including form hidden input
			rules       : {
				propietario_id: {
					required: true
				},
				nombre        : {
					required : true,
					maxlength: 45
				},
				calle         : {
					required : true,
					maxlength: 45
				},
				numero        : {
					required : true,
					maxlength: 10
				},
				colonia       : {
					required : true,
					maxlength: 45
				},
				codigo_postal : {
					required : true,
					minlength: 5,
					maxlength: 5
				},
				referencia    : {
					maxlength: 140
				},
				ciudad_id     : {
					required: true
				},
				categoria1    : {
					required: true
				},
				subcategoria1 : {
					required: true
				},
				latitud       : {
					required : true,
					maxlength: 45
				},
				longitud      : {
					required : true,
					maxlength: 45
				}
			},

			invalidHandler: function (event, validator) { //display error alert on form submit
				Metronic.scrollTo(form, -100);
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
						swal({
							title             : '<h3>' + data.titulo + '</h3>',
							text              : '<p>' + data.texto + '</p>',
							html              : true,
							type              : "success",
							animation         : 'slide-from-top',
							showCancelButton  : true,
							cancelButtonText  : "Añadir nuevo cliente",
							confirmButtonColor: Metronic.getBrandColor('green'),
							confirmButtonText : "Listado de clientes"
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

				App.initAjax(url, data, success);
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
			selectPropietario();
			selectCategoria();
			inputMask();
			mapGeocoding();
			handleForm();
		}
	}
}();
