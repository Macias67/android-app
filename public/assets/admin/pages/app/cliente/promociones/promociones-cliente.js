/**
 * Created by Julio on 30/09/2015.
 */

var PromocionesCliente = function () {

	var tableVigentes = $('#promociones_vigentes');
	var tableFijas    = $('#promociones_fijas');
	var tableCaducas  = $('#promociones_caducas');
	var otable        = null;

	var tablaVigentes = function () {
		otable = tableVigentes.dataTable({
			"pageLength"  : 5,
			"lengthMenu"  : [
				[5, 15, 20],
				[5, 15, 20] // change per page values here
			],
			"processing"  : true,
			"serverSide"  : true,
			"ajax"        : {
				"url" : tableVigentes.attr('data-url'),
				"type": "POST",
				"data": {
					"id_cliente": $("input[name='id_cliente']").val(),
					"_token": MyApp.getToken()
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
				$('td:eq(1)', nRow).html('<a href="' + aData.url + '" class="btn blue btn-xs edita" promocion="' + aData.id + '">&nbsp;<i class="fa fa-edit"></i></a>');
			},
			"drawCallback": function (settings) {
			},
			"language"    : {
				"emptyTable"    : "No hay promociones registradas",
				"info"          : "Mostrando _START_ a _END_ de _MAX_ promociones",
				"infoEmpty"     : "No se han registrado promociones",
				"infoFiltered"  : "(de un total de _TOTAL_ promociones registradas)",
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

	var tablaFijas = function () {
		otable = tableFijas.dataTable({
			"pageLength"  : 5,
			"lengthMenu"  : [
				[5, 15, 20],
				[5, 15, 20] // change per page values here
			],
			"processing"  : true,
			"serverSide"  : true,
			"ajax"        : {
				"url" : tableFijas.attr('data-url'),
				"type": "POST",
				"data": {
					"id_cliente": $("input[name='id_cliente']").val(),
					"_token": MyApp.getToken()
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
				"emptyTable"    : "No hay promociones registradas",
				"info"          : "Mostrando _START_ a _END_ de _MAX_ promociones",
				"infoEmpty"     : "No se han registrado promociones",
				"infoFiltered"  : "(de un total de _TOTAL_ promociones registradas)",
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

	var tablaCaducas = function () {
		otable = tableCaducas.dataTable({
			"pageLength"  : 5,
			"lengthMenu"  : [
				[5, 15, 20],
				[5, 15, 20] // change per page values here
			],
			"processing"  : true,
			"serverSide"  : true,
			"ajax"        : {
				"url" : tableCaducas.attr('data-url'),
				"type": "POST",
				"data": {
					"id_cliente": $("input[name='id_cliente']").val(),
					"_token": MyApp.getToken()
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
				"emptyTable"    : "No hay promociones registradas",
				"info"          : "Mostrando _START_ a _END_ de _MAX_ promociones",
				"infoEmpty"     : "No se han registrado promociones",
				"infoFiltered"  : "(de un total de _TOTAL_ promociones registradas)",
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
			tablaVigentes();
			tablaFijas();
			tablaCaducas();
		}
	}
}();

jQuery(document).ready(function () {
	PromocionesCliente.init();
});