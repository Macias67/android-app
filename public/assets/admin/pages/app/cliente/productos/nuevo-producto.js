/**
 * Created by Luis Macias on 02/08/2015.
 */

var NuevoProducto = function () {

    var inicio;
    var fin;

    var maxLenght = function () {
        $("textarea[name='descripcion']").maxlength({
            limitReachedClass: "label label-danger",
            alwaysShow:        true
        });

        $("textarea[name='descripcion_corta']").maxlength({
            limitReachedClass: "label label-danger",
            alwaysShow:        true
        });
    }

    var touchSpin = function () {
        $("#precio").TouchSpin({
            buttondown_class: 'btn blue',
            buttonup_class:   'btn blue',
            min:              0,
            max:              1000000000,
            step:             0.1,
            decimals:         2,
            boostat:          5,
            maxboostedstep:   10,
            prefix:           '$'
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

    var dateRange = function () {
        moment.locale('es');
        var formato = 'DD/MMMM/YY';
        $('#reportrange').daterangepicker({
                opens:              'left',
                startDate:           moment(),
                endDate:             moment().add(29, 'days'),
                showDropdowns:       true,
                showWeekNumbers:     true,
                timePicker:          true,
                timePickerIncrement: 1,
                timePicker12Hour:    true,
                ranges:              {
                    'Hoy':        [moment(), moment()],
                    'Mañana':    [moment(), moment().add(1, 'days')],
                    '7 Días':  [moment(), moment().add(6, 'days')],
                    'Un Mes': [moment(), moment().add(29, 'days')],
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
                $('#reportrange span').html(start.format(formato) + ' al ' + end.format(formato));
                inicio = start.format("MM-DD-YYYY HH:mm:ss");
                fin = end.format("MM-DD-YYYY HH:mm:ss");
            }
        );
        //Set the initial state of the picker label
        $('#reportrange span').html(moment().format(formato) + ' al ' + moment().add(29, 'days').format(formato));
        inicio = moment().format("MM-DD-YYYY HH:mm:ss");
        fin = moment().add(29, 'days').format("MM-DD-YYYY HH:mm:ss");
    }

    var submitForm = function() {
        $('#agregar').on('click', function() {
            alert(inicio);
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
            maxLenght();
            touchSpin();
            dateRange();
            submitForm();
            handleForm();
        }
    }
}();
