var tabla;
// var idSession;

function init() {
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function (e) {
		guardaryeditar(e);
	})

	$('#mConversacion').addClass("treeview active");
	$('#lAsignarComentarios').addClass("active");

	$.post("../ajax/usuario.php?op=emisores", function (r) {
		console.log(r);
		$("#emisor").html(r);
		$('#emisor').selectpicker('refresh');
		$('#emisor option:eq(1)').prop('selected', true);
		$("#emisor").selectpicker('refresh');
	})

	$.post("../ajax/usuario.php?op=receptores", function (r) {
		console.log(r);
		$("#receptor").html(r);
		$('#receptor').selectpicker('refresh');
	})
}

function limpiar() {
	// $("#emisor").val(idSession);
	// $("#emisor").selectpicker('refresh');
	$('#emisor option:eq(1)').prop('selected', true);
	$("#emisor").selectpicker('refresh');
	$("#receptor").val("");
	$("#receptor").selectpicker('refresh');
	$("#asunto").val("");
	$("#mensaje").val("");
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
				url: '../ajax/comentarios.php?op=listar2',
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

function guardaryeditar(e) {
	e.preventDefault();
	$("#btnGuardar").prop("disabled", true);

	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/comentarios.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function (datos) {
			limpiar();
			bootbox.alert(datos);
			mostrarform(false);
			tabla.ajax.reload();
		}
	});
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

function eliminar(idconversacion) {
	bootbox.confirm("¿Estás seguro de eliminar el comentario?", function (result) {
		if (result) {
			$.post("../ajax/comentarios.php?op=eliminar", { idconversacion: idconversacion }, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();