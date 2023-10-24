<?php
require "../config/Conexion.php";

class ReporteBancos
{
	public function __construct()
	{
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

	public function listarPorFecha($fecha_inicio, $fecha_fin)
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
				WHERE DATE(t.fecha_hora) >= '$fecha_inicio'
				AND DATE(t.fecha_hora) <= '$fecha_fin'
				ORDER BY t.idticket DESC";
		return ejecutarConsulta($sql);
	}

	public function listarPorUsuarioFecha($idusuario, $fecha_inicio, $fecha_fin)
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
				WHERE DATE(t.fecha_hora) >= '$fecha_inicio'
				AND DATE(t.fecha_hora) <= '$fecha_fin'
				AND t.idusuario = '$idusuario'
				ORDER BY t.idticket DESC";
		return ejecutarConsulta($sql);
	}

	public function listarPorBanco($banco)
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
				WHERE b.titulo LIKE '%$banco%'
				ORDER BY t.idticket DESC";
		return ejecutarConsulta($sql);
	}

	public function listarPorBancoUsuario($idusuario, $banco)
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
				WHERE b.titulo LIKE '%$banco%'
				AND t.idusuario = '$idusuario'
				ORDER BY t.idticket DESC";
		return ejecutarConsulta($sql);
	}
}
