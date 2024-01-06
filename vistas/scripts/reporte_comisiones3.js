var tabla;

function init() {
	listarVacio();

	$('#mrComisiones').addClass("treeview active");
	$('#lrComisiones').addClass("active");

	$.post("../ajax/usuario.php?op=selectUsuario", function (r) {
		console.log(r);
		$("#idusuario").html(r);
		$('#idusuario').selectpicker('refresh');
	})
}

function calcularTotales() {
	let totalImporte = 0;
	let totalComisiones = 0;

	let table = $('#tbllistado').DataTable();

	table.rows().every(function () {
		let rowData = this.data();
		let importeValue = parseFloat(rowData[1].replaceAll('<strong>S/. ', '').replaceAll(',', '').replaceAll('</strong>', ''));
		let comisionesValue = parseFloat(rowData[2].replaceAll('<strong>S/. ', '').replaceAll(',', '').replaceAll('</strong>', ''));

		console.log(importeValue);
		console.log(comisionesValue);

		totalImporte += importeValue;
		totalComisiones += comisionesValue;
	});

	$('#importe').text('S/. ' + totalImporte.toLocaleString('es-PE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
	$('#comision').text('S/. ' + totalComisiones.toLocaleString('es-PE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
}

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
	$("#buscarPorUsuario").prop("disabled", true);
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
				url: '../ajax/reporte_comisiones.php?op=listar',
				data: { fecha_inicio: "", fecha_fin: "", usuario: "" },
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
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7), td:eq(8)').addClass('nowrap-cell');
			}
		}).DataTable();

	tabla.on('init.dt', function () {
		$("#buscarPorUsuario").prop("disabled", false);
		$("#buscarTodos").prop("disabled", false);
		$("#buscarPorFecha").prop("disabled", false);
		$("#resetear").prop("disabled", false);
		calcularTotales();
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

	var usuario = $("#idusuario").val();
	var nombreUsuario = "";

	if (usuario != "") {
		nombreUsuario = $("#idusuario").find("option:selected").text().split(" - ")[0].trim();
	} else {
		nombreUsuario = "";
	}

	$("#buscarPorUsuario").prop("disabled", true);
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
				url: '../ajax/reporte_comisiones.php?op=listar',
				data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, usuario: nombreUsuario },
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
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7), td:eq(8)').addClass('nowrap-cell');
			}
		}).DataTable();

	tabla.on('init.dt', function () {
		$("#buscarPorUsuario").prop("disabled", false);
		$("#buscarTodos").prop("disabled", false);
		$("#buscarPorFecha").prop("disabled", false);
		$("#resetear").prop("disabled", false);
		calcularTotales();
	});
}

function buscarPorUsuario() {
	var usuario = $("#idusuario").val();
	var nombreUsuario = "";

	if (usuario === "") {
		alert("El usuario es obligatorio.");
		return;
	} else {
		nombreUsuario = $("#idusuario").find("option:selected").text().split(" - ")[0].trim();
	}

	console.log(usuario)
	console.log(nombreUsuario)

	$("#buscarPorUsuario").prop("disabled", true);
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
				url: '../ajax/reporte_comisiones.php?op=listar',
				data: { fecha_inicio: "", fecha_fin: "", usuario: nombreUsuario },
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
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7), td:eq(8)').addClass('nowrap-cell');
			}
		}).DataTable();

	tabla.on('init.dt', function () {
		$("#buscarPorUsuario").prop("disabled", false);
		$("#buscarTodos").prop("disabled", false);
		$("#buscarPorFecha").prop("disabled", false);
		$("#resetear").prop("disabled", false);
		calcularTotales();
	});
}

function buscarTodos() {
	listar();
}

function resetear() {
	listarVacio();
	$("#fecha_inicio").val("");
	$("#fecha_fin").val("");
	$("#idusuario").val("");
	$("#comision").text("S/. 0.00");
	$("#estado").text("S/. 0.00");
	$("#idusuario").selectpicker('refresh');
}

init();