/**
 * Created by Luis Macias on 27/07/2015.
 */

var Login = function () {

    var handleLogin = function () {
        var form = $('.login-form');
        var error = $('.alert-danger', $('body'));
        var success = $('.alert-success', $('body'));

        form.validate({
            errorElement: 'b', //default input error message containerz
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                Metronic.scrollTo(error, -200);
                /* $('b', error).html('Hay problemas con los datos.');
                 error.fadeIn('fast');
                 setTimeout(function () {
                 error.fadeOut('slow', function () {
                 $(this).html('');
                 });
                 }, 3000);*/
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
                var data = $(form).serialize();
                var url = $(form).attr('action');

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

                        var audioElement = document.createElement('audio');
                        audioElement.setAttribute('src', Metronic.getDomain() + 'assets/global/sounds/error2.mp3');
                        audioElement.setAttribute('autoplay', 'autoplay');
                        audioElement.play();

                        App.removeLoader(500);
                    },
                    statusCode: {
                        422: function (jqXHR, textStatus, errorst) {
                            var data = $.parseJSON(jqXHR.responseText);
                            var msg = '<h5><b>' + data.mensaje + '</b></h5>';
                            $.each(data.errores, function (index, val) {
                                msg += '<p>' + val + '</p>';
                            });
                            swal({
                                title: "Ups...",
                                text: msg,
                                type: "error",
                                animation: 'slide-from-top',
                                html: true
                            });
                        }
                    },
                    success: function (data, textStatus, jqXHR) {
                        App.removeLoader(500, function () {
                            console.log(data);
                        });
                    }
                });
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
    };

    return {
        init: function () {
            handleLogin();
        }
    }
}();
