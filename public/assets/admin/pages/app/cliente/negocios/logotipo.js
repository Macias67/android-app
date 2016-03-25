/**
 * Created by Luis Macias on 04/09/2015.
 */

var Logo = function () {
	var croppic = function () {
		var token          = MyApp.getToken();
		var id             = $('#newlogo').attr('data-id');
		var cropperOptions = {
			uploadUrl     : $('#newlogo').attr('data-upload'),
			cropUrl       : $('#newlogo').attr('data-crop'),
			uploadData    : {
				"cliente_id": id,
				"_token"    : token
			},
			cropData      : {
				"cliente_id": id,
				"_token"    : token
			},
			modal         : true,
			imgEyecandy   : false,
			rotateControls: false,
			onAfterImgCrop: function () {
				var src = $('img.croppedImg').attr('src');
				$('img#logo').attr('src', src);
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
	Logo.init();
});