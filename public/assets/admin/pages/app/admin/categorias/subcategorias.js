var Subcategorias = function() {

	var tableSubcategoria 	= $('#tabla_subcategorias');
	var oTable 				= null;

	var TableSub = function(id) {
		oTable = tableSubcategoria.dataTable({
			"pageLength": 5,
			"lengthMenu": [
				[5, 15, 20],
				[5, 15, 20] // change per page values here
			],
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": tableSubcategoria.attr('data-url')+'/'+id,
				"type": "POST"
			},
			"columns": [
				{ "data": "subcategoria" },
				{
					"data": null,
					"defaultContent": ''
				}
			],
			"rowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				// acciones
				$('td:eq(1)', nRow).html('<button type="button" class="btn blue btn-xs edita" subcategoria="'+aData.id+'">&nbsp;<i class="fa fa-edit"></i>&nbsp;</button>'+
				                         '<button type="button" class="btn red btn-xs eliminar" subcategoria="'+aData.id+'">&nbsp;<i class="fa fa-trash-o"></i>&nbsp;</button>');
			},
			"drawCallback": function(settings) {
				Metronic.initUniform($('input[type="checkbox"]', tableSubcategoria)); // reinitialize uniform checkboxes on each table reload
			},
			"language": {
				"emptyTable": 		"No hay subcategorías registrados",
				"info": 				"Mostrando _START_ a _END_ de _MAX_ subcategorías",
				"infoEmpty": 		"No se ha registrado ningúna categoría",
				"infoFiltered": 		"(de un total de _TOTAL_ subcategorías registrados)",
				"infoPostFix": 		"",
				"thousands": 		",",
				"lengthMenu": 		"_MENU_ entradas",
				"loadingRecords": 	"Cargando...",
				"processing": 		"Procesando...",
				"search": 			"Buscar: ",
				"zeroRecords": 	"No se encontraron coincidencias",
				"lengthMenu": 		"_MENU_ registros"
			},
			"columnDefs": [
				{ // set default column settings
					'orderable': false,
					'targets': [1]
				},
				{
					"searchable": true,
					"targets": [0]
				}
			],
			"order": [0, 'asc' ] // Ordenados por subcategoria
		});
	}

	var initSubcategoria = function() {
		var id 		= $('select[name="categoria"]').val();
		// Si existen categorias
		if (id != null) {
			TableSub(id);
		}
	}

	var getSubcategorias = function() {
		$('select[name="categoria"]').on('change', function() {
			var id = $(this).val();
			if(oTable) {
				tableSubcategoria.dataTable().api().destroy();
			}
			TableSub(id);
		});
	}

	var gestionaSubcategoria = function() {
		tableSubcategoria.on('click', '.edita',function() {
			var id = $(this).attr('subcategoria');
			$.post(Metronic.getDomain()+'admin/subcategoria/read', {id:id}, function(data, textStatus, xhr) {
				$('input[name="subcategoria"]').val(data.subcategoria);
				$('input[name="subcategoria_id"]').val(data.id);
				$("#add_sub").html('Editar');
			}, 'json');
		});

		tableSubcategoria.on('click', '.eliminar',function() {
			var id = $(this).attr('subcategoria');
			$.post(Metronic.getDomain()+'admin/subcategoria/delete', {id:id}, function(data, textStatus, xhr) {
				if (data.exito) {
					bootbox.alert(data.mensaje, function() {
						// location.reload(true);
						tableSubcategoria.dataTable().api().ajax.reload();
					});
				} else {
					bootbox.alert(data.mensaje);
				}
			}, 'json');
		});
	}

	var addSubcategoria = function() {
		$("#add_sub").on('click', function() {
			var sub 			= $('input[name="subcategoria"]').val();
			if (sub != "") {
				var categoria 	= $('select[name="categoria"] option:selected').val();
				var id 			= $('input[name="subcategoria_id"]').val();
				var accion 		= 'create';
				var data 		= {categoria_id:categoria, sub:sub};

				if (id != "") {
					accion = 'update';
					data = {id:id, categoria_id:categoria, sub:sub};
				}

				$.post(Metronic.getDomain()+'admin/subcategoria/'+accion, data, function(data, textStatus, xhr) {
					if (data.exito) {
						bootbox.alert(data.mensaje, function() {
							// window.location.replace(data.redirect);
							tableSubcategoria.dataTable().api().ajax.reload();
							$('input[name="subcategoria"]').val('');
							$('input[name="subcategoria_id"]').val('');
							$("#add_sub").html('Guardar');
						});
					} else {
						bootbox.alert(data.mensaje);
					}
				}, 'json');
			} else {
				bootbox.alert('Debes escribir una subcategoría.');
			}
		});
	}

	return {
		init: function() {
			initSubcategoria();
			getSubcategorias();
			gestionaSubcategoria();
			addSubcategoria();
		}
	}
}();