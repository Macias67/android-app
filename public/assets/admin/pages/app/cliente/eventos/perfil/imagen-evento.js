/**
 * Created by Julio Trujillo on 01/09/2015.
 */

var ImagenEvento = function() {

    var croppic = function() {
        var token = Metronic.getToken();
        var id = $('#newlogo').attr('data-id');
        var cliente_id = $('#newlogo').attr('data-cliente-id');
        var cropperOptions = {
            uploadUrl: $('#newlogo').attr('data-upload'),
            cropUrl: $('#newlogo').attr('data-crop'),
            uploadData:{
                "evento_id": id,
                "cliente_id": cliente_id,
                "_token": token
            },
            cropData: {
                "evento_id": id,
                "cliente_id": cliente_id,
                "_token": token
            },
            modal:true,
            imgEyecandy:false,
            rotateControls:false,
            onAfterImgCrop:		function(){
                var src = $('img.croppedImg').attr('src');
                $('#img-evento').css('background-image', 'url(' + src + ')');
            }
        }
        console.log(cropperOptions);
        var cropperHeader = new Croppic('newlogo', cropperOptions);
    }

    return {
        init: function() {
            croppic();
        }
    }
}();