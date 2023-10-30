var tabla;

function init() {
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function (e) {
		guardaryeditar(e);
	});
	$('#mTicket').addClass("treeview active");
	$('#lOperacion').addClass("active");
}

function limpiar() {
	$("#idoperacion").val("");
	$("#titulo").val("");
	$("#descripcion").val("");
}

function mostrarform(flag) {
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled", false);
		$("#btnagregar").hide();
	}
	else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

function cancelarform() {
	limpiar();
	mostrarform(false);
}

function listar() {
	tabla = $('#tbllistado').dataTable(
		{
			"lengthMenu": [5, 10, 25, 75, 100],
			"aProcessing": true,
			"aServerSide": true,
			dom: '<Bl<f>rtip>',
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
			],
			"ajax":
			{
				url: '../ajax/operaciones.php?op=listar',
				type: "get",
				dataType: "json",
				error: function (e) {
					console.log(e.responseText);
				}
			},
			"language": {
				"lengthMenu": "Mostrar : _MENU_ registros",
				"buttons": {
					"copyTitle": "Tabla Copiada",
					"copySuccess": {
						_: '%d líneas copiadas',
						1: '1 línea copiada'
					}
				}
			},
			"bDestroy": true,
			"iDisplayLength": 5,
			"order": [],
			"createdRow": function (row, data, dataIndex) {
				$(row).find('td:eq(0), td:eq(1), td:eq(3), td:eq(4), td:eq(5), td:eq(6)').addClass('nowrap-cell');
			}
		}).DataTable();
}

function guardaryeditar(e) {
	e.preventDefault();
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/operaciones.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function (datos) {
			if (datos == "El nombre de la operación ya existe.") {
				bootbox.alert(datos);
				$("#btnGuardar").prop("disabled", false);
				return;
			}
			limpiar();
			bootbox.alert(datos);
			mostrarform(false);
			tabla.ajax.reload();
		}
	});
}

function mostrar(idoperacion) {
	$.post("../ajax/operaciones.php?op=mostrar", { idoperacion: idoperacion }, function (data, status) {
		data = JSON.parse(data);
		mostrarform(true);

		console.log(data);

		$("#titulo").val(data.titulo);
		$("#descripcion").val(data.descripcion);
		$("#idoperacion").val(data.idoperacion);
	})
}

function desactivar(idoperacion) {
	bootbox.confirm("¿Está seguro de desactivar la operación?", function (result) {
		if (result) {
			$.post("../ajax/operaciones.php?op=desactivar", { idoperacion: idoperacion }, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idoperacion) {
	bootbox.confirm("¿Está seguro de activar la operación?", function (result) {
		if (result) {
			$.post("../ajax/operaciones.php?op=activar", { idoperacion: idoperacion }, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function eliminar(idoperacion) {
	bootbox.confirm("¿Estás seguro de eliminar la operación?", function (result) {
		if (result) {
			$.post("../ajax/operaciones.php?op=eliminar", { idoperacion: idoperacion }, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();