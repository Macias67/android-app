/**
 * Created by Luis Macias on 05/08/2015.
 */
var Clientes = function () {

	var initTable = function () {

		var table = $('#clientes');

		table.dataTable({
			"processing"  : true,
			"serverSide"  : true,
			"ajax"        : {
				"url" : table.attr('data-url'),
				"type": "POST",
				"data": {
					"_token": table.attr('token')
				}
			},
			"columns"     : [
				{"data": "estatus"},
				{"data": "nombre"},
				{"data": "propietario"},
				{"data": "ciudad"},
				{"data": "registro"},
				{
					"data"          : null,
					"defaultContent": ''
				}
			],
			"rowCallback" : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				// Desactivado
				if (!aData.estatus) {
					$(nRow).addClass('danger');
				}
				// Checkbox
				var checkbox = (aData.estatus) ? 'checked' : '';
				$(nRow).addClass('odd gradeX');
				$('td:eq(0)', nRow).html('<input type="checkbox" class="checkboxes" ' + checkbox + '/>');
				// Enlace a la edicion
				var id = $(nRow).attr('id');
				$('td:eq(5)', nRow).html(
					'<a type="button" href="/' + id + '" class="btn btn-circle bg-yellow-casablanca btn-xs"><i class="fa fa-plus"></i></a>' +
					'<button type="button" class="btn btn-circle bg-red-thunderbird btn-xs eliminar"><i class="fa fa-trash-o"></i></button>'
				);
			},
			"drawCallback": function (settings) {
				App.initUniform($('input[type="checkbox"]', table)); // reinitialize uniform checkboxes on each table reload
			},
			// Internationalisation. For more info refer to http://datatables.net/manual/i18n
			"language"    : {
				"aria"        : {
					"sortAscending" : ": activate to sort column ascending",
					"sortDescending": ": activate to sort column descending"
				},
				"emptyTable"  : "No hay clientes registrados :(",
				"info"        : "Mostrando _START_ a _END_ de _TOTAL_ registros",
				"infoEmpty"   : "No se encontrarón registros",
				"infoFiltered": "(filtered from _MAX_ total records)",
				"lengthMenu"  : " _MENU_ resultados",
				"paging"      : {
					"previous": "Ant",
					"next"    : "Sig"
				},
				"search"      : "Buscar: ",
				"zeroRecords" : "No matching records found"
			},

			// Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
			// setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
			// So when dropdowns used the scrollable div should be removed.
			//"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

			"bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

			"lengthMenu": [
				[5, 15, 20, 50],
				[5, 15, 20, 50] // change per page values here
			],
			// set the initial value
			"pageLength": 5,
			"columnDefs": [
				{  // set default column settings
					'orderable': false,
					'targets'  : [0]
				}, {
					"searchable": false,
					"targets"   : [0]
				}
			],
			"order"     : [
				[1, "asc"]
			] // set first column as a default sort by asc
		});

		var tableWrapper = jQuery('#sample_2_wrapper');

		table.find('.group-checkable').change(function () {
			var set     = jQuery(this).attr("data-set");
			var checked = jQuery(this).is(":checked");
			jQuery(set).each(function () {
				if (checked) {
					$(this).attr("checked", true);
				}
				else {
					$(this).attr("checked", false);
				}
			});
			jQuery.uniform.update(set);
		});

		tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
	}

	return {
		init: function () {
			initTable();
		}
	}
}();

jQuery(document).ready(function () {
	Clientes.init();
});