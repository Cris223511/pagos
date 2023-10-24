<?php
require "../config/Conexion.php";

class Ticket
{
	public function __construct()
	{
	}

	public function agregar($idusuario, $idbanco, $idoperacion, $idlocal, $num_ticket, $num_ope, $tipo_letra, $importe, $comision, $descripcion)
	{
		$sql = "INSERT INTO tickets (idusuario, idbanco, idoperacion, idlocal, num_ticket, num_ope, tipo_letra, importe, comision, descripcion, fecha_hora, estado)
            VALUES ('$idusuario', '$idbanco', '$idoperacion', '$idlocal', '$num_ticket', '$num_ope', '$tipo_letra', '$importe', '$comision', '$descripcion', NOW(), 'activado')";
		return ejecutarConsulta($sql);
	}

	public function agregar2($idusuario, $idbanco, $idoperacion, $idlocal, $num_ticket, $num_ope, $tipo_letra, $importe, $comision, $descripcion)
	{
		$sql = "INSERT INTO tickets (idusuario, idbanco, idoperacion, idlocal, num_ticket, num_ope, tipo_letra, importe, comision, descripcion, fecha_hora, estado)
            VALUES ('$idusuario', '$idbanco', '$idoperacion', '$idlocal', '$num_ticket', '$num_ope', '$tipo_letra', '$importe', '$comision', '$descripcion', NOW(), 'activado')";

		$idticketnew = ejecutarConsulta_retornarID($sql);
		return array("success" => true, "idticket" => $idticketnew);
	}

	public function verficarNumTicket($num_ticket)
	{
		$sql = "SELECT * FROM tickets WHERE num_ticket = '$num_ticket'";
		$resultado = ejecutarConsulta($sql);
		if (mysqli_num_rows($resultado) > 0) {
			// El número de ticket ya existe en la tabla
			return true;
		}
		// El número de ticket no existe en la tabla
		return false;
	}

	public function editar($idticket, $idbanco, $idoperacion, $idlocal, $num_ticket, $num_ope, $tipo_letra, $importe, $comision, $descripcion)
	{
		$sql = "UPDATE tickets SET idbanco='$idbanco',idoperacion='$idoperacion',idlocal='$idlocal',num_ticket='$num_ticket',num_ope='$num_ope',tipo_letra='$tipo_letra',importe='$importe',comision='$comision',descripcion='$descripcion' WHERE idticket='$idticket'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idticket)
	{
		$sql = "UPDATE tickets SET estado='desactivado' WHERE idticket='$idticket'";
		return ejecutarConsulta($sql);
	}

	public function activar($idticket)
	{
		$sql = "UPDATE tickets SET estado='activado' WHERE idticket='$idticket'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idticket)
	{
		$sql = "SELECT * FROM tickets WHERE idticket='$idticket'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function eliminar($idticket)
	{
		$sql = "DELETE FROM tickets WHERE idticket='$idticket'";
		return ejecutarConsulta($sql);
	}

	public function listar()
	{
		$sql = "SELECT
				  t.idticket,
				  u.nombre as usuario,
				  u.cargo as cargo,
				  b.titulo as banco,
				  o.titulo as operacion,
				  l.titulo as local,
				  l.local_ruc as local_ruc,
				  t.num_ticket,
				  t.num_ope,
				  t.tipo_letra,
				  t.importe,
				  t.comision,
				  t.descripcion,
				  DATE_FORMAT(t.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha,
				  t.estado
				FROM tickets t
				LEFT JOIN usuario u ON t.idusuario = u.idusuario
				LEFT JOIN bancos b ON t.idbanco = b.idbanco
				LEFT JOIN operaciones o ON t.idoperacion = o.idoperacion
				LEFT JOIN locales l ON t.idlocal = l.idlocal
				ORDER BY t.idticket DESC";
		return ejecutarConsulta($sql);
	}

	public function listarPorUsuario($idusuario)
	{
		$sql = "SELECT
				  t.idticket,
				  u.nombre as usuario,
				  u.cargo as cargo,
				  b.titulo as banco,
				  o.titulo as operacion,
				  l.titulo as local,
				  l.local_ruc as local_ruc,
				  t.num_ticket,
				  t.num_ope,
				  t.tipo_letra,
				  t.importe,
				  t.comision,
				  t.descripcion,
				  DATE_FORMAT(t.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha,
				  t.estado
				FROM tickets t
				LEFT JOIN usuario u ON t.idusuario = u.idusuario
				LEFT JOIN bancos b ON t.idbanco = b.idbanco
				LEFT JOIN operaciones o ON t.idoperacion = o.idoperacion
				LEFT JOIN locales l ON t.idlocal = l.idlocal
				WHERE t.idusuario = '$idusuario'
				ORDER BY t.idticket DESC";
		return ejecutarConsulta($sql);
	}

	public function listarTicketUnitario($idticket)
	{
		$sql = "SELECT
				  t.idticket,
				  u.nombre as usuario,
				  u.cargo as cargo,
				  b.titulo as banco,
				  o.titulo as operacion,
				  l.titulo as local,
				  l.local_ruc as local_ruc,
				  t.num_ticket,
				  t.num_ope,
				  t.tipo_letra,
				  t.importe,
				  t.comision,
				  t.descripcion,
				  DATE_FORMAT(t.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha,
				  t.estado
				FROM tickets t
				LEFT JOIN usuario u ON t.idusuario = u.idusuario
				LEFT JOIN bancos b ON t.idbanco = b.idbanco
				LEFT JOIN operaciones o ON t.idoperacion = o.idoperacion
				LEFT JOIN locales l ON t.idlocal = l.idlocal
				WHERE t.idticket = '$idticket'
				ORDER BY t.idticket DESC";
		return ejecutarConsulta($sql);
	}

	public function listarActivos()
	{
		$sql = "SELECT idticket, titulo FROM tickets WHERE estado='activado' ORDER BY idticket DESC";
		return ejecutarConsulta($sql);
	}

	/* ======================= SELECTS ======================= */

	public function listarTodosActivos()
	{
		$sql = "SELECT 'banco' AS tabla, b.idbanco AS id, b.titulo, u.nombre AS usuario, NULL AS ruc FROM bancos b LEFT JOIN usuario u ON b.idusuario = u.idusuario WHERE b.estado='activado' AND b.eliminado='0'
			UNION ALL
			SELECT 'operacion' AS tabla, o.idoperacion AS id, o.titulo, u.nombre AS usuario, NULL AS ruc FROM operaciones o LEFT JOIN usuario u ON o.idusuario = u.idusuario WHERE o.estado='activado' AND o.eliminado='0'
			UNION ALL
			SELECT 'local' AS tabla, l.idlocal AS id, l.titulo, u.nombre AS usuario, local_ruc AS ruc FROM locales l LEFT JOIN usuario u ON l.idusuario = u.idusuario WHERE l.idusuario <> 0 AND l.estado='activado' AND l.eliminado='0'
			UNION ALL
			SELECT 'correlativo' AS tabla, 0 AS id, (SELECT num_ticket FROM tickets ORDER BY num_ticket ASC LIMIT 1) AS correlativo, NULL AS usuario, NULL AS ruc";

		return ejecutarConsulta($sql);
	}

	public function listarTodosActivosPorUsuario($idusuario)
	{
		$sql = "SELECT 'banco' AS tabla, b.idbanco AS id, b.titulo, u.nombre AS usuario, NULL AS ruc FROM bancos b LEFT JOIN usuario u ON b.idusuario = u.idusuario WHERE b.idusuario='$idusuario' AND b.estado='activado' AND b.eliminado='0'
			UNION ALL
			SELECT 'operacion' AS tabla, o.idoperacion AS id, o.titulo, u.nombre AS usuario, NULL AS ruc FROM operaciones o LEFT JOIN usuario u ON o.idusuario = u.idusuario WHERE o.idusuario='$idusuario' AND o.estado='activado' AND o.eliminado='0'
			UNION ALL
			SELECT 'local' AS tabla, l.idlocal AS id, l.titulo, u.nombre AS usuario, local_ruc AS ruc FROM locales l LEFT JOIN usuario u ON l.idusuario = u.idusuario WHERE l.idusuario='$idusuario' AND l.idusuario <> 0 AND l.estado='activado' AND l.eliminado='0'
			UNION ALL
			SELECT 'correlativo' AS tabla, 0 AS id, (SELECT num_ticket FROM tickets ORDER BY num_ticket DESC LIMIT 1) AS correlativo, NULL AS usuario, NULL AS ruc";

		return ejecutarConsulta($sql);
	}

	public function getLastNumTicket()
	{
		$sql = "SELECT num_ticket as last_num_ticket FROM tickets ORDER BY idticket DESC LIMIT 1";
		return ejecutarConsulta($sql);
	}
}
