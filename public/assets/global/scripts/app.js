/**
 * Created by Luis Macias on 28/07/2015.
 */
var App = function () {

    var cl;

    var sessionTimeOut = function () {
        // initialize session timeout settings
        $.sessionTimeout({
            title: 'Session Timeout Notification',
            message: 'Your session is about to expire.',
            keepAliveUrl: 'admin/auth',
            redirUrl: 'admin/login',
            logoutUrl: 'admin/login',
            warnAfter: 50000, //warn after 50 seconds
            redirAfter: 60000, //redirect after 60 secons
        });
    };

    return {
        init: function () {
            //sessionTimeOut()
        },
        showLoader: function (color) {
            $('body').append('<div class="block-canvas"><div id="canvasloader-container"></div></div>');
            cl = new CanvasLoader('canvasloader-container');
            cl.setColor(color); // default is '#000000'
            cl.setShape('spiral'); // default is 'oval'
            cl.setDiameter(145); // default is 40
            cl.setDensity(160); // default is 40
            cl.setRange(0.8); // default is 1.3
            cl.setSpeed(5); // default is 2
            cl.setFPS(60); // default is 24
            cl.show(); // Hidden by default

            $('.block-canvas').css({
                'z-index': '999999',
                border: 'medium none',
                margin: '0px',
                padding: '0px',
                width: '100%',
                height: '100%',
                top: '0px',
                left: '0px',
                'background-color': 'rgba(100, 100, 100, 0.5)',
                cursor: 'wait',
                position: 'fixed',
                display: 'none'
            });

            $("#canvasLoader").css({
                position: 'absolute',
                top: cl.getDiameter() * -0.5 + "px",
                left: cl.getDiameter() * -0.5 + "px"
            });

            $('#canvasloader-container').css({
                position: 'absolute',
                top: '50%',
                left: '50%'
            });

            $('.block-canvas').fadeIn(500);
        },
        removeLoader: function (ms, e) {
            $('.block-canvas').fadeOut(ms, function () {
                cl.kill();
                $('.block-canvas').remove();
                if ($.isFunction(e)) {
                    e();
                }
            });
            return true;
        }
    }
}();