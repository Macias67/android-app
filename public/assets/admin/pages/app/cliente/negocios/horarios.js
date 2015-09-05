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

    return {
        init: function() {
            timepicker();
        }
    }
}();
