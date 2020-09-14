<?php
	session_start();
	if(isset($_GET["page"])){
		$page=$_GET["page"];
	}else{
		$page=0;
	}
	
	require_once '../Config/conexion.php';
	require_once '../Model/Producto.php';
	
	switch($page){
	
		case 1:
			$objProducto = new Producto();
			$json = array();
			$json['msj'] = 'Producto Agregado';
			$json['success'] = true;
		
			if (isset($_POST['producto_id']) && $_POST['producto_id']!='' && isset($_POST['cantidad']) && $_POST['cantidad']!='') {
				try {
					$cantidad = $_POST['cantidad'];
					$producto_id = $_POST['producto_id'];
					
					$resultado_producto = $objProducto->getById($producto_id);
					$producto = $resultado_producto->fetchObject();
					$descripcion = $producto->descripcion;
					$precio = $producto->precio;
					
					$subtotal = $cantidad * $precio;
					
					$_SESSION['detalle'][$producto_id] = array('id'=>$producto_id, 'producto'=>$descripcion, 'cantidad'=>$cantidad, 'precio'=>$precio, 'subtotal'=>$subtotal);
	
					$json['success'] = true;
	
					echo json_encode($json);
		
				} catch (PDOException $e) {
					$json['msj'] = $e->getMessage();
					$json['success'] = false;
					echo json_encode($json);
				}
			}else{
				$json['msj'] = 'Ingrese un producto y/o ingrese cantidad';
				$json['success'] = false;
				echo json_encode($json);
			}
			break;
	
		case 2:
			$json = array();
			$json['msj'] = 'Producto Eliminado';
			$json['success'] = true;
		
			if (isset($_POST['id'])) {
				try {
					unset($_SESSION['detalle'][$_POST['id']]);
					$json['success'] = true;
		
					echo json_encode($json);
		
				} catch (PDOException $e) {
					$json['msj'] = $e->getMessage();
					$json['success'] = false;
					echo json_encode($json);
				}
			}
			break;
			
		case 3:
			$objProducto = new Producto();
			$json = array();
			$json['msj'] = 'Guardado correctamente';
			$json['success'] = true;
			$json['idventa'] = '';
		
			if (count($_SESSION['detalle'])>0) {
				try {
					$objProducto->guardarVenta();
					$registro_ultima_venta = $objProducto->getUltimaVenta();
					$result_ultima_venta = $registro_ultima_venta->fetchObject();
					$idventa = $result_ultima_venta->ultimo;
					foreach($_SESSION['detalle'] as $detalle):
						$idproducto = $detalle['id'];
						$cantidad = $detalle['cantidad'];
						$precio = $detalle['precio'];
						$subtotal = $detalle['subtotal'];
						$objProducto->guardarDetalleVenta($idventa, $idproducto, $cantidad, $precio, $subtotal);
					endforeach;
					
					$_SESSION['detalle'] = array();
							
					$json['success'] = true;
					$json['idventa'] = $idventa;
		
					echo json_encode($json);
		
				} catch (PDOException $e) {
					$json['msj'] = $e->getMessage();
					$json['success'] = false;
					echo json_encode($json);
				}
			}else{
				$json['msj'] = 'No hay productos agregados';
				$json['success'] = false;
				echo json_encode($json);
			}
			break;
			
		case 4:
			$objProducto = new Producto();
			$json = array();
			$json['msj'] = 'Guardado correctamente';
			$json['success'] = true;
			$json['idventa'] = '';
		
			if (count($_SESSION['detalle'])>0) {
				try {
					$objProducto->guardarVenta();
					$registro_ultima_venta = $objProducto->getUltimaVenta();
					$result_ultima_venta = $registro_ultima_venta->fetchObject();
					$idventa = $result_ultima_venta->ultimo;
					foreach($_SESSION['detalle'] as $detalle):
						$idproducto = $detalle['id'];
						$cantidad = $detalle['cantidad'];
						$precio = $detalle['precio'];
						$subtotal = $detalle['subtotal'];
						$objProducto->guardarDetalleVenta($idventa, $idproducto, $cantidad, $precio, $subtotal);
					endforeach;
					
					$_SESSION['detalle'] = array();
							
					$json['success'] = true;
					$json['idventa'] = $idventa;
					
					$para      = 'doreisdani3@gmail.com';
					$subject    = 'Test de envio';
					$mensaje   = '';
					$resultado_detalle = $objProducto->getDetalleVenta($idventa);
	
					while($detalle = $resultado_detalle->fetchObject()){ 
						$mensaje = $mensaje . ' ' . $detalle->producto . ' - ' . $detalle->cantidad . ' - ' .$detalle->precio . '<br/>';
					}


					
					$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
					$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$cabeceras .= 'From: webmaster@example.com' . "\r\n" .
						//'Reply-To: webmaster@example.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
	
					if($mensaje){
						$json['success'] = true;
						$json['msj'] = 'Se envio el email correctamente.';
					}else{
						$json['success'] = false;
						$json['msj'] = 'No se envio el email.';
					}
					/* var_dump($json); */
					echo json_encode($json);
		
				} catch (PDOException $e) {
					$json['msj'] = $e->getMessage();
					$json['success'] = false;
					echo json_encode($json);
				}
			}else{
				$json['msj'] = 'No hay productos agregados';
				$json['success'] = false;
				echo json_encode($json);
			}
			break;
	
	}
?>

