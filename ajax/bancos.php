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
		require_once "../modelos/Bancos.php";

		$bancos = new Banco();

		// Variables de sesión a utilizar.
		$idusuario = $_SESSION["idusuario"];
		$cargo = $_SESSION["cargo"];

		$idbanco = isset($_POST["idbanco"]) ? limpiarCadena($_POST["idbanco"]) : "";
		$titulo = isset($_POST["titulo"]) ? limpiarCadena($_POST["titulo"]) : "";
		$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

		switch ($_GET["op"]) {
			case 'guardaryeditar':
				if (empty($idbanco)) {
					$nombreExiste = $bancos->verificarNombreExiste($titulo);
					if ($nombreExiste) {
						echo "El nombre del banco ya existe.";
					} else {
						$rspta = $bancos->agregar($idusuario, $titulo, $descripcion);
						echo $rspta ? "Banco registrado" : "El banco no se pudo registrar";
					}
				} else {
					$nombreExiste = $bancos->verificarNombreEditarExiste($titulo, $idbanco);
					if ($nombreExiste) {
						echo "El nombre del banco ya existe.";
					} else {
						$rspta = $bancos->editar($idbanco, $titulo, $descripcion);
						echo $rspta ? "Banco actualizado" : "El banco no se pudo actualizar";
					}
				}
				break;

			case 'desactivar':
				$rspta = $bancos->desactivar($idbanco);
				echo $rspta ? "Banco desactivado" : "El banco no se pudo desactivar";
				break;

			case 'activar':
				$rspta = $bancos->activar($idbanco);
				echo $rspta ? "Banco activado" : "El banco no se pudo activar";
				break;

			case 'eliminar':
				$rspta = $bancos->eliminar($idbanco);
				echo $rspta ? "Banco eliminado" : "El banco no se pudo eliminar";
				break;

			case 'mostrar':
				$rspta = $bancos->mostrar($idbanco);
				echo json_encode($rspta);
				break;

			case 'listar':

				// if ($cargo == "superadmin") {
					$rspta = $bancos->listar();
				// } else {
					// $rspta = $bancos->listarPorUsuario($idusuario);
				// }

				$data = array();

				function mostrarBoton($reg, $cargo, $idusuario, $buttonType)
				{
					if ($reg != "superadmin" && $cargo == "admin") {
						return $buttonType;
					} elseif ($cargo == "superadmin" || ($cargo == "vendedor_impresion" && $idusuario == $_SESSION["idusuario"]) || ($cargo == "vendedor_total" && $idusuario == $_SESSION["idusuario"])) {
						return $buttonType;
					} else {
						return '';
					}
				}

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
							mostrarBoton($reg->cargo, $cargo, $reg->idusuario, '<button class="btn btn-warning" style="margin-right: 3px; height: 35px;" onclick="mostrar(' . $reg->idbanco . ')"><i class="fa fa-pencil"></i></button>') .
							(($reg->estado == 'activado') ?
								(mostrarBoton($reg->cargo, $cargo, $reg->idusuario, '<button class="btn btn-danger" style="margin-right: 3px; height: 35px;" onclick="desactivar(' . $reg->idbanco . ')"><i class="fa fa-close"></i></button>')) :
								(mostrarBoton($reg->cargo, $cargo, $reg->idusuario, '<button class="btn btn-success" style="margin-right: 3px; width: 35px; height: 35px;" onclick="activar(' . $reg->idbanco . ')"><i style="margin-left: -2px" class="fa fa-check"></i></button>'))) .
							mostrarBoton($reg->cargo, $cargo, $reg->idusuario, '<button class="btn btn-danger" style="height: 35px;" onclick="eliminar(' . $reg->idbanco . ')"><i class="fa fa-trash"></i></button>') .
							'</div>',
						"1" => $reg->titulo,
						"2" => ($reg->descripcion == '') ? 'Sin registrar.' : $reg->descripcion,
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

			case 'selectBanco':
				if ($cargo == "superadmin" || $cargo == "admin") {
					$rspta = $bancos->listar();
				} else {
					$rspta = $bancos->listarPorUsuario($idusuario);
				}

				echo '<option value="">- Seleccione -</option>';
				while ($reg = $rspta->fetch_object()) {
					echo '<option value="' . $reg->idbanco . '"> ' . $reg->titulo . ' - ' . $reg->nombre . '</option>';
				}
				break;
		}
	} else {
		require 'noacceso.php';
	}
}
ob_end_flush();
