/**
 * Created by Luis Macias on 04/09/2015.
 */

var InfoAdicional = function () {

    var maskTelefonos = function () {
        $("input[name='telefono1']").inputmask("mask", {
            "mask": "(999) 999-9999"
        });

        $("input[name='telefono2']").inputmask("mask", {
            "mask": "(999) 999-9999"
        });

        $("input[name='telefono3']").inputmask("mask", {
            "mask": "(999) 999-9999"
        });
    }

    var handleForm = function () {
        var form = $('.form-edita-cliente-detalles');

        form.validate({
            errorElement: 'b', //default input error message containerz
            errorClass:   'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore:       "",  // validate all fields including form hidden input
            rules:        {
                cliente_id:    {
                    required: true
                },
                descripcion:   {
                    maxlength: 200
                },
                slogan:        {
                    maxlength: 140
                },
                website:       {
                    maxlength: 45,
                    url:       true
                },
                email_negocio: {
                    maxlength: 45,
                    email:     true
                },
                telefono1:     {
                    maxlength: 14
                },
                telefono2:     {
                    maxlength: 14
                },
                telefono3:     {
                    maxlength: 14
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                Metronic.scrollTo(form, -100);
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
                var url  = $(form).attr('action');
                var data = $(form).serialize();

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
    }

    return {
        init: function () {
            maskTelefonos();
            handleForm();
        }
    }
}();