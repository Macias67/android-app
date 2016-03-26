/**
 * Created by Luis on 24/03/2016.
 */

var Tags = function() {
	
	var handleDemo = function() {
		
		// Set the "bootstrap" theme as the default theme for all Select2
		// widgets.
		//
		// @see https://github.com/select2/select2/issues/2927
		$.fn.select2.defaults.set('theme', 'bootstrap');

		$(".select-tags").select2({
			placeholder: "",
			language: "es",
			width: null,
			tags: true,
			tokenSeparators: [','],
			maximumSelectionLength: 20,
			allowClear: true
		});

		$("button[data-select2-open]").click(function() {
			$("#" + $(this).data("select2-open")).select2("open");
		});
		
		// copy Bootstrap validation states to Select2 dropdown
		//
		// add .has-waring, .has-error, .has-succes to the Select2 dropdown
		// (was #select2-drop in Select2 v3.x, in Select2 v4 can be selected via
		// body > .select2-container) if _any_ of the opened Select2's parents
		// has one of these forementioned classes (YUCK! ;-))
		$(".select2, .select2-multiple, .select2-allow-clear, .js-data-example-ajax").on("select2:open", function() {
			if ($(this).parents("[class*='has-']").length) {
				var classNames = $(this).parents("[class*='has-']")[0].className.split(/\s+/);
				
				for (var i = 0; i < classNames.length; ++i) {
					if (classNames[i].match("has-")) {
						$("body > .select2-container").addClass(classNames[i]);
					}
				}
			}
		});
	}
	
	var guardaTags = function() {
		$('form#formtags').on('click', 'button', function (e) {
			e.preventDefault();
			var url = $('form#formtags').attr('action');
			var data = $('form#formtags').serialize();
			console.log(data);
// 			var success = function (data) {
// 				MyApp.removeLoader(500, function () {
// 					swal({
// 							title             : '<h3>' + data.titulo + '</h3>',
// 							text : '<p>' + data.texto + '</p>',
// 							html : true,
// 							type : "success",
// 							animation: 'slide-from-top',
// 							confirmButtonColor: App.getBrandColor('green'),
// 							confirmButtonText : "OK"
// 						});
// 				});
// 			}
// 			MyApp.initAjax(url, data, success);
		});
	}
	
	return {
		//main function to initiate the module
		init: function() {
			handleDemo();
			guardaTags();
		}
	};
	
}();

jQuery(document).ready(function () {
	Tags.init();
});