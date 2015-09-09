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
                        confirmButtonColor: Metronic.getBrandColor('green'),
                        confirmButtonText:  "OK"
                    },
                        function () {
                            $('label.btn').removeClass('active');
                            $('input:checkbox[name="dias[]"]').removeAttr('checked');
                        });

                    var alert ='' +
                        '<div class="alert alert-info horario" grupo-id="'+data.extras.grupo_id+'" delete-url="'+data.extras.delete_url+'" id="'+data.extras.cliente_id+'">' +
                        '<button type="button" class="close"></button>' +
                        ''+data.extras.dias+' - <strong>'+data.extras.horas+'</strong>' +
                        '</div>';

                    $("#horarios").append(alert);
                });
            }
            App.initAjax(url, data, success);
        });
    }

    var deleteHorario = function() {
        $("#horarios").on('click', '.horario button.close', function(e) {
            e.preventDefault();

            var grupoid = $(this).parent().attr('grupo-id');
            var id = $(this).parent().attr('id');
            var url = $(this).parent().attr('delete-url');

            var alert = $(this).parent();

            swal({
                title:              '<h3>Eliminar horario</h3>',
                text:               '<p>¿Estás seguro de eliminar este horario?</p>',
                html:               true,
                type:               "warning",
                animation:          'slide-from-top',
                showCancelButton:   true,
                cancelButtonText:   "No",
                confirmButtonColor: Metronic.getBrandColor('red'),
                confirmButtonText:  "Eliminar"
            }, function (isConfirm) {
                if (isConfirm) {

                    var success = function(data) {
                        App.removeLoader(500, function () {
                            if(data.exito){
                                alert.fadeOut(300, function() {
                                    $(this).remove();
                                });
                            }
                        });
                    }

                    App.initAjax(url, {grupoid:grupoid, id:id}, success);
                }
            });

        });
    }

    return {
        init: function() {
            timepicker();
            addHorario();
            deleteHorario();
        }
    }
}();
