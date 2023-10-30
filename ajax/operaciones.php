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
		require_once "../modelos/Operaciones.php";

		$operaciones = new Operacion();

		// Variables de sesión a utilizar.
		$idusuario = $_SESSION["idusuario"];
		$cargo = $_SESSION["cargo"];

		$idoperacion = isset($_POST["idoperacion"]) ? limpiarCadena($_POST["idoperacion"]) : "";
		$titulo = isset($_POST["titulo"]) ? limpiarCadena($_POST["titulo"]) : "";
		$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

		switch ($_GET["op"]) {
			case 'guardaryeditar':
				if (empty($idoperacion)) {
					$nombreExiste = $operaciones->verificarNombreExiste($titulo);
					if ($nombreExiste) {
						echo "El nombre de la operación ya existe.";
					} else {
						$rspta = $operaciones->agregar($idusuario, $titulo, $descripcion);
						echo $rspta ? "Operación registrada" : "La operación no se pudo registrar";
					}
				} else {
					$nombreExiste = $operaciones->verificarNombreEditarExiste($titulo, $idoperacion);
					if ($nombreExiste) {
						echo "El nombre de la operación ya existe.";
					} else {
						$rspta = $operaciones->editar($idoperacion, $titulo, $descripcion);
						echo $rspta ? "Operación actualizada" : "La operación no se pudo actualizar";
					}
				}
				break;

			case 'desactivar':
				$rspta = $operaciones->desactivar($idoperacion);
				echo $rspta ? "Operación desactivada" : "La operación no se pudo desactivar";
				break;

			case 'activar':
				$rspta = $operaciones->activar($idoperacion);
				echo $rspta ? "Operación activada" : "La operación no se pudo activar";
				break;

			case 'eliminar':
				$rspta = $operaciones->eliminar($idoperacion);
				echo $rspta ? "Operación eliminado" : "La operación no se pudo eliminar";
				break;

			case 'mostrar':
				$rspta = $operaciones->mostrar($idoperacion);
				echo json_encode($rspta);
				break;

			case 'listar':

				if ($cargo == "superadmin" || $cargo == "admin") {
					$rspta = $operaciones->listar();
				} else {
					$rspta = $operaciones->listarPorUsuario($idusuario);
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
					$reg->descripcion = (strlen($reg->descripcion) > 70) ? substr($reg->descripcion, 0, 70) . "..." : $reg->descripcion;

					$data[] = array(
						"0" => '<div style="display: flex; flex-wrap: nowrap; gap: 3px">' .
							(($reg->estado == 'activado') ?
								(('<button class="btn btn-warning" style="margin-right: 3px; height: 35px;" onclick="mostrar(' . $reg->idoperacion . ')"><i class="fa fa-pencil"></i></button>')) .
								(('<button class="btn btn-danger" style="margin-right: 3px; height: 35px;" onclick="desactivar(' . $reg->idoperacion . ')"><i class="fa fa-close"></i></button>')) .
								(('<button class="btn btn-danger" style="height: 35px;" onclick="eliminar(' . $reg->idoperacion . ')"><i class="fa fa-trash"></i></button>')) : (('<button class="btn btn-warning" style="margin-right: 3px;" onclick="mostrar(' . $reg->idoperacion . ')"><i class="fa fa-pencil"></i></button>')) .
								(('<button class="btn btn-success" style="margin-right: 3px; width: 35px; height: 35px;" onclick="activar(' . $reg->idoperacion . ')"><i class="fa fa-check"></i></button>')) .
								(('<button class="btn btn-danger" style="height: 35px;" onclick="eliminar(' . $reg->idoperacion . ')"><i class="fa fa-trash"></i></button>'))) . '</div>',
						"1" => $reg->titulo,
						"2" => $reg->descripcion,
						"3" => ucwords($reg->nombre),
						"4" => ucwords($cargo_detalle),
						"5" => $reg->fecha,
						"6" => ($reg->estado == 'activado') ? '<span class="label bg-green">Activado</span>' :
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

			case 'selectOperacion':
				if ($cargo == "superadmin" || $cargo == "admin") {
					$rspta = $operaciones->listar();
				} else {
					$rspta = $operaciones->listarPorUsuario($idusuario);
				}

				echo '<option value="">- Seleccione -</option>';
				while ($reg = $rspta->fetch_object()) {
					echo '<option value="' . $reg->idoperacion . '"> ' . $reg->titulo . ' - ' . $reg->nombre . '</option>';
				}
				break;
		}
	} else {
		require 'noacceso.php';
	}
}
ob_end_flush();
