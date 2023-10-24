var tabla;

function init() {
	listar();

	$('#mrPagos').addClass("treeview active");
	$('#lrOperacion').addClass("active");

	$.post("../ajax/operaciones.php?op=selectOperacion", function (r) {
		console.log(r);
		$("#idoperacion").html(r);
		$('#idoperacion').selectpicker('refresh');
	})
}

function listar() {
	$("#fecha_inicio").val("");
	$("#fecha_fin").val("");

	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	$("#buscarPorOperacion").prop("disabled", true);
	$("#buscarTodos").prop("disabled", true);
	$("#buscarPorFecha").prop("disabled", true);
	$("#resetear").prop("disabled", true);

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
				url: '../ajax/reporte_operaciones.php?op=listar',
				data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, operacion: "" },
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
			"bFilter": false,
			"createdRow": function (row, data, dataIndex) {
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7), td:eq(8), td:eq(9), td:eq(10), td:eq(11)').addClass('nowrap-cell');
			}
		}).DataTable();

	tabla.on('init.dt', function () {
		$("#buscarPorOperacion").prop("disabled", false);
		$("#buscarTodos").prop("disabled", false);
		$("#buscarPorFecha").prop("disabled", false);
		$("#resetear").prop("disabled", false);
	});
}

function buscarPorFecha() {
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

	if (fecha_inicio == "" || fecha_fin == "") {
		alert("Los campos de fecha inicial y fecha final son obligatorios.");
		return;
	} else if (fecha_inicio > fecha_fin) {
		alert("La fecha inicial no puede ser mayor que la fecha final.");
		return;
	}

	$("#idoperacion").val("");
	$("#idoperacion").selectpicker('refresh');

	$("#buscarPorOperacion").prop("disabled", true);
	$("#buscarTodos").prop("disabled", true);
	$("#buscarPorFecha").prop("disabled", true);
	$("#resetear").prop("disabled", true);

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
				url: '../ajax/reporte_operaciones.php?op=listar',
				data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, operacion: "" },
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
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7), td:eq(8), td:eq(9), td:eq(10)').addClass('nowrap-cell');
			}
		}).DataTable();

	tabla.on('init.dt', function () {
		$("#buscarPorOperacion").prop("disabled", false);
		$("#buscarTodos").prop("disabled", false);
		$("#buscarPorFecha").prop("disabled", false);
		$("#resetear").prop("disabled", false);
	});
}

function buscarPorOperacion() {
	var operacion = $("#idoperacion").val();
	var nombreOperacion = "";

	if (operacion === "") {
		alert("La operación es obligatoria.");
		return;
	} else {
		nombreOperacion = $("#idoperacion").find("option:selected").text().split(" - ")[0].trim();
	}

	$("#buscarPorOperacion").prop("disabled", true);
	$("#buscarTodos").prop("disabled", true);
	$("#buscarPorFecha").prop("disabled", true);
	$("#resetear").prop("disabled", true);

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
				url: '../ajax/reporte_operaciones.php?op=listar',
				data: { fecha_inicio: "", fecha_fin: "", operacion: nombreOperacion },
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
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7), td:eq(8), td:eq(9), td:eq(10)').addClass('nowrap-cell');
			}
		}).DataTable();

	tabla.on('init.dt', function () {
		$("#buscarPorOperacion").prop("disabled", false);
		$("#buscarTodos").prop("disabled", false);
		$("#buscarPorFecha").prop("disabled", false);
		$("#resetear").prop("disabled", false);
	});
}

function buscarTodos() {
	listar();
	$("#fecha_inicio").val("");
	$("#fecha_fin").val("");
	$("#idoperacion").val("");
	$("#idoperacion").selectpicker('refresh');
}

function resetear() {
	listar();
	$("#fecha_inicio").val("");
	$("#fecha_fin").val("");
	$("#idoperacion").val("");
	$("#idoperacion").selectpicker('refresh');
}

init();