<?php
ob_start();
if (strlen(session_id()) < 1) {
	session_start(); //Validamos si existe o no la sesión
}

if (empty($_SESSION['idusuario']) || empty($_SESSION['cargo'])) {
	echo 'No está autorizado para realizar esta acción.';
	exit();
}

if (!isset($_SESSION["nombre"])) {
	header("Location: ../vistas/login.html");
} else {
	if ($_SESSION['rComisiones'] == 1) {
		require_once "../modelos/Reporte_comisiones.php";

		$tickets = new ReporteComisiones();

		// Variables de sesión a utilizar.
		$idusuario = $_SESSION["idusuario"];
		$cargo = $_SESSION["cargo"];

		switch ($_GET["op"]) {

			case 'listar':
				$fecha_inicio = $_GET["fecha_inicio"];
				$fecha_fin = $_GET["fecha_fin"];
				$usuario = $_GET["usuario"];

				if ($cargo == "superadmin" || $cargo == "admin") {
					if ($fecha_inicio == "" && $fecha_fin == ""  && $usuario == "") {
						$rspta = $tickets->listar();
					} elseif ($usuario == "") {
						$rspta = $tickets->listarPorFecha($fecha_inicio, $fecha_fin);
					} else {
						$rspta = $tickets->listarPorComision($usuario);
					}
				} elseif ($cargo == "vendedor_total") {
					if ($fecha_inicio == "" && $fecha_fin == ""  && $usuario == "") {
						$rspta = $tickets->listarPorUsuario($idusuario);
					} elseif ($usuario == "") {
						$rspta = $tickets->listarPorUsuarioFecha($idusuario, $fecha_inicio, $fecha_fin);
					} else {
						$rspta = $tickets->listarPorComisionUsuario($idusuario, $usuario);
					}
				}

				$data = array();

				while ($reg = $rspta->fetch_object()) {
					$cargo_detalle = "";
					switch ($reg->cargo) {
						case 'superadmin':
							$cargo_detalle = "Superadministrador";
							break;
						case 'admin':
							$cargo_detalle = "Administrador";
							break;
						case 'vendedor_impresion':
							$cargo_detalle = "Vendedor Impresión";
							break;
						case 'vendedor_total':
							$cargo_detalle = "Vendedor Total";
						default:
							break;
					}
					$data[] = array(
						"0" => '<div style="display: flex; justify-content: center">' .
							('<a target="_blank" href="../reportes/exTicket.php?id=' . $reg->idticket . '">
								<button style="margin-right: 3px; width: 35px; height: 35px;" class="btn btn-success">
									<i class="fa fa-file"></i>
								</button>
							</a>') . '</div>',
						"1" => $reg->fecha,
						"2" => ucwords($reg->usuario),
						"3" => ucwords($cargo_detalle),
						"4" => $reg->banco,
						"5" => "N° " . $reg->num_ticket,
						"6" => $reg->operacion,
						"7" => "N° " . $reg->num_ope,
						"8" => $reg->local,
						"9" => "N° " . $reg->local_ruc,
						"10" => "S/. " . $reg->importe,
						"11" => "S/. " . $reg->comision,
						"12" => ($reg->estado == 'activado') ? '<span class="label bg-green">Activado</span>' :
							'<span class="label bg-red">Desactivado</span>'
					);
				}
				$results = array(
					"sEcho" => 1,
					"iTotalRecords" => count($data),
					"iTotalDisplayRecords" => count($data),
					"aaData" => $data
				);
				echo json_encode($results);

				break;
		}
	} else {
		require 'noacceso.php';
	}
}
ob_end_flush();
