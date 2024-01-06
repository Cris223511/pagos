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
	if ($_SESSION['conversaciones'] == 1) {
		require_once "../modelos/Comentarios.php";

		$comentarios = new Comentario();

		$idconversacion = isset($_POST["idconversacion"]) ? limpiarCadena($_POST["idconversacion"]) : "";
		$emisor = isset($_POST["emisor"]) ? limpiarCadena($_POST["emisor"]) : "";
		$receptor = isset($_POST["receptor"]) ? limpiarCadena($_POST["receptor"]) : "";
		$asunto = isset($_POST["asunto"]) ? limpiarCadena($_POST["asunto"]) : "";
		$mensaje = isset($_POST["mensaje"]) ? limpiarCadena($_POST["mensaje"]) : "";

		// Variables de sesión a utilizar.
		$idusuario = $_SESSION["idusuario"];
		$cargo = $_SESSION["cargo"];

		switch ($_GET["op"]) {
			case 'guardaryeditar':
				if (empty($idconversacion)) {
					$rspta = $comentarios->agregar($emisor, $receptor, $asunto, $mensaje);
					echo $rspta ? "Comentario registrado" : "El comentario no se pudo registrar";
				} else {
					$rspta = $comentarios->editar($idconversacion, $emisor, $receptor, $asunto, $mensaje);
					echo $rspta ? "Comentario actualizado" : "El comentario no se pudo actualizar";
				}
				break;

			case 'enviarTodos':
				$rspta = $comentarios->enviarTodos($emisor, $asunto, $mensaje);
				echo $rspta ? "Comentario registrado" : "El comentario no se pudo registrar";
				break;

			case 'getSessionId':
				echo $idusuario;
				break;

			case 'eliminar':
				$rspta = $comentarios->eliminar($idconversacion);
				echo $rspta ? "Comentario eliminado" : "El comentario no se pudo eliminar";
				break;

			case 'mostrar':
				$rspta = $comentarios->mostrar($idconversacion);
				echo json_encode($rspta);
				break;

			case 'listar':
				if ($cargo == "superadmin" || $cargo == "admin") {
					$rspta = $comentarios->listar();
				} else {
					$rspta = $comentarios->listarPorUsuario($idusuario);
				}

				function mostrarBoton($cargo, $buttonType)
				{
					if ($cargo == "superadmin" || $cargo == "admin") {
						return $buttonType;
					} else {
						return '';
					}
				}

				$data = array();

				while ($reg = $rspta->fetch_object()) {
					$data[] = array(
						"0" => '<div style="display: flex; gap: 3px;">' .
							(('<button class="btn btn-bcp" style="margin-right: 3px; height: 35px;" onclick="mostrar(' . $reg->idconversacion . ')"><i class="fa fa-eye"></i></button>')) .
							mostrarBoton($cargo, '<button class="btn btn-danger" style="height: 35px;" onclick="eliminar(' . $reg->idconversacion . ')"><i class="fa fa-trash"></i></button>'),
						"1" => $reg->emisor,
						"2" => ($reg->receptor == "") ? "todos" : $reg->receptor,
						"3" => $reg->asunto,
						"4" => $reg->mensaje,
						"5" => $reg->fecha,
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

			case 'listar2':
				$rspta = $comentarios->listar();

				$data = array();

				while ($reg = $rspta->fetch_object()) {
					$reg->mensaje = (strlen($reg->mensaje) > 70) ? substr($reg->mensaje, 0, 70) . "..." : $reg->mensaje;

					$data[] = array(
						"0" => '<div style="display: flex; flex-wrap: nowrap; gap: 3px">' .
							(('<button class="btn btn-warning" style="margin-right: 3px; height: 35px;" onclick="mostrar(' . $reg->idconversacion . ')"><i class="fa fa-pencil"></i></button>')) .
							(('<button class="btn btn-danger" style="height: 35px;" onclick="eliminar(' . $reg->idconversacion . ')"><i class="fa fa-trash"></i></button>')) . '</div>',
						"1" => $reg->emisor,
						"2" => ($reg->receptor == "") ? "todos" : $reg->receptor,
						"3" => $reg->asunto,
						"4" => $reg->mensaje,
						"5" => $reg->fecha,
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
