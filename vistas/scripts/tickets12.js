var tabla;
var siguienteCorrelativo = "";
var localSession = "";

function bloquearCampos() {
	$("input, select, textarea").not("#local_ruc").prop("disabled", true);
}

function desbloquearCampos() {
	$("input, select, textarea").not("#local_ruc").prop("disabled", false);
}

function actualizarCorrelativo() {
	$.post("../ajax/tickets.php?op=getLastNumTicket", function (e) {
		console.log(e);
		siguienteCorrelativo = generarSiguienteCorrelativo(e);
		$("#num_ticket").val(siguienteCorrelativo);
	});
}

function generarSiguienteCorrelativo(correlativoActual) {
	const siguienteNumero = Number(correlativoActual) + 1;
	const longitudTotal = correlativoActual.length; // Obtener la longitud total del correlativo actual
	const siguienteCorrelativo = siguienteNumero.toString().padStart(longitudTotal, "0");
	return siguienteCorrelativo;
}

function init() {
	mostrarform(false);
	listar();

	$("#visualizar").hide();

	$('#mTicket').addClass("treeview active");
	$('#lTicket').addClass("active");

	$.post("../ajax/tickets.php?op=listarTodosActivos", function (data) {
		console.log(data)
		const obj = JSON.parse(data);
		localSession = obj.idlocal_session[0].id;
		console.log(obj);

		const selects = {
			"idbanco": $("#idbanco"),
			"idoperacion": $("#idoperacion"),
			"idlocal": $("#idlocal"),
		};

		for (const selectId in selects) {
			if (obj.hasOwnProperty('correlativo') && obj.correlativo.length > 0) {
				const correlativoActual = obj.correlativo[0].titulo;
				siguienteCorrelativo = generarSiguienteCorrelativo(correlativoActual);
				$("#num_ticket").val(siguienteCorrelativo);
			}

			if (selects.hasOwnProperty(selectId)) {
				const select = selects[selectId];
				const atributo = selectId.replace('id', '');

				if (obj.hasOwnProperty(atributo)) {
					select.empty();
					select.html('<option value="">- Seleccione -</option>');
					obj[atributo].forEach(function (opcion) {
						if (atributo != "local") {
							select.append('<option value="' + opcion.id + '">' + opcion.titulo + ' - ' + opcion.usuario + '</option>');
						} else {
							select.append('<option value="' + opcion.id + '" data-local-ruc="' + opcion.ruc + '">' + opcion.titulo + ' - ' + opcion.usuario + '</option>');
						}
					});
					select.selectpicker('refresh');
				}
			}
		}

		$("#idlocal").val(localSession);
		$("#idlocal").selectpicker('refresh');
		actualizarRUC();
	});
}

function actualizarRUC() {
	const selectLocal = document.getElementById("idlocal");
	const localRUCInput = document.getElementById("local_ruc");
	const selectedOption = selectLocal.options[selectLocal.selectedIndex];

	if (selectedOption.value !== "") {
		const localRUC = selectedOption.getAttribute('data-local-ruc');
		localRUCInput.value = localRUC;
	} else {
		localRUCInput.value = "";
	}
}

function limpiar() {
	desbloquearCampos();

	$("#idticket").val("");
	$(':input').not(':button, :submit, :reset, :hidden, #local_ruc')
		.prop('checked', false)
		.prop('selected', false)
		.not(':checkbox, :radio, select').val('');

	$("select").not('#idlocal').each(function (index) {
		$(this).val($(this).find('option:first').val());
		$(this).selectpicker('refresh');
	});

	$("#idlocal").val(localSession);
	$("#idlocal").selectpicker('refresh');
	actualizarRUC();
}

function mostrarform(flag) {
	limpiar();
	if (flag) {
		$("#listadoregistros").hide();
		$(".formularioregistros").show();
		$("#btnGuardar").prop("disabled", false);
		$("#btnagregar").hide();
		$("#num_ticket").val(siguienteCorrelativo);
	}
	else {
		$("#listadoregistros").show();
		$(".formularioregistros").hide();
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
				url: '../ajax/tickets.php?op=listar',
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
				$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7), td:eq(8), td:eq(9), td:eq(10), td:eq(11)').addClass('nowrap-cell');
			}
		}).DataTable();
}

function guardaryeditar(e) {
	e.preventDefault();
	console.log(e.target.id);
	if (e.target.id === "btnGuardar") {
		event1();
	} else {
		event2();
	}
};

function event1() {
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/tickets.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function (datos) {
			if (datos == "El número de ticket ya existe.") {
				bootbox.alert(datos);
				$("#btnGuardar").prop("disabled", false);
				return;
			}
			bootbox.alert(datos);
			mostrarform(false);
			tabla.ajax.reload();
			limpiar();
			actualizarCorrelativo();
		},
	});
}

function event2() {
	$("#btnGuardar2").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);
	console.log("hago el guardar2 =)");
	$.ajax({
		url: "../ajax/tickets.php?op=guardaryeditar2",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function (datos) {
			console.log(datos);
			if (datos == "El número de ticket ya existe.") {
				bootbox.alert(datos);
				$("#btnGuardar2").prop("disabled", false);
				return;
			}
			var response = JSON.parse(datos);
			console.log(response);
			bootbox.alert(response.rpta);

			if (response.rpta === "Ticket registrado" && response.idticket) {
				$("#btnGuardar2").prop("disabled", false);
				$("#visualizar").show();
				$("#visualizar").attr("href", "");
				$("#visualizar").attr("href", "../reportes/exTicket.php?id=" + response.idticket);
			} else {
				$("#visualizar").hide();
			}

			limpiar();
			actualizarCorrelativo();
		}
	}
	);
}

function mostrar(idticket) {
	$.post("../ajax/tickets.php?op=mostrar", { idticket: idticket }, function (data, status) {
		// console.log(data);
		data = JSON.parse(data);
		mostrarform(true);

		console.log(data);

		$("#idticket").val(data.idticket);
		$("#idticket").selectpicker('refresh');
		$("#idbanco").val(data.idbanco);
		$("#idbanco").selectpicker('refresh');
		$("#idoperacion").val(data.idoperacion);
		$("#idoperacion").selectpicker('refresh');
		$("#idlocal").val(data.idlocal);
		$("#idlocal").selectpicker('refresh');
		$("#num_ticket").val(data.num_ticket);
		$("#num_ope").val(data.num_ope);
		$("#tipo_letra").val(data.tipo_letra);
		$("#tipo_letra").selectpicker('refresh');
		$("#importe").val(Number(data.importe));
		$("#comision").val(Number(data.comision));
		$("#descripcion").val(data.descripcion);

		actualizarRUC();
	})
}

function detalles(idticket) {
	$.post("../ajax/tickets.php?op=mostrar", { idticket: idticket }, function (data, status) {
		// console.log(data);
		data = JSON.parse(data);
		mostrarform(true);
		bloquearCampos();
		$("#btnGuardar").hide();

		console.log(data);

		$("#idticket").val(data.idticket);
		$("#idticket").selectpicker('refresh');
		$("#idbanco").val(data.idbanco);
		$("#idbanco").selectpicker('refresh');
		$("#idoperacion").val(data.idoperacion);
		$("#idoperacion").selectpicker('refresh');
		$("#idlocal").val(data.idlocal);
		$("#idlocal").selectpicker('refresh');
		$("#num_ticket").val(data.num_ticket);
		$("#num_ope").val(data.num_ope);
		$("#tipo_letra").val(data.tipo_letra);
		$("#tipo_letra").selectpicker('refresh');
		$("#importe").val(Number(data.importe));
		$("#comision").val(Number(data.comision));
		$("#descripcion").val(data.descripcion);

		actualizarRUC();
	})
}

function desactivar(idticket) {
	bootbox.confirm("¿Está seguro de desactivar el ticket?", function (result) {
		if (result) {
			$.post("../ajax/tickets.php?op=desactivar", { idticket: idticket }, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idticket) {
	bootbox.confirm("¿Está seguro de activar el ticket?", function (result) {
		if (result) {
			$.post("../ajax/tickets.php?op=activar", { idticket: idticket }, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function eliminar(idticket) {
	bootbox.confirm("¿Estás seguro de eliminar el ticket?", function (result) {
		if (result) {
			$.post("../ajax/tickets.php?op=eliminar", { idticket: idticket }, function (e) {
				bootbox.alert(e);
				tabla.ajax.reload();
				actualizarCorrelativo();
			});
		}
	})
}

init();