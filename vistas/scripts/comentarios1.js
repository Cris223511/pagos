var tabla;

function init() {
	mostrarform(false);
	listar();

	$('#mConversacion').addClass("treeview active");
	$('#lComentarios').addClass("active");

	$.post("../ajax/usuario.php?op=receptores", function (r) {
		console.log(r);
		$("#emisor").html(r);
		$('#emisor').selectpicker('refresh')
		$("#receptor").html(r);
		$('#receptor').selectpicker('refresh');
	})
}

function limpiar() {
	$("#emisor").val("");
	$("#receptor").val("");
	$("#asunto").val("");
	$("#mensaje").val("");
}

function mostrarform(flag) {
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
	}
	else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
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
				url: '../ajax/comentarios.php?op=listar',
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
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(5)').addClass('nowrap-cell');
			}
		}).DataTable();
}

function mostrar(idconversacion) {
	$.post("../ajax/comentarios.php?op=mostrar", { idconversacion: idconversacion }, function (data, status) {
		console.log(data);
		data = JSON.parse(data);
		mostrarform(true);

		console.log(data);

		$("#emisor").val(data.emisorID);
		$("#emisor").selectpicker('refresh');
		$("#receptor").val(data.receptorID);
		$("#receptor").selectpicker('refresh');
		$("#asunto").val(data.asunto);
		$("#mensaje").val(data.mensaje);
		$("#idconversacion").val(data.idconversacion);
	})
}

init();