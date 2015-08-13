/**
 * Created by Luis Macias on 02/08/2015.
 */

var NuevoCliente = function () {

    var selectPropietario = function () {
        $('#propietario').select2({
            placeholder:        "Lista de Propietarios",
            allowClear:         true,
            minimumInputLength: 1,
            ajax:               {
                url:         $('#propietario').attr('data-url'),
                type:        'post',
                dataType:    'json',
                quietMillis: 500,
                data:        function (term, page) {
                    return {
                        q:          term, // search term
                        page_limit: 2
                    };
                },
                results:     function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    return {results: data};
                }
            }
        });
    }

    var selectCategoria = function () {
        $('#categoria').select2({
            placeholder:           "Lista de Categorías",
            allowClear:            true,
            maximumSelectionSize:  3,
            formatSelectionTooBig: function (limit) {
                return 'Solo puedes seleccionar 3 categorías';
            }
        });
    }

    var inputMask = function () {
        $("input[name='codigo_postal']").inputmask("mask", {
            "mask": "99999"
        });
    }

    var mapGeocoding = function () {

        var map = new GMaps({
            div: '#gmap_geocoding',
            lat: 20.3417485,
            lng: -102.76523259999999
        });

        var handleAction = function () {
            var calle = $('input[name="calle"]').val() + ' ' +
                $('input[name="numero"]').val() + ', ' +
                $('select[name="ciudad_id"] option:selected').text();
            $('#gmap_geocoding_address').val($.trim(calle));
            var text  = $.trim($('#gmap_geocoding_address').val());
            GMaps.geocode({
                address:  text,
                callback: function (results, status) {
                    if (status == 'OK') {
                        var latlng = results[0].geometry.location;
                        map.setCenter(latlng.lat(), latlng.lng());
                        map.addMarker({
                            lat: latlng.lat(),
                            lng: latlng.lng()
                        });
                        $('input[name="latlng_gmaps"]').val(latlng.lat() + ', ' + latlng.lng());

                        Metronic.scrollTo($('#gmap_geocoding'));
                    }
                }
            });
        }

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
            errorClass:   'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore:       "",  // validate all fields including form hidden input
            rules:        {
                propietario_id: {
                    required: true
                },
                nombre:         {
                    required:  true,
                    maxlength: 45
                },
                calle:          {
                    required:  true,
                    maxlength: 14
                },
                numero:         {
                    required:  true,
                    maxlength: 5
                },
                colonia:        {
                    required:  true,
                    maxlength: 45
                },
                codigo_postal:  {
                    required:  true,
                    maxlength: 45
                },
                referencia:     {
                    maxlength: 45
                },
                ciudad_id:      {
                    required: true
                },
                latlng_gmaps:   {
                    required:  true,
                    maxlength: 45
                },
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
                            title:              '<h3>' + data.titulo + '</h3>',
                            text:               '<p>' + data.texto + '</p>',
                            html:               true,
                            type:               "success",
                            animation:          'slide-from-top',
                            showCancelButton:   true,
                            cancelButtonText:   "Añadir nuevo cliente",
                            confirmButtonColor: Metronic.getBrandColor('green'),
                            confirmButtonText:  "Listado de clientes"
                        }, function (isConfirm) {
                            if (isConfirm) {
                                window.location.href = data.url;
                            } else {
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
