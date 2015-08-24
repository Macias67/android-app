/**
 * Created by Luis Macias on 22/08/2015.
 */

var Profile = function () {

    var dashboardMainChart = null;

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

    var croppic = function() {
        var token = Metronic.getToken();
        ;var id = $('#newlogo').attr('data-id');
        var cropperOptions = {
            uploadUrl: $('#newlogo').attr('data-upload'),
            cropUrl: $('#newlogo').attr('data-crop'),
            uploadData:{
                "cliente_id": id,
                "_token": token
            },
            cropData: {
                "cliente_id": id,
                "_token": token
            },
            modal:true,
            imgEyecandy:false,
            rotateControls:false,
            onAfterImgCrop:		function(){
                var src = $('img.croppedImg').attr('src');
                $('img#logo').attr('src', src);
            }
        }
        var cropperHeader = new Croppic('newlogo', cropperOptions);
    }

    return {

        //main function
        init: function () {
            activeSection();
            croppic();
            Profile.initMiniCharts();
        },

        initMiniCharts: function () {

            // IE8 Fix: function.bind polyfill
            if (Metronic.isIE8() && !Function.prototype.bind) {
                Function.prototype.bind = function (oThis) {
                    if (typeof this !== "function") {
                        // closest thing possible to the ECMAScript 5 internal IsCallable function
                        throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
                    }

                    var aArgs = Array.prototype.slice.call(arguments, 1),
                        fToBind = this,
                        fNOP = function () {
                        },
                        fBound = function () {
                            return fToBind.apply(this instanceof fNOP && oThis ? this : oThis,
                                aArgs.concat(Array.prototype.slice.call(arguments)));
                        };

                    fNOP.prototype = this.prototype;
                    fBound.prototype = new fNOP();

                    return fBound;
                };
            }

            $("#sparkline_bar").sparkline([8, 9, 10, 11, 10, 10, 12, 10, 10, 11, 9, 12, 11], {
                type: 'bar',
                width: '100',
                barWidth: 6,
                height: '45',
                barColor: '#F36A5B',
                negBarColor: '#e02222'
            });

            $("#sparkline_bar2").sparkline([9, 11, 12, 13, 12, 13, 10, 14, 13, 11, 11, 12, 11], {
                type: 'bar',
                width: '100',
                barWidth: 6,
                height: '45',
                barColor: '#5C9BD1',
                negBarColor: '#e02222'
            });
        }
    };
}();