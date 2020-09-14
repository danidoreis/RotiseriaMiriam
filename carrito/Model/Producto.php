<?php
class Producto
{
	function get(){
		$sql = "SELECT * FROM producto";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function getById($id){
		$sql = "SELECT * FROM producto WHERE id=$id";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function guardarVenta(){
		$sql = "INSERT INTO venta (fecha) values (NOW())";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function getUltimaVenta()
	{
		$sql = "SELECT LAST_INSERT_ID() as ultimo";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function guardarDetalleVenta($idventa,$idproducto,$cantidad,$precio,$subtotal){
		$sql = "INSERT INTO venta_detalle (idventa,idproducto,cantidad,precio,subtotal) values ($idventa,$idproducto,$cantidad,'$precio','$subtotal')";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function getDetalleVenta($idventa){
		$sql = "SELECT p.descripcion as producto, vd.cantidad as cantidad, vd.precio as precio FROM venta_detalle vd
		INNER JOIN producto p 
		ON vd.idproducto = p.id
		WHERE idventa = $idventa";
		global $cnx;
		return $cnx->query($sql);
	}
	
	
}
