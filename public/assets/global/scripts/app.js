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
        initAjax: function (url, data, success) {
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                dataType: 'json',
                cache: false,
                beforeSend: function (jqXHR, settings) {
                    App.showLoader('#00fff2');
                },
                error: function (jqXHR, textStatus, error) {
                    App.playSoundError();
                    App.removeLoader(500);
                },
                statusCode: {
                    422: function (jqXHR, textStatus, errorst) {
                        var data = jqXHR.responseJSON;
                        var msg = '<h5><b>' + data.texto + '</b></h5>';
                        $.each(data.errores, function (index, val) {
                            msg += '<p>' + val + '</p>';
                        });
                        swal({
                            title: data.titulo,
                            text: msg,
                            type: "warning",
                            animation: 'slide-from-top',
                            html: true
                        });
                    },
                    500: function (jqXHR, textStatus, errorst) {

                        var data = jqXHR.responseJSON;
                        var msg = '<p><b>' + data.error + '</b></p>';
                        msg += '<h6><b>Exception: </b>' + data.exception + '</h6>';
                        msg += '<h6><b>File: </b>' + data.file + ' (line ' + data.line + ')<h6>';
                        swal({
                            title: jqXHR.statusText + ' ' + jqXHR.status,
                            text: msg,
                            type: "error",
                            animation: 'slide-from-top',
                            html: true
                        });
                    },
                    200: function (data, textStatus, jqXHR) {
                        App.playSoundSuccess();
                    }
                },
                success: success
            });
        },
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
        },
        playSoundSuccess: function () {
            var audioElement = document.createElement('audio');
            audioElement.setAttribute('src', Metronic.getDomain() + 'assets/global/sounds/success.mp3');
            audioElement.setAttribute('autoplay', 'autoplay');
            audioElement.play();
        },
        playSoundError: function () {
            var audioElement = document.createElement('audio');
            audioElement.setAttribute('src', Metronic.getDomain() + 'assets/global/sounds/error.mp3');
            audioElement.setAttribute('autoplay', 'autoplay');
            audioElement.play();
        }
    }
}();