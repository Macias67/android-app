/**
 * Created by Julio on 19/08/2015.
 */

var NuevoEvento = function () {

    var mapGeocoding = function () {

        var map = new GMaps({
            div: '#gmap_geocoding',
            lat: 20.3417485,
            lng: -102.76523259999999
        });

        var handleAction = function () {
            var calle = $('input[name="calle"]').val()+' '+
                $('input[name="numero"]').val()+', '+
                $('select[name="ciudad_id"] option:selected').text();
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

    var handleDateRangePickers = function () {
        if (!jQuery().daterangepicker) {
            return;
        }

        moment.locale('es');
        $('#defaultrange').daterangepicker({
                timePicker: true,
                opens: (Metronic.isRTL() ? 'left' : 'right'),
                format: 'DD/MM/YYYY',
                separator: ' to ',
                minDate: moment().format(),
                locale: {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Guardar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "Desde",
                    "toLabel": "Hasta",
                    "customRangeLabel": "Personalizado",
                    "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    "firstDay": 1,
                },
            },
            function (start, end) {
                console.log(start);
                console.log('-------------');
                console.log(end);
                $('#defaultrange input').val(start.format('MM/DD/YYYY h:mm A') + ' - ' + end.format('MM/DD/YYYY h:mm A'));
            }
        );

        $('#reportrange').daterangepicker({
                opens: (Metronic.isRTL() ? 'left' : 'right'),
                startDate: moment().subtract('days', 29),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2014',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                buttonClasses: ['btn'],
                applyClass: 'green',
                cancelClass: 'default',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Apply',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );
        //Set the initial state of the picker label
        $('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    }


        return {
        init: function () {
            touchSpin();
            handleDateRangePickers();
            slugify();
            mapGeocoding();
        }
    }
}();