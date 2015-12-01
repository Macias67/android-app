/**
 * Created by Luis Macias on 17/09/2015.
 */

var ProductosCliente = function () {

	var table  = $('#productos_categorias');
	var table2 = $('#productos_nombre');
	var otable = null;

	var tablaCategoria = function (id) {
		otable = table.dataTable({
			"pageLength"  : 5,
			"lengthMenu"  : [
				[5, 15, 20],
				[5, 15, 20] // change per page values here
			],
			"processing"  : true,
			"serverSide"  : true,
			"ajax"        : {
				"url" : table.attr('data-url') + '/' + id,
				"type": "POST"
			},
			"columns"     : [
				{"data": "nombre"},
				{
					"data"          : null,
					"defaultContent": ''
				}
			],
			"rowCallback" : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				$('td:eq(1)', nRow).attr('width', '10px');
				// acciones
				$('td:eq(1)', nRow).html('<a href="' + aData.url + '" class="btn blue btn-xs edita" categoria="' + aData.id + '">&nbsp;<i class="fa fa-edit"></i></a>');
			},
			"drawCallback": function (settings) {
			},
			"language"    : {
				"emptyTable"    : "No hay productos registrados",
				"info"          : "Mostrando _START_ a _END_ de _MAX_ productos",
				"infoEmpty"     : "No se ha registrado ningúna producto",
				"infoFiltered"  : "(de un total de _TOTAL_ productos registrados)",
				"infoPostFix"   : "",
				"thousands"     : ",",
				"lengthMenu"    : "_MENU_ entradas",
				"loadingRecords": "Cargando...",
				"processing"    : "Procesando...",
				"search"        : "Buscar: ",
				"zeroRecords"   : "No se encontraron coincidencias",
				"lengthMenu"    : "_MENU_ registros"
			},
			"order"       : [0, 'asc'] // Ordenados por Nombre
		});
	}

	var initTableCategoriaProducto = function () {
		var id = $('select[name="categoria_id"]').val();
		// Si existen categorias
		if (id != null) {
			tablaCategoria(id);
		}
	}

	var getCategorias = function () {
		$('select[name="categoria_id"]').on('change', function () {
			var id = $(this).val();
			if (otable) {
				table.dataTable().api().destroy();
			}
			tablaCategoria(id);
		});
	}

	var tablaNombre = function () {
		otable = table2.dataTable({
			"pageLength"  : 5,
			"lengthMenu"  : [
				[5, 15, 20],
				[5, 15, 20] // change per page values here
			],
			"processing"  : true,
			"serverSide"  : true,
			"ajax"        : {
				"url" : table.attr('data-url'),
				"type": "POST",
				"data": {
					"id_cliente": $("input[name='id_cliente']").val()
				}
			},
			"columns"     : [
				{"data": "nombre"},
				{
					"data"          : null,
					"defaultContent": ''
				}
			],
			"rowCallback" : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				$('td:eq(1)', nRow).attr('width', '10px');
				// acciones
				$('td:eq(1)', nRow).html('<a href="' + aData.url + '" class="btn blue btn-xs edita" categoria="' + aData.id + '">&nbsp;<i class="fa fa-edit"></i></a>');
			},
			"drawCallback": function (settings) {
			},
			"language"    : {
				"emptyTable"    : "No hay productos registrados",
				"info"          : "Mostrando _START_ a _END_ de _MAX_ productos",
				"infoEmpty"     : "No se ha registrado ningúna producto",
				"infoFiltered"  : "(de un total de _TOTAL_ productos registrados)",
				"infoPostFix"   : "",
				"thousands"     : ",",
				"lengthMenu"    : "_MENU_ entradas",
				"loadingRecords": "Cargando...",
				"processing"    : "Procesando...",
				"search"        : "Buscar: ",
				"zeroRecords"   : "No se encontraron coincidencias",
				"lengthMenu"    : "_MENU_ registros"
			},
			"order"       : [0, 'asc'] // Ordenados por Nombre
		});
	}

	return {
		init: function () {
			initTableCategoriaProducto();
			getCategorias();
			tablaNombre();
		}
	}
}();