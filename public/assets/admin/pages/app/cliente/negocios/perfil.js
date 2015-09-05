/**
 * Created by Luis Macias on 22/08/2015.
 */

var Section = function () {

    var activeSection = function() {
        var v = window.location.pathname;
        var params = v.split('/');
        var last = params[params.length - 1];

        switch(last) {
            case 'settings':
                $('li#misdatos').addClass('active');
                break;
            default:
                $('li#perfil').addClass('active');
                break;
        }
    }

    return {
        init: function () {
            activeSection();
        }
    };
}();