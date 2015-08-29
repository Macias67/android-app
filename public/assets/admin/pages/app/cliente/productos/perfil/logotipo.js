/**
 * Created by Luis Macias on 28/08/2015.
 */

var Logotipo = function() {

    var croppic = function() {
        var token = Metronic.getToken();
        var id = $('#newlogo').attr('data-id');
        var cropperOptions = {
            uploadUrl: $('#newlogo').attr('data-upload'),
            cropUrl: $('#newlogo').attr('data-crop'),
            uploadData:{
                "producto_id": id,
                "_token": token
            },
            cropData: {
                "producto_id": id,
                "_token": token
            },
            modal:true,
            imgEyecandy:false,
            rotateControls:false,
            onAfterImgCrop:		function(){
                var src = $('img.croppedImg').attr('src');
                $('#img-producto').css('background-image', 'url(' + src + ')');
            }
        }
        var cropperHeader = new Croppic('newlogo', cropperOptions);
    }

    return {
        init: function() {
            croppic();
        }
    }
}();