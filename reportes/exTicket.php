<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["idusuario"])) {
    session_destroy();
    header("Location: ../vistas/login.html");
    exit();
}

require('../modelos/Tickets.php');
$ticket = new Ticket();
$rspta = $ticket->listarTicketUnitario($_GET["id"]);
$reg = $rspta->fetch_object();

# Incluyendo librerias necesarias #
require('ticket/code128.php');

# Modificando el ancho y alto del ticket #
$pdf = new PDF_Code128('P', 'mm', array(70, 90));
$pdf->SetAutoPageBreak(false);
$pdf->SetMargins(4, 10, 4);
$pdf->AddPage();

# Encabezado y datos del ticket #
$pdf->encabezado(
    $reg->usuario,
    $reg->banco,
    $reg->operacion,
    $reg->local,
    $reg->local_ruc,
    $reg->num_ticket,
    $reg->num_ope,
    $reg->fecha,
);

# Separador #
$pdf->Ln(3);
$pdf->SetX(1.5);
$pdf->Cell(0, -5, utf8_decode("--------------------------------------------------------------"), 0, 0, 'L');

# Cuerpo y datos del ticket #
$pdf->cuerpo(
    $reg->descripcion,
    $reg->importe,
    $reg->comision,
);

# Separador #
$pdf->Ln(4);
$pdf->SetX(1.5);
$pdf->Cell(0, -5, utf8_decode("--------------------------------------------------------------"), 0, 0, 'L');

# Pie y datos del ticket #
$pdf->pie();

# Nombre del archivo PDF #
$pdf->Output("I", "ticket_" . mt_rand(10000000, 99999999) . ".pdf", true);

ob_end_flush();
