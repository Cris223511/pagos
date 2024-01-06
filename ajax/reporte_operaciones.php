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
	if ($_SESSION['rPagos'] == 1) {
		require_once "../modelos/Reporte_operaciones.php";

		$tickets = new ReporteOperaciones();

		// Variables de sesión a utilizar.
		$idusuario = $_SESSION["idusuario"];
		$cargo = $_SESSION["cargo"];

		switch ($_GET["op"]) {

			case 'listar':
				$fecha_inicio = $_GET["fecha_inicio"];
				$fecha_fin = $_GET["fecha_fin"];
				$operacion = $_GET["operacion"];

				if ($cargo == "superadmin" || $cargo == "admin") {
					if ($fecha_inicio == "" && $fecha_fin == ""  && $operacion == "") {
						$rspta = $tickets->listar();
					} elseif ($fecha_inicio != "" && $fecha_fin != "" && $operacion != "") {
						$rspta = $tickets->listarPorFechaYbanco($operacion, $fecha_inicio, $fecha_fin);
					} elseif ($fecha_inicio != "" && $fecha_fin != "" && $operacion == "") {
						$rspta = $tickets->listarPorFecha($fecha_inicio, $fecha_fin);
					} else {
						$rspta = $tickets->listarPorOperacion($operacion);
					}
				} elseif ($cargo == "vendedor_total") {
					if ($fecha_inicio == "" && $fecha_fin == ""  && $operacion == "") {
						$rspta = $tickets->listarPorUsuario($idusuario);
					} elseif ($fecha_inicio != "" && $fecha_fin != "" && $operacion != "") {
						$rspta = $tickets->listarPorFechaYbancoUsuario($idusuario, $operacion, $fecha_inicio, $fecha_fin);
					} elseif ($fecha_inicio != "" && $fecha_fin != "" && $operacion == "") {
						$rspta = $tickets->listarPorUsuarioFecha($idusuario, $fecha_inicio, $fecha_fin);
					} else {
						$rspta = $tickets->listarPorOperacionUsuario($idusuario, $operacion);
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
						"1" => '<strong>' . $reg->operacion . '</strong>',
						"2" => $reg->local,
						"3" => "N° " . $reg->local_ruc,
						"4" => ucwords($reg->usuario),
						"5" => ucwords($cargo_detalle),
						"6" => $reg->fecha,
						"7" => ($reg->estado == 'activado') ? '<span class="label bg-green">Activado</span>' :
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
