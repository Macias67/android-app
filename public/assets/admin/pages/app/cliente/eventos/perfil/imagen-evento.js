/**
 * Created by Julio Trujillo on 01/09/2015.
 */

var ImagenEvento = function () {

	var croppic = function () {
		var token          = Metronic.getToken();
		var id             = $('#newImage').attr('data-evento-id');
		var cliente_id     = $('#newImage').attr('data-cliente-id');
		var cropperOptions = {
			uploadUrl     : $('#newImage').attr('data-upload'),
			cropUrl       : $('#newImage').attr('data-crop'),
			uploadData    : {
				"evento_id" : id,
				"cliente_id": cliente_id,
				"_token"    : token
			},
			cropData      : {
				"evento_id" : id,
				"cliente_id": cliente_id,
				"_token"    : token
			},
			modal         : true,
			imgEyecandy   : false,
			rotateControls: false,
			onAfterImgCrop: function () {
				var src = $('img.croppedImg').attr('src');
				$('#img-evento').css('background-image', 'url(' + src + ')');
			}
		}
		var cropperHeader  = new Croppic('newImage', cropperOptions);
	}

	return {
		init: function () {
			croppic();
		}
	}
}();