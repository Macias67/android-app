/**
 * Created by Luis Macias on 24/08/2015.
 */

var Horarios = function() {



    var timepicker = function() {
        $('.abre').timepicker({
            autoclose: true,
            minuteStep: 5,
            showSeconds: false,
            showMeridian: false
        });

        $('.cierra').timepicker({
            autoclose: true,
            minuteStep: 5,
            showSeconds: false,
            showMeridian: false
        });
    }

    var addHorario = function() {
        $("#addHorario").click(function(e) {
            e.preventDefault();

            var url = $('form.form-edita-cliente-horarios').attr('action');
            var data = $('form.form-edita-cliente-horarios').serialize();
            var success = function (data) {
                App.removeLoader(500, function () {
                    swal({
                        title:              '<h3>' + data.titulo + '</h3>',
                        text:               '<p>' + data.texto + '</p>',
                        html:               true,
                        type:               "success",
                        animation:          'slide-from-top',
                        showCancelButton:   true,
                        cancelButtonText:   "Ok",
                        confirmButtonColor: Metronic.getBrandColor('green'),
                        confirmButtonText:  "Listado de clientes"
                    }, function (isConfirm) {
                        if (isConfirm) {
                            window.location.href = data.url;
                        }
                    });
                });
            }
            App.initAjax(url, data, success);
        });
    }

    return {
        init: function() {
            timepicker();
            addHorario();
        }
    }
}();
