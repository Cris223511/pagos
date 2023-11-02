<?php
require "../config/Conexion.php";

class Comentario
{
	public function __construct()
	{
	}

	public function agregar($emisor, $receptor, $asunto, $mensaje)
	{
		$sql = "INSERT INTO conversaciones (idusuario, receptor, asunto, mensaje, fecha_hora)
            VALUES ('$emisor','$receptor', '$asunto', '$mensaje', SYSDATE())";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idconversacion)
	{
		$sql = "SELECT c.idconversacion, c.asunto, c.mensaje, c.idusuario as emisorID, c.receptor as receptorID, ue.nombre as emisor, ur.nombre as receptor, DATE_FORMAT(c.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha FROM conversaciones c INNER JOIN usuario ue ON c.idusuario = ue.idusuario INNER JOIN usuario ur ON c.receptor = ur.idusuario WHERE c.idconversacion='$idconversacion' ORDER BY c.idconversacion DESC";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function listar()
	{
		$sql = "SELECT c.idconversacion, c.asunto, c.mensaje, c.idusuario as emisorID, c.receptor as receptorID, ue.nombre as emisor, ur.nombre as receptor, DATE_FORMAT(c.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha FROM conversaciones c INNER JOIN usuario ue ON c.idusuario = ue.idusuario INNER JOIN usuario ur ON c.receptor = ur.idusuario ORDER BY c.idconversacion DESC";
		return ejecutarConsulta($sql);
	}

	public function listarPorUsuario($idusuario)
	{
		$sql = "SELECT c.idconversacion, c.asunto, c.mensaje, c.idusuario as emisorID, c.receptor as receptorID, ue.nombre as emisor, ur.nombre as receptor, DATE_FORMAT(c.fecha_hora, '%d-%m-%Y %H:%i:%s') as fecha FROM conversaciones c INNER JOIN usuario ue ON c.idusuario = ue.idusuario INNER JOIN usuario ur ON c.receptor = ur.idusuario WHERE c.idusuario='$idusuario' ORDER BY c.idconversacion DESC";
		return ejecutarConsulta($sql);
	}

	public function editar($idconversacion, $emisor, $receptor, $asunto, $mensaje)
	{
		$sql = "UPDATE conversaciones SET idusuario='$emisor', receptor='$receptor', asunto='$asunto', mensaje='$mensaje' WHERE idconversacion='$idconversacion'";
		return ejecutarConsulta($sql);
	}

	public function eliminar($idconversacion)
	{
		$sql = "DELETE FROM conversaciones WHERE idconversacion='$idconversacion'";
		return ejecutarConsulta($sql);
	}
}
