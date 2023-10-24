<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1)
  session_start();

if (!isset($_SESSION["nombre"])) {
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
} else {
  if ($_SESSION['rPagos'] == 1) {

    require('PDF_MC_Table.php');

    $pdf = new PDF_MC_Table();

    $pdf->AddPage();

    $y_axis_initial = 25;

    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(45, 6, '', 0, 0, 'C');
    $pdf->Cell(100, 6, 'LISTA DE TICKETS', 1, 0, 'C');
    $pdf->Ln(10);

    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25, 6, utf8_decode('N° Ticket'), 1, 0, 'C', 1);
    $pdf->Cell(25, 6, utf8_decode('N° Operación'), 1, 0, 'C', 1);
    $pdf->Cell(35, 6, utf8_decode('Local'), 1, 0, 'C', 1);
    $pdf->Cell(25, 6, utf8_decode('RUC'), 1, 0, 'C', 1);
    $pdf->Cell(23, 6, utf8_decode('Importe'), 1, 0, 'C', 1);
    $pdf->Cell(23, 6, utf8_decode('Comisión'), 1, 0, 'C', 1);
    $pdf->Cell(35, 6, utf8_decode('Fecha y hora'), 1, 0, 'C', 1);

    $pdf->Ln(10);
    require_once "../modelos/Reporte_tickets.php";
    $tickets = new ReporteTicket();

    $cargo = $_SESSION["cargo"];
    $idusuario = $_SESSION["idusuario"];

    if ($cargo == "superadmin" || $cargo == "admin") {
      $rspta = $tickets->listar();
    } elseif ($cargo == "vendedor_total") {
      $rspta = $tickets->listarPorUsuario($idusuario);
    }

    $pdf->SetWidths(array(25, 25, 35, 25, 23, 23, 35));

    while ($reg = $rspta->fetch_object()) {
      $num_ticket = $reg->num_ticket;
      $num_ope = $reg->num_ope;
      $local = $reg->local;
      $local_ruc = $reg->local_ruc;
      $importe = $reg->importe;
      $comision = $reg->comision;
      $fecha = $reg->fecha;

      $pdf->SetFont('Arial', '', 10);
      $pdf->Row(array(utf8_decode($num_ticket), utf8_decode($num_ope), utf8_decode($local), utf8_decode($local_ruc), utf8_decode($importe), utf8_decode($comision), utf8_decode($fecha)));
    }

    $pdf->Output();

?>
<?php
  } else {
    echo 'No tiene permiso para visualizar el reporte';
  }
}
ob_end_flush();
?>