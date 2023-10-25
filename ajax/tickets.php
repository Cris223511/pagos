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
	if ($_SESSION['ticket'] == 1) {
		require_once "../modelos/Tickets.php";

		$tickets = new Ticket();

		// Variables de sesión a utilizar.
		$idusuario = $_SESSION["idusuario"];
		$idlocal_session = $_SESSION['idlocal'];
		$cargo = $_SESSION["cargo"];

		$idticket = isset($_POST["idticket"]) ? limpiarCadena($_POST["idticket"]) : "";
		$idbanco = isset($_POST["idbanco"]) ? limpiarCadena($_POST["idbanco"]) : "";
		$idoperacion = isset($_POST["idoperacion"]) ? limpiarCadena($_POST["idoperacion"]) : "";
		$idlocal = isset($_POST["idlocal"]) ? limpiarCadena($_POST["idlocal"]) : "";
		$num_ticket = isset($_POST["num_ticket"]) ? limpiarCadena($_POST["num_ticket"]) : "";
		$num_ope = isset($_POST["num_ope"]) ? limpiarCadena($_POST["num_ope"]) : "";
		$tipo_letra = isset($_POST["tipo_letra"]) ? limpiarCadena($_POST["tipo_letra"]) : "";
		$importe = isset($_POST["importe"]) ? limpiarCadena($_POST["importe"]) : "";
		$comision = isset($_POST["comision"]) ? limpiarCadena($_POST["comision"]) : "";
		$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

		switch ($_GET["op"]) {
			case 'guardaryeditar':
				if (empty($idticket)) {
					$num_ticketExiste = $tickets->verficarNumTicket($num_ticket);

					if ($num_ticketExiste) {
						echo "El número de ticket ya existe.";
					} else {
						$rspta = $tickets->agregar($idusuario, $idbanco, $idoperacion, $idlocal, $num_ticket, $num_ope, $tipo_letra, $importe, $comision, $descripcion);
						echo $rspta ? "Ticket registrado" : "El ticket no se pudo registrar";
					}
				} else {
					$rspta = $tickets->editar($idticket, $idbanco, $idoperacion, $idlocal, $num_ticket, $num_ope, $tipo_letra, $importe, $comision, $descripcion);
					echo $rspta ? "Ticket actualizado" : "El ticket no se pudo actualizar";
				}
				break;

			case 'guardaryeditar2':
				$num_ticketExiste = $tickets->verficarNumTicket($num_ticket);

				if ($num_ticketExiste) {
					echo "El número de ticket ya existe.";
				} else {
					$rspta = $tickets->agregar2($idusuario, $idbanco, $idoperacion, $idlocal, $num_ticket, $num_ope, $tipo_letra, $importe, $comision, $descripcion);
					echo json_encode(array(
						"rpta" => $rspta["success"] ? "Ticket registrado" : "El ticket no se pudo registrar",
						"idticket" => $rspta["idticket"]
					));
				}
				break;
			case 'desactivar':
				$rspta = $tickets->desactivar($idticket);
				echo $rspta ? "Ticket desactivado" : "El ticket no se pudo desactivar";
				break;

			case 'activar':
				$rspta = $tickets->activar($idticket);
				echo $rspta ? "Ticket activado" : "El ticket no se pudo activar";
				break;

			case 'mostrar':
				$rspta = $tickets->mostrar($idticket);
				echo json_encode($rspta);
				break;

			case 'eliminar':
				$rspta = $tickets->eliminar($idticket);
				echo $rspta ? "Ticket eliminado" : "El ticket no sepudo eliminar";
				break;

			case 'listar':

				if ($cargo == "superadmin" || $cargo == "admin") {
					$rspta = $tickets->listar();
				} elseif ($cargo == "vendedor_total") {
					$rspta = $tickets->listarPorUsuario($idusuario);
				}

				$data = array();

				if (isset($rspta)) {
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
						$reg->descripcion = (strlen($reg->descripcion) > 70) ? substr($reg->descripcion, 0, 70) . "..." : $reg->descripcion;

						$data[] = array(
							"0" => '<div style="display: flex; flex-wrap: nowrap; gap: 3px">' .
								(($reg->estado == 'activado') ?
									(('<button class="btn btn-bcp" style="margin-right: 3px; width: 35px; height: 35px;" onclick="detalles(' . $reg->idticket . ')"><i style="margin-left: -1px" class="fa fa-eye"></i></button>')) .
									(('<button class="btn btn-info" style="margin-right: 3px; width: 35px; height: 35px;" onclick="visualizar(' . $reg->idticket . ')"><i style="margin-left: -1px" class="fa fa-sign-in"></i></button>')) .
									(('<button class="btn btn-warning" style="margin-right: 3px; width: 35px; height: 35px;" onclick="mostrar(' . $reg->idticket . ')"><i class="fa fa-pencil"></i></button>')) .
									(('<a target="_blank" href="../reportes/exTicket.php?id=' . $reg->idticket . '"> <button style="margin-right: 3px; width: 35px; height: 35px;" class="btn btn-success"><i class="fa fa-file"></i></button></a>')) .
									(('<button class="btn btn-primary" style="margin-right: 3px; width: 35px; height: 35px;" onclick="imprimirPDF(' . $reg->idticket . ')"><i style="margin-left: -2px" class="fa fa-print"></i></button>')) .
									(('<button class="btn btn-danger" style="margin-right: 3px; width: 35px; height: 35px;" onclick="desactivar(' . $reg->idticket . ')"><i class="fa fa-close"></i></button>')) .
									(('<button class="btn btn-danger" style="width: 35px; height: 35px;" onclick="eliminar(' . $reg->idticket . ')"><i class="fa fa-trash"></i></button>')) :
									(('<button class="btn btn-bcp" style="margin-right: 3px; width: 35px; height: 35px;" onclick="detalles(' . $reg->idticket . ')"><i style="margin-left: -1px" class="fa fa-eye"></i></button>')) .
									(('<button class="btn btn-success" style="margin-right: 3px; width: 35px; width: 35px; height: 35px;" onclick="activar(' . $reg->idticket . ')"><i class="fa fa-check"></i></button>')) .
									(('<button class="btn btn-danger" style="width: 35px; height: 35px;" onclick="eliminar(' . $reg->idticket . ')"><i class="fa fa-trash"></i></button>'))) . '</div>',
							"1" => ucwords($reg->usuario),
							"2" => ucwords($cargo_detalle),
							"3" => $reg->banco,
							"4" => "N° " . $reg->num_ticket,
							"5" => $reg->operacion,
							"6" => "N° " . $reg->num_ope,
							"7" => $reg->local,
							"8" => "N° " . $reg->local_ruc,
							"9" => "S/. " . $reg->importe,
							"10" => "S/. " . $reg->comision,
							"11" => $reg->fecha,
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
				} else {
					$results = array(
						"sEcho" => 1,
						"iTotalRecords" => count($data),
						"iTotalDisplayRecords" => count($data),
						"aaData" => $data
					);
					echo json_encode($results);
				}

				break;

			case 'getLastNumTicket':
				$result = $tickets->getLastNumTicket();
				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					$last_num_ticket = $row["last_num_ticket"];
				} else {
					$last_num_ticket = 0;
				}
				echo $last_num_ticket;
				break;

				/* ======================= SELECTS ======================= */

			case 'listarTodosActivos':
				if ($cargo == "superadmin" || $cargo == "admin") {
					$rspta = $tickets->listarTodosActivos();
				} else {
					$rspta = $tickets->listarTodosActivosPorUsuario($idusuario);
				}

				$result = mysqli_fetch_all($rspta, MYSQLI_ASSOC);

				$data = [];
				foreach ($result as $row) {
					$tabla = $row['tabla'];
					unset($row['tabla']);
					$data[$tabla][] = $row;
				}

				$data["idlocal_session"][] = ["id" => $idlocal_session];

				echo json_encode($data);
				break;
		}
	} else {
		require 'noacceso.php';
	}
}
ob_end_flush();
