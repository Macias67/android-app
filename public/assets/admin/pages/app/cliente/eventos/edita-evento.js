/**
 * Created by Julio on 30/08/2015.
 */

var EditaEvento = function () {

    var touchSpin = function () {
        $("#precio").TouchSpin({
            buttondown_class: 'btn blue',
            buttonup_class: 'btn blue',
            min: 0,
            max: 1000000000,
            step: 10,
            boostat: 5,
            maxboostedstep: 10,
            prefix: '$'
        });

        $("#cantidad").TouchSpin({
            buttondown_class: 'btn blue',
            buttonup_class:   'btn blue',
            min:              0,
            max:              1000000000,
            step:             1,
            boostat:          5,
            maxboostedstep:   10
        });

    }

    var slugify = function (){
        $('input[name="nombre"]').on('keyup', function() {
            var acentos = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç";
            var original = "aaaaaeeeeiiiioooouuuuaaaaaeeeeiiiioooouuuunncc";
            var text = $(this).val();
            for (var i=0; i<acentos.length; i++) {
                text = text.replace(acentos.charAt(i), original.charAt(i));
            }

            var slug =  text.toLowerCase()
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

        var map = new GMaps({
            div: '#gmap_geocoding',
            lat: 20.3417485,
            lng: -102.76523259999999
        });

        var handleAction = function () {
            var calle = $('input[name="direccion"]').val();
            $('#gmap_geocoding_address').val($.trim(calle));
            var text = $.trim($('#gmap_geocoding_address').val());
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
                        $('input[name="latlng_gmaps"]').val(latlng.lat()+', '+ latlng.lng());

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

        //Cuando edita ya está una dirección.
        handleAction();

    }

    var dateRange = function () {
        moment.locale('es');
        var formato = 'LLLL';
        $('#reportrange').daterangepicker({
                opens: 'left',
                drops: 'down',
                startDate:           moment(),
                endDate:             moment().add(1, 'year'),
                showDropdowns:       true,
                showWeekNumbers:     true,
                timePicker:          true,
                timePickerIncrement: 1,
                timePicker12Hour:    true,
                ranges:              {
                    'Hoy':        [moment(), moment()],
                    'Mañana':    [moment(), moment().add(1, 'days')],
                    '7 Días':  [moment(), moment().add(7, 'days')],
                    'Un Mes': [moment(), moment().add(30, 'days')],
                    '6 Meses':   [moment(), moment().add(6, 'month')],
                    '1 Año':   [
                        moment(),
                        moment().add(1, 'year')
                    ]
                },
                buttonClasses:       ['btn'],
                applyClass:          'green',
                cancelClass:         'default',
                format:              'DD/MM/YYYY',
                separator:           ' al ',
                locale:              {
                    applyLabel:       'Aplicar',
                    cancelLabel:    'Cancelar',
                    fromLabel:        'Desde',
                    toLabel:          'a',
                    customRangeLabel: 'Otro Rango',
                    daysOfWeek:       ['D', 'L', 'M', 'I', 'J', 'V', 'S'],
                    monthNames:       [
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
                    firstDay:         1
                }
            },
            function (start, end) {
                $('input[name="finicio"]').val(start.format(formato));
                $('input[name="ffin"]').val(end.format(formato));

                $('input[name="fecha_inicio"]').val(start.format("YYYY-MM-DD"));
                $('input[name="hora_inicio"]').val(start.format("HH:mm:ss"));
                $('input[name="fecha_termina"]').val(end.format("YYYY-MM-DD"));
                $('input[name="hora_termina"]').val(end.format("HH:mm:ss"));
            }
        );
        //Set the initial state of the picker label


        $('input[name="fecha_inicio"]').val(moment().format("YYYY-MM-DD"));
        $('input[name="hora_inicio"]').val(moment().format("HH:mm:ss"));
        $('input[name="fecha_termina"]').val(moment().add(1, 'days').format("YYYY-MM-DD"));
        $('input[name="hora_termina"]').val(moment().format("HH:mm:ss"));
    }

    var maxLenght = function () {
        $("textarea[name='descripcion']").maxlength({
            limitReachedClass: "label label-danger",
            alwaysShow:        true
        });
    }

    var handleForm = function () {
        var form = $('.form-edita-evento');

        form.validate({
            errorElement: 'b', //default input error message containerz
            errorClass:   'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore:       "",  // validate all fields including form hidden input
            rules:        {
                nombre:   {
                    required:  true,
                    maxlength: 45
                },
                slug:          {
//                    required:  true,
                    maxlength: 45
                },
                direccion:{
                    maxlength: 145
                },
                descripcion:{
                    required:  true,
                    maxlength: 255
                },
                latlng_gmaps: {
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

                console.log("URL:");
                console.log(url);
                console.log("DATA:");
                console.log(data);

                var success = function (data) {
                    console.log(data);
                    App.removeLoader(500, function () {
                        swal({
                            title:              '<h3>' + data.titulo + '</h3>',
                            text:               '<p>' + data.texto + '</p>',
                            html:               true,
                            type:               "success",
                            animation:          'slide-from-top',
                            showCancelButton:   true,
                            cancelButtonText: "Añadir nuevo evento",
                            confirmButtonColor: Metronic.getBrandColor('green'),
                            confirmButtonText:  "Listado de eventos"
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
            touchSpin();
            slugify();
            mapGeocoding();
            maxLenght();
            dateRange();
            handleForm();
        }
    }
}();
