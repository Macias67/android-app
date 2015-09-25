/**
 * Created by Julio on 22/09/2015.
 */

var EventosCliente = function() {

    var tableActivos = $('#eventos_activos');
    var tablePasados = $('#eventos_pasados');
    var otable = null;

    var tablaActivos = function() {
        otable = tableActivos.dataTable({
            "pageLength": 5,
            "lengthMenu": [
                [5, 15, 20],
                [5, 15, 20] // change per page values here
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": tableActivos.attr('data-url'),
                "type": "POST",
                "data" : {
                    "id_cliente" : $("input[name='id_cliente']").val()
                }
            },
            "columns": [
                { "data": "nombre" },
                {
                    "data": null,
                    "defaultContent": ''
                }
            ],
            "rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                console.log(aData);
                $('td:eq(1)', nRow).attr('width', '10px');
                // acciones
                $('td:eq(1)', nRow).html('<a href="'+aData.url+'" class="btn blue btn-xs edita" evento="'+aData.id+'">&nbsp;<i class="fa fa-edit"></i></a>');
            },
            "drawCallback": function(settings) {},
            "language": {
                "emptyTable": 		"No hay eventos registrados",
                "info": 			"Mostrando _START_ a _END_ de _MAX_ eventos",
                "infoEmpty": 		"No se ha registrado ningún evento",
                "infoFiltered": 	"(de un total de _TOTAL_ eventos registrados)",
                "infoPostFix": 		"",
                "thousands": 		",",
                "lengthMenu": 		"_MENU_ entradas",
                "loadingRecords": 	"Cargando...",
                "processing": 		"Procesando...",
                "search": 			"Buscar: ",
                "zeroRecords": 	    "No se encontraron coincidencias",
                "lengthMenu": 		"_MENU_ registros"
            },
            "order": [0, 'asc' ] // Ordenados por Nombre
        });
    }

    var tablaPasados = function() {
        otable = tablePasados.dataTable({
            "pageLength": 5,
            "lengthMenu": [
                [5, 15, 20],
                [5, 15, 20] // change per page values here
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": tablePasados.attr('data-url'),
                "type": "POST",
                "data" : {
                    "id_cliente" : $("input[name='id_cliente']").val()
                }
            },
            "columns": [
                { "data": "nombre" },
                {
                    "data": null,
                    "defaultContent": ''
                }
            ],
            "rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $('td:eq(1)', nRow).attr('width', '10px');
                // acciones
                $('td:eq(1)', nRow).html('<a href="'+aData.url+'" class="btn blue btn-xs edita" evento="'+aData.id+'">&nbsp;<i class="fa fa-edit"></i></a>');
            },
            "drawCallback": function(settings) {},
            "language": {
                "emptyTable": 		"No hay eventos registrados",
                "info": 			"Mostrando _START_ a _END_ de _MAX_ eventos",
                "infoEmpty": 		"No se ha registrado ningún evento",
                "infoFiltered": 	"(de un total de _TOTAL_ eventos registrados)",
                "infoPostFix": 		"",
                "thousands": 		",",
                "lengthMenu": 		"_MENU_ entradas",
                "loadingRecords": 	"Cargando...",
                "processing": 		"Procesando...",
                "search": 			"Buscar: ",
                "zeroRecords": 	    "No se encontraron coincidencias",
                "lengthMenu": 		"_MENU_ registros"
            },
            "order": [0, 'asc' ] // Ordenados por Nombre
        });
    }

    return {
        init: function() {
            tablaActivos();
            tablaPasados();
        }
    }
}();