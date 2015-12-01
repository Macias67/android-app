var Categorias = function () {

	var table = $('#tabla_categorias');

	var agregaCategoria = function () {
		$("#add").on('click', function () {
			var categoria = $('input[name="categoria"]').val();
			if (categoria != "") {

				var id_categoria = $('input[name="id_categoria"]').val();
				var accion       = 'store';
				var data         = {categoria: categoria};

				if (id_categoria != "") {
					accion = 'update';
					data   = {id: id_categoria, categoria: categoria};
				}

				var success = function (data) {
					App.removeLoader(500, function () {
						swal({
							title            : '<h3>' + data.titulo + '</h3>',
							text             : '<p>' + data.texto + '</p>',
							type             : "success",
							animation        : 'slide-from-top',
							html             : true,
							showConfirmButton: true
						}, function () {
							$('input[name="categoria"]').val('');
							$('input[name="categoria"]').blur();
							$('input[name="id_categoria"]').val('');
							$("#add").html('Guardar');
							location.reload(true);
						});
					});
				}
				App.initAjax(Metronic.getDomain() + 'admin/categoria/' + accion, data, success);

			}
			else {
				bootbox.alert('Debes escribir una categoría.');
			}
		});
	}

	var tablaCategoria = function () {
		var oTable = table.dataTable({
			"pageLength"  : 5,
			"lengthMenu"  : [
				[5, 15, 20],
				[5, 15, 20] // change per page values here
			],
			"processing"  : true,
			"serverSide"  : true,
			"ajax"        : {
				"url" : Metronic.getDomain() + "admin/categorias/json",
				"type": "POST"
			},
			"columns"     : [
				{"data": "categoria"},
				{
					"data"          : null,
					"defaultContent": ''
				}
			],
			"rowCallback" : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				$('td:eq(1)', nRow).attr('width', '18%');
				// acciones
				$('td:eq(1)', nRow).html('<button type="button" class="btn blue btn-xs edita" categoria="' + aData.id + '">&nbsp;<i class="fa fa-edit"></i>&nbsp;</button>' +
					'<button type="button" class="btn red btn-xs eliminar" categoria="' + aData.id + '">&nbsp;<i class="fa fa-trash-o"></i>&nbsp;</button>');
			},
			"drawCallback": function (settings) {
				Metronic.initUniform($('input[type="checkbox"]', table)); // reinitialize uniform checkboxes on each table reload
			},
			"language"    : {
				"emptyTable"    : "No hay categorías registrados",
				"info"          : "Mostrando _START_ a _END_ de _MAX_ categorías",
				"infoEmpty"     : "No se ha registrado ningúna categoría",
				"infoFiltered"  : "(de un total de _TOTAL_ categorías registrados)",
				"infoPostFix"   : "",
				"thousands"     : ",",
				"lengthMenu"    : "_MENU_ entradas",
				"loadingRecords": "Cargando...",
				"processing"    : "Procesando...",
				"search"        : "Buscar: ",
				"zeroRecords"   : "No se encontraron coincidencias",
				"lengthMenu"    : "_MENU_ registros"
			},
			"columnDefs"  : [
				{ // set default column settings
					'orderable': false,
					'targets'  : [1]
				},
				{
					"searchable": true,
					"targets"   : [0]
				}
			],
			"order"       : [0, 'asc'] // Ordenados por categoria
		});

		table.on('click', '.edita', function () {
			var id = $(this).attr('categoria');
			$.get(Metronic.getDomain() + 'admin/categoria/read/' + id, function (data) {
				$('input[name="categoria"]').val(data.categoria);
				$('input[name="id_categoria"]').val(data.id);
				$("#add").html('Editar');
			}, 'json');
		});

		table.on('click', '.eliminar', function () {
			var id = $(this).attr('categoria');
			$.post(Metronic.getDomain() + 'admin/categoria/delete', {id: id}, function (data, textStatus, xhr) {
				if (data.exito) {
					bootbox.alert(data.mensaje, function () {
						location.reload(true);
					});
				}
				else {
					bootbox.alert(data.mensaje);
				}
			}, 'json');
		});
	}

	return {
		init: function () {
			agregaCategoria();
			tablaCategoria();
		}
	}
}();