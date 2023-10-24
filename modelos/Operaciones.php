<?php
require "../config/Conexion.php";

class Operacion
{
	public function __construct()
	{
	}

	public function agregar($idusuario, $titulo, $descripcion)
	{
		$sql = "INSERT INTO operaciones (idusuario, titulo, descripcion, fecha_hora, estado, eliminado)
            VALUES ('$idusuario','$titulo', '$descripcion', NOW(), 'activado','0')";
		return ejecutarConsulta($sql);
	}
 
	public function verificarNombreExiste($titulo)
	{
		$sql = "SELECT * FROM operaciones WHERE titulo = '$titulo' AND eliminado = '0'";
		$resultado = ejecutarConsulta($sql);
		if (mysqli_num_rows($resultado) > 0) {
			// El titulo ya existe en la tabla
			return true;
		}
		// El titulo no existe en la tabla
		return false;
	}

	public function editar($idoperacion, $titulo, $descripcion)
	{
		$sql = "UPDATE operaciones SET titulo='$titulo',descripcion='$descripcion' WHERE idoperacion='$idoperacion'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idoperacion)
	{
		$sql = "UPDATE operaciones SET estado='desactivado' WHERE idoperacion='$idoperacion'";
		return ejecutarConsulta($sql);
	}

	public function activar($idoperacion)
	{
		$sql = "UPDATE operaciones SET estado='activado' WHERE idoperacion='$idoperacion'";
		return ejecutarConsulta($sql);
	}

	public function eliminar($idoperacion)
	{
		$sql = "UPDATE operaciones SET eliminado = '1' WHERE idoperacion='$idoperacion'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idoperacion)
	{
		$sql = "SELECT * FROM operaciones WHERE idoperacion='$idoperacion'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar()
	{
		$sql = "SELECT o.idoperacion, u.idusuario, u.nombre as nombre, u.cargo as cargo, o.titulo, o.descripcion, DATE_FORMAT(o.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha, o.estado FROM operaciones o LEFT JOIN usuario u ON o.idusuario = u.idusuario WHERE o.eliminado = '0' ORDER BY o.idoperacion DESC";
		return ejecutarConsulta($sql);
	}

	public function listarPorUsuario($idusuario)
	{
		$sql = "SELECT o.idoperacion, u.idusuario, u.nombre as nombre, u.cargo as cargo, o.titulo, o.descripcion, DATE_FORMAT(o.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha, o.estado FROM operaciones o LEFT JOIN usuario u ON o.idusuario = u.idusuario WHERE o.idusuario = '$idusuario' AND o.eliminado = '0' ORDER BY o.idoperacion DESC";
		return ejecutarConsulta($sql);
	}

	public function listarActivos()
	{
		$sql = "SELECT idoperacion, titulo FROM operaciones WHERE estado='activado' AND eliminado = '0' ORDER BY idoperacion DESC";
		return ejecutarConsulta($sql);
	}
}
