/**
 * Created by Luis Macias on 02/08/2015.
 */

var EditaCliente = function () {

    var setSubCategoria = function() {
        var subSelects = function(categoria, subcategoria) {
            var cateoria_id = categoria.val();
            var url = categoria.attr('data-url') + '/' + cateoria_id;
            var text = categoria.children("option:selected").text();

            if(categoria.val() != "") {
                $.get(url, function(data) {
                    subcategoria.html(data);
                    subcategoria.val(subcategoria.attr('sub')).trigger("change");

                    subcategoria.select2({
                        placeholder:"Subcategorias de "+text,
                        allowClear:            true,
                    });
                },'html');
            }

        }

        subSelects($('#categoria'), $('#subcategoria'));
        subSelects($('#categoria2'), $('#subcategoria2'));
        subSelects($('#categoria3'), $('#subcategoria3'));
    }

    var selectCategoria = function () {
        var selects = function(categoria, subcategoria) {
            categoria.on('change', function() {
                subcategoria.select2('destroy');

                var url = $(this).attr('data-url') + '/' + $(this).val();
                var text = categoria.children("option:selected").text();

                if(text == "") {
                    subcategoria.html('');
                } else {
                    $.get(url, function(data) {
                        subcategoria.html(data);
                        subcategoria.select2({
                            placeholder:"Subcategorias de "+text,
                            allowClear:            true
                        });
                    },'html');
                }
            });

            subcategoria.select2({
                placeholder:"Lista de Subcategorias",
                allowClear:            true
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

    var mapGeocoding = function () {

        var marker;

        var map = new GMaps({
            div: '#gmap_geocoding',
            lat: 20.3417485,
            lng: -102.76523259999999
        });

        var handleAction = function () {
            var calle = $('input[name="calle"]').val() + ' ' +$('input[name="numero"]').val() + ', ' +$('select[name="ciudad_id"] option:selected').text();

            $('#gmap_geocoding_address').val($.trim(calle));
            var text = $.trim($('#gmap_geocoding_address').val());



            GMaps.geocode({
                address: text,
                callback: function (results, status) {
                    if (status == 'OK') {
                        var latlng = results[0].geometry.location;
                        map.setCenter(latlng.lat(), latlng.lng());
                        if(marker) {
                            marker.setPosition({lat:latlng.lat(), lng:latlng.lng()});
                        } else {
                            marker = map.addMarker({
                                draggable: true,
                                animation: google.maps.Animation.DROP,
                                lat: latlng.lat(),
                                lng: latlng.lng(),
                                icon: 'http://wcdn1.dataknet.com/static/resources/icons/set94/be39f3b7.png',
                                drag: function(e) {
                                    $('input[name="latlng_gmaps"]').val(e.latLng.lat() + ', ' + e.latLng.lng());
                                },
                                dragend: function(e) {
                                    map.setCenter(e.latLng.lat(), e.latLng.lng());
                                    GMaps.geocode(
                                        {
                                            location: {lat:e.latLng.lat(), lng:e.latLng.lng()},
                                            callback: function (results, status) {
                                                console.log(results);
                                                $('#gmap_geocoding_address').val(results[0].formatted_address);
                                                console.log(results[0].formatted_address);
                                            }
                                        });
                                }
                            });
                        }
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
                    required:  true
                },
                nombre:   {
                    required:  true,
                    maxlength: 45
                },
                calle:    {
                    required:  true,
                    maxlength: 14
                },
                numero:    {
                    required:  true,
                    maxlength: 5
                },
                colonia: {
                    required: true,
                    maxlength: 45
                },
                codigo_postal: {
                    required: true,
                    maxlength: 45
                },
                referencia: {
                    maxlength: 45
                },
                ciudad_id: {
                    required:  true
                },
                latlng_gmaps: {
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
                            cancelButtonText: "Añadir nuevo cliente",
                            confirmButtonColor: Metronic.getBrandColor('green'),
                            confirmButtonText:  "Listado de clientes"
                        }, function (isConfirm) {
                            if(isConfirm){
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
            setSubCategoria();
            selectCategoria();
            inputMask();
            mapGeocoding();
            handleForm();
        }
    }
}();
