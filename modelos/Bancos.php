<?php
require "../config/Conexion.php";

class Banco
{
	public function __construct()
	{
	}

	public function agregar($idusuario, $titulo, $descripcion)
	{
		date_default_timezone_set("America/Lima");
		$sql = "INSERT INTO bancos (idusuario, titulo, descripcion, fecha_hora, estado, eliminado)
            VALUES ('$idusuario','$titulo', '$descripcion', SYSDATE(), 'activado', '0')";
		return ejecutarConsulta($sql);
	}

	public function verificarNombreExiste($titulo)
	{
		$sql = "SELECT * FROM bancos WHERE titulo = '$titulo' AND eliminado = '0'";
		$resultado = ejecutarConsulta($sql);
		if (mysqli_num_rows($resultado) > 0) {
			// El titulo ya existe en la tabla
			return true;
		}
		// El titulo no existe en la tabla
		return false;
	}

	public function verificarNombreEditarExiste($titulo, $idbanco)
	{
		$sql = "SELECT * FROM bancos WHERE titulo = '$titulo' AND idbanco != '$idbanco' AND eliminado = '0'";
		$resultado = ejecutarConsulta($sql);
		if (mysqli_num_rows($resultado) > 0) {
			// El titulo ya existe en la tabla
			return true;
		}
		// El titulo no existe en la tabla
		return false;
	}

	public function editar($idbanco, $titulo, $descripcion)
	{
		$sql = "UPDATE bancos SET titulo='$titulo',descripcion='$descripcion' WHERE idbanco='$idbanco'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idbanco)
	{
		$sql = "UPDATE bancos SET estado='desactivado' WHERE idbanco='$idbanco'";
		return ejecutarConsulta($sql);
	}

	public function activar($idbanco)
	{
		$sql = "UPDATE bancos SET estado='activado' WHERE idbanco='$idbanco'";
		return ejecutarConsulta($sql);
	}

	public function eliminar($idbanco)
	{
		$sql = "UPDATE bancos SET eliminado = '1' WHERE idbanco='$idbanco'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idbanco)
	{
		$sql = "SELECT * FROM bancos WHERE idbanco='$idbanco'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar()
	{
		$sql = "SELECT b.idbanco, u.idusuario, u.nombre as nombre, u.cargo as cargo, b.titulo, b.descripcion, DATE_FORMAT(b.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha, b.estado FROM bancos b LEFT JOIN usuario u ON b.idusuario = u.idusuario WHERE b.eliminado = '0' ORDER BY b.idbanco DESC";
		return ejecutarConsulta($sql);
	}

	public function listarPorUsuario($idusuario)
	{
		$sql = "SELECT b.idbanco, u.idusuario, u.nombre as nombre, u.cargo as cargo, b.titulo, b.descripcion, DATE_FORMAT(b.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha, b.estado FROM bancos b LEFT JOIN usuario u ON b.idusuario = u.idusuario WHERE b.idusuario = '$idusuario' AND b.eliminado = '0' ORDER BY b.idbanco DESC";
		return ejecutarConsulta($sql);
	}

	public function listarActivos()
	{
		$sql = "SELECT idbanco, titulo FROM bancos WHERE estado='activado' AND eliminado = '0' ORDER BY idbanco DESC";
		return ejecutarConsulta($sql);
	}
}
