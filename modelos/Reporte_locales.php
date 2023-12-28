<?php
require "../config/Conexion.php";

class ReporteLocales
{
	public function __construct()
	{
	}

	public function listar()
	{
		$sql = "SELECT
				  l.idlocal,
				  u.idusuario,
				  u.nombre as nombre,
				  u.cargo as cargo,
				  l.titulo,
				  l.local_ruc,
				  l.descripcion,
				  DATE_FORMAT(l.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha,
				  l.estado
				FROM locales l
				LEFT JOIN usuario u ON l.idusuario = u.idusuario
				WHERE l.idusuario <> 0
				AND l.eliminado = '0'
				ORDER BY l.idlocal DESC";
		return ejecutarConsulta($sql);
	}

	public function listarPorFecha($fecha_inicio, $fecha_fin)
	{
		$sql = "SELECT
				  l.idlocal,
				  u.idusuario,
				  u.nombre as nombre,
				  u.cargo as cargo,
				  l.titulo,
				  l.local_ruc,
				  l.descripcion,
				  DATE_FORMAT(l.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha,
				  l.estado
				FROM locales l
				LEFT JOIN usuario u ON l.idusuario = u.idusuario
				WHERE DATE(l.fecha_hora) >= '$fecha_inicio'
				AND DATE(l.fecha_hora) <= '$fecha_fin'
				AND l.idusuario <> 0
				AND l.eliminado = '0'
				ORDER BY l.idlocal DESC";
		return ejecutarConsulta($sql);
	}

	public function listarPorFechaYlocal($local, $fecha_inicio, $fecha_fin)
	{
		$sql = "SELECT
				  l.idlocal,
				  u.idusuario,
				  u.nombre as nombre,
				  u.cargo as cargo,
				  l.titulo,
				  l.local_ruc,
				  l.descripcion,
				  DATE_FORMAT(l.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha,
				  l.estado
				FROM locales l
				LEFT JOIN usuario u ON l.idusuario = u.idusuario
				WHERE DATE(l.fecha_hora) >= '$fecha_inicio'
				AND DATE(l.fecha_hora) <= '$fecha_fin'
				AND l.idusuario <> 0
				AND l.eliminado = '0'
				AND l.titulo LIKE '%$local%'
				ORDER BY l.idlocal DESC";
		return ejecutarConsulta($sql);
	}

	public function listarPorLocal($local)
	{
		$sql = "SELECT
				  l.idlocal,
				  u.idusuario,
				  u.nombre as nombre,
				  u.cargo as cargo,
				  l.titulo,
				  l.local_ruc,
				  l.descripcion,
				  DATE_FORMAT(l.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha,
				  l.estado
				FROM locales l
				LEFT JOIN usuario u ON l.idusuario = u.idusuario
				WHERE l.titulo LIKE '%$local%'
				AND l.idusuario <> 0
				AND l.eliminado = '0'
				ORDER BY l.idlocal DESC";
		return ejecutarConsulta($sql);
	}
}
