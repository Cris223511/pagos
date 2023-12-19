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
    if ($_SESSION['escritorio'] == 1) {
        require_once "../modelos/Escritorio.php";

        $escritorio = new Escritorio();

        // Variables de sesión a utilizar.
        $idusuario = $_SESSION["idusuario"];
        $cargo = $_SESSION["cargo"];

        switch ($_GET["op"]) {

            case 'listar':
                $fecha_inicio = $_GET["fecha_inicio"];
                $fecha_fin = $_GET["fecha_fin"];

                if ($cargo == "superadmin" || $cargo == "admin") {
                    if ($fecha_inicio == "" && $fecha_fin == "") {
                        $rspta = $escritorio->calcularTotalTickets();
                    } else {
                        $rspta = $escritorio->calcularTotalTicketsPorFecha($fecha_inicio, $fecha_fin);
                    }
                } elseif ($cargo == "vendedor_total" || $cargo == "vendedor_impresion") {
                    if ($fecha_inicio == "" && $fecha_fin == "") {
                        $rspta = $escritorio->calcularTotalTicketsPorUsuario($idusuario);
                    } else {
                        $rspta = $escritorio->calcularTotalTicketsPorUsuarioPorFecha($idusuario, $fecha_inicio, $fecha_fin);
                    }
                }

                if ($rspta) {
                    $datos = $rspta->fetch_assoc();

                    $totalImporte = number_format($datos['total_importe'], 2, '.', ',');
                    $totalComision = number_format($datos['total_comision'], 2, '.', ',');
                    $totalTickets = $datos['total_tickets'];

                    $response = array(
                        'total_importe' => $totalImporte,
                        'total_comision' => $totalComision,
                        'total_tickets' => $totalTickets
                    );

                    echo json_encode($response);
                }

                break;
        }
    } else {
        require 'noacceso.php';
    }
}
ob_end_flush();
