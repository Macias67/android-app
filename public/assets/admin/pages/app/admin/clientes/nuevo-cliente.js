/**
 * Created by Luis Macias on 02/08/2015.
 */

var NuevoCliente = function () {

    var selectPropietario = function () {
        $('#propietario').select2({
            placeholder: "Lista de Propietarios",
            allowClear: true,
            minimumInputLength: 1,
            ajax: {
                url: $('#propietario').attr('data-url'),
                type: 'post',
                dataType: 'json',
                quietMillis: 500,
                data: function (term, page) {
                    return {
                        q: term, // search term
                        page_limit: 2
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    return {results: data};
                }
            }
        });
    }

    var inputMask = function () {
        $("input[name='movil']").inputmask("mask", {
            "mask": "(999) 999-9999"
        });
    }

    var genPassword = function () {
        $('#genpassword').on('click', function () {
            var url = Metronic.getDomain() + 'admin/cliente/nuevo/password';
            $.post(url, function (data) {
                $("input[name='password']").val(data);
            }, 'text');
        });
    }

    var handleForm = function () {
        var form = $('.form-nuevo-cliente');

        form.validate({
            errorElement: 'b', //default input error message containerz
            errorClass:   'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore:       "",  // validate all fields including form hidden input
            rules:        {
                nombre:   {
                    required:  true,
                    maxlength: 45
                },
                apellido: {
                    required:  true,
                    maxlength: 45
                },
                movil:    {
                    required:  true,
                    maxlength: 14
                },
                email:    {
                    required:  true,
                    email:     true,
                    maxlength: 45
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
                var url  = $(form).attr('action');
                var data = $(form).serialize();

                App.initAjax(url, data);
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
            selectPropietario();
            inputMask();
            genPassword();
            handleForm();
        }
    }
}();
