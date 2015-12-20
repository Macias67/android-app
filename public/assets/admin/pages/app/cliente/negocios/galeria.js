var FormFileUpload = function () {

	return {
		//main function to initiate the module
		init: function () {

			$('body').append('' +
				'<div id = "blueimp-gallery" class = "blueimp-gallery blueimp-gallery-controls" data-filter = ":even">' +
				'<div class = "slides"></div>' +
				'<h3 class = "title"></h3>' +
				'<a class = "prev"> ‹ </a>' +
				'<a class = "next"> › </a>' +
				'<a class = "close white"> </a>' +
				'<a class = "play-pause"> </a>' +
				'<ol class = "indicator"></ol>' +
				'</div>');

			// Initialize the jQuery File Upload widget:
			$('#fileupload').fileupload({
				sequentialUploads : true,
				disableImageResize: false,
				autoUpload        : false,
				disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
				maxFileSize       : 5000000,
				acceptFileTypes   : /(\.|\/)(gif|jpe?g|png)$/i,
				formData          : function () {
					return $('#fileupload').serializeArray();
				}
				// Uncomment the following to send cross-domain cookies:
				//xhrFields: {withCredentials: true},
			});

			// Enable iframe cross-domain access via redirect option:
//			$('#fileupload').fileupload(
//				'option',
//				'redirect',
//				window.location.href.replace(
//					/\/[^\/]*$/,
//					'/cors/result.html?%s'
//				)
//			);

			// Upload server status check for browsers with CORS support:
			if ($.support.cors) {
				$.ajax({
					type: 'HEAD',
				}).fail(function () {
					$('<div class="alert alert-danger"/>')
						.text('Upload server currently unavailable - ' +
							new Date())
						.appendTo('#fileupload');
				});
			}

			// Load & display existing files:
			$('#fileupload').addClass('fileupload-processing');
			$.ajax({
				// Uncomment the following to send cross-domain cookies:
				//xhrFields: {withCredentials: true},
				url     : $('#fileupload').attr("action"),
				dataType: 'json',
				context : $('#fileupload')[0]
			}).always(function () {
				$(this).removeClass('fileupload-processing');
			}).done(function (result) {
				$(this).fileupload('option', 'done')
					.call(this, $.Event('done'), {result: result});
			});
		}
	};
}();

jQuery(document).on('ready', function () {
	FormFileUpload.init();
});
