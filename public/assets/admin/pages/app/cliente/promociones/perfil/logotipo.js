/**
 * Created by Luis Macias on 28/08/2015.
 */

var Logotipo = function () {

	var croppic = function () {
		var token = MyApp.getToken();
		var id    = $('#newlogo').attr('data-id');
		console.log(id);
		var cliente_id     = $('#newlogo').attr('data-cliente-id');
		var cropperOptions = {
			uploadUrl     : $('#newlogo').attr('data-upload'),
			cropUrl       : $('#newlogo').attr('data-crop'),
			uploadData    : {
				"promocion_id": id,
				"cliente_id"  : cliente_id,
				"_token"      : token
			},
			cropData      : {
				"promocion_id": id,
				"cliente_id"  : cliente_id,
				"_token"      : token
			},
			modal         : true,
			imgEyecandy   : false,
			rotateControls: false,
			onAfterImgCrop: function () {
				var src = $('img.croppedImg').attr('src');
				console.log(src);
				$('#img-promocion').css('background-image', 'url(' + src + ')');
			}
		}
		var cropperHeader  = new Croppic('newlogo', cropperOptions);
		console.log(cropperHeader);
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