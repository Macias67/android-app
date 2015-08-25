/**
 * Created by Luis Macias on 24/08/2015.
 */

var InfoAdicional = function() {

    var tagsDias = function() {
        $("#dias_semana").select2({
            tags: ["Lunes", "Martes", "Miércoles", "Jueves", "Sábado", "Domingo"]
        });
    }

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

    return {
        init: function() {
            tagsDias();
            timepicker();
        }
    }
}();
