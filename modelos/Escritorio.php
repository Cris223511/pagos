<?php
require "../config/Conexion.php";

class Escritorio
{
    public function __construct()
    {
    }

    public function calcularTotalTickets()
    {
        $sql = "SELECT 
                    SUM(importe) AS total_importe,
                    SUM(comision) AS total_comision,
                    COUNT(*) AS total_tickets
                FROM tickets
                WHERE estado = 'activado'";

        return ejecutarConsulta($sql);
    }

    public function calcularTotalTicketsPorUsuario($idusuario)
    {
        $sql = "SELECT 
                    SUM(importe) AS total_importe,
                    SUM(comision) AS total_comision,
                    COUNT(*) AS total_tickets
                FROM tickets
                WHERE idusuario = $idusuario AND estado = 'activado'";

        return ejecutarConsulta($sql);
    }

    public function calcularTotalTicketsPorFecha($fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT 
                    SUM(t.importe) AS total_importe,
                    SUM(t.comision) AS total_comision,
                    COUNT(*) AS total_tickets
                FROM tickets t
                WHERE DATE(t.fecha_hora) >= '$fecha_inicio' 
                AND DATE(t.fecha_hora) <= '$fecha_fin'
                AND t.estado = 'activado'";

        return ejecutarConsulta($sql);
    }

    public function calcularTotalTicketsPorUsuarioPorFecha($idusuario, $fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT 
                    SUM(t.importe) AS total_importe,
                    SUM(t.comision) AS total_comision,
                    COUNT(*) AS total_tickets
                FROM tickets t
                WHERE DATE(t.fecha_hora) >= '$fecha_inicio' 
                AND DATE(t.fecha_hora) <= '$fecha_fin'
                AND t.estado = 'activado'
                AND t.idusuario = $idusuario";

        return ejecutarConsulta($sql);
    }
}
