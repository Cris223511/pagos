var tabla;

function init() {
	listarVacio();

	$('#mrPagos').addClass("treeview active");
	$('#lrBanco').addClass("active");

	$.post("../ajax/bancos.php?op=selectBanco", function (r) {
		console.log(r);
		$("#idbanco").html(r);
		$('#idbanco').selectpicker('refresh');
	})
}

// function calcularTotales() {
// 	let totalImporte = 0;
// 	let totalComisiones = 0;

// 	let table = $('#tbllistado').DataTable();

// 	table.rows().every(function () {
// 		let rowData = this.data();
// 		let importeValue = parseFloat(rowData[10].replaceAll('S/. ', '').replaceAll(',', ''));
// 		let comisionesValue = parseFloat(rowData[11].replaceAll('S/. ', '').replaceAll(',', ''));

// 		console.log(importeValue);
// 		console.log(comisionesValue);

// 		totalImporte += importeValue;
// 		totalComisiones += comisionesValue;
// 	});

// 	$('#importe').text('S/. ' + totalImporte.toLocaleString('es-PE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
// 	$('#comision').text('S/. ' + totalComisiones.toLocaleString('es-PE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
// }

function listarVacio() {
	if ($.fn.DataTable.isDataTable('#tbllistado')) {
		$('#tbllistado').DataTable().destroy();
	}

	$("#fecha_inicio").val("");
	$("#fecha_fin").val("");

	tabla = $('#tbllistado').dataTable(
		{
			"lengthMenu": [5, 10, 25, 75, 100],
			"aProcessing": false,
			"aServerSide": false,
			"data": [],
			"language": {
				"emptyTable": "Sin datos por mostrar"
			},
			"bDestroy": true,
			"iDisplayLength": 5,
			"order": [],
			"bFilter": false,
			"createdRow": function (row, data, dataIndex) {
				$(row).find('td').addClass('nowrap-cell');
			}
		}).DataTable();
}

function listar() {
	$("#buscarPorBanco").prop("disabled", true);
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
				url: '../ajax/reporte_bancos.php?op=listar',
				data: { fecha_inicio: "", fecha_fin: "", banco: "" },
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
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7)').addClass('nowrap-cell');
			}
		}).DataTable();

	tabla.on('init.dt', function () {
		$("#buscarPorBanco").prop("disabled", false);
		$("#buscarTodos").prop("disabled", false);
		$("#buscarPorFecha").prop("disabled", false);
		$("#resetear").prop("disabled", false);
		// calcularTotales();
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

	var banco = $("#idbanco").val();
	var nombreBanco = "";

	if (banco != "") {
		nombreBanco = $("#idbanco").find("option:selected").text().split(" - ")[0].trim();
	} else {
		nombreBanco = "";
	}

	$("#buscarPorBanco").prop("disabled", true);
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
				url: '../ajax/reporte_bancos.php?op=listar',
				data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, banco: nombreBanco },
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
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7)').addClass('nowrap-cell');
			}
		}).DataTable();

	tabla.on('init.dt', function () {
		$("#buscarPorBanco").prop("disabled", false);
		$("#buscarTodos").prop("disabled", false);
		$("#buscarPorFecha").prop("disabled", false);
		$("#resetear").prop("disabled", false);
		// calcularTotales();
	});
}

function buscarPorBanco() {
	var banco = $("#idbanco").val();
	var nombreBanco = "";

	if (banco === "") {
		alert("El banco es obligatorio.");
		return;
	} else {
		nombreBanco = $("#idbanco").find("option:selected").text().split(" - ")[0].trim();
	}

	$("#buscarPorBanco").prop("disabled", true);
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
				url: '../ajax/reporte_bancos.php?op=listar',
				data: { fecha_inicio: "", fecha_fin: "", banco: nombreBanco },
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
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7)').addClass('nowrap-cell');
			}
		}).DataTable();

	tabla.on('init.dt', function () {
		$("#buscarPorBanco").prop("disabled", false);
		$("#buscarTodos").prop("disabled", false);
		$("#buscarPorFecha").prop("disabled", false);
		$("#resetear").prop("disabled", false);
		// calcularTotales();
	});
}

function buscarTodos() {
	listar();
}

function resetear() {
	listarVacio();
	$("#fecha_inicio").val("");
	$("#fecha_fin").val("");
	$("#idbanco").val("");
	$("#idbanco").selectpicker('refresh');
}

init();