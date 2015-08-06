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
                Metronic.scrollTo($('.logo'), -100);
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

                var success =  function (data) {
                    App.removeLoader(500, function () {
                        swal({
                            title: '<h3>' + data.titulo + '</h3>',
                            text: '<p>' + data.texto + '</p>',
                            type: "success",
                            animation: 'slide-from-top',
                            html: true,
                            showConfirmButton: false,
                            timer: 3000
                        }, function () {
                            window.location.href = data.url;
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
    };

    return {
        init: function () {
            handleLogin();
        }
    }
}();
