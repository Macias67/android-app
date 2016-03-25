/**
 * Created by Luis Macias on 28/08/2015.
 */

var Logotipo = function () {

	var croppic = function () {
		var token          = App.getToken();
		var id             = $('#newlogo').attr('data-id');
		var cliente_id     = $('#newlogo').attr('data-cliente-id');
		var cropperOptions = {
			uploadUrl     : $('#newlogo').attr('data-upload'),
			cropUrl       : $('#newlogo').attr('data-crop'),
			uploadData    : {
				"servicio_id": id,
				"cliente_id" : cliente_id,
				"_token"     : token
			},
			cropData      : {
				"servicio_id": id,
				"cliente_id" : cliente_id,
				"_token"     : token
			},
			modal         : true,
			imgEyecandy   : false,
			rotateControls: false,
			onAfterImgCrop: function () {
				var src = $('img.croppedImg').attr('src');
				$('#img-servicio').css('background-image', 'url(' + src + ')');
			}
		}
		var cropperHeader  = new Croppic('newlogo', cropperOptions);
	}

	return {
		init: function () {
			croppic();
		}
	}
}();

jQuery(document).ready(function () {
	Logotipo.init();
});