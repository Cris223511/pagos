var tabla;

function init() {
	listar();

	$('#mrComisiones').addClass("treeview active");
	$('#lrComisiones').addClass("active");

	$.post("../ajax/usuario.php?op=selectUsuarios", function (r) {
		console.log(r);
		$("#idusuario").html(r);
		$('#idusuario').selectpicker('refresh');
	})
}

function listar() {
	$("#fecha_inicio").val("");
	$("#fecha_fin").val("");

	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();

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
				data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, usuario: "" },
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
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7), td:eq(8), td:eq(9), td:eq(10)').addClass('nowrap-cell');
			}
		}).DataTable();

	tabla.on('init.dt', function () {
		$("#buscarPorUsuario").prop("disabled", false);
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

	$("#idusuario").val("");
	$("#idusuario").selectpicker('refresh');

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
				data: { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, usuario: "" },
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
		$("#buscarPorUsuario").prop("disabled", false);
		$("#buscarTodos").prop("disabled", false);
		$("#buscarPorFecha").prop("disabled", false);
		$("#resetear").prop("disabled", false);
	});
}

function buscarPorUsuario() {
	var usuario = $("#idusuario").val();
	var nombreUsuario = "";

	if (usuario === "") {
		alert("El usuario es obligatoria.");
		return;
	} else {
		nombreUsuario = $("#idusuario").find("option:selected").text().trim();
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
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7), td:eq(8), td:eq(9), td:eq(10), td:eq(10)').addClass('nowrap-cell');
			}
		}).DataTable();

	tabla.on('init.dt', function () {
		$("#buscarPorUsuario").prop("disabled", false);
		$("#buscarTodos").prop("disabled", false);
		$("#buscarPorFecha").prop("disabled", false);
		$("#resetear").prop("disabled", false);
	});
}

function buscarTodos() {
	listar();
	$("#fecha_inicio").val("");
	$("#fecha_fin").val("");
	$("#idusuario").val("");
	$("#idusuario").selectpicker('refresh');
}

function resetear() {
	listar();
	$("#fecha_inicio").val("");
	$("#fecha_fin").val("");
	$("#idusuario").val("");
	$("#idusuario").selectpicker('refresh');
}

init();