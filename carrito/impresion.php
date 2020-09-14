<?php
require_once 'Config/conexion.php';
require_once 'Model/Producto.php';

$idventa = $_GET['id'];
$objProducto = new Producto();
$resultado_detalle = $objProducto->getDetalleVenta($idventa);

?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<link rel="icon" type="image/x-icon" href="img/miriam.jpg" />
	<title>Rotiseria Miriam</title>

	<!-- Bootstrap -->
	<link href="libs/css/bootstrap.css" rel="stylesheet">
	<script src="libs/js/jquery.js"></script>
	<script src="libs/js/jquery-1.8.3.min.js"></script>
	<script src="libs/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="libs/ajax.js"></script>

	<!-- Alertity -->
	<link rel="stylesheet" href="libs/js/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="libs/js/alertify/themes/alertify.bootstrap.css" id="toggleCSS" />
	<script src="libs/js/alertify/lib/alertify.min.js"></script>
</head>

<body>
	
			
		
        
		<a href="#" class="navbar-brand"><img height="45" src="img/miriam.jpg">Carrito 🛒  </a> 
		</div>
		</nav>
		</div>
		<br /><br />


		<div class="detalle-producto">
			<?php if (count($resultado_detalle) > 0) { ?>
				<table id="table" class="table">
					<thead>
						<tr>
							<th class="text">Productos</th>
							<th class="text">Cantidad</th>
							<th class="text">Precio</th>
							<th class="text">Subtotal</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$total = 0;
						while ($detalle = $resultado_detalle->fetchObject()) {
						?>

							<tr>
								<td><?php echo $detalle->producto;; ?></td>
								<td><?php echo  $detalle->cantidad; ?></td>
								<td><?php echo  $detalle->precio; ?></td>
								<td><?php echo round($detalle->cantidad * $detalle->precio, 2);
									$total = $total + round($detalle->cantidad * $detalle->precio, 2);
									?></td>
							</tr>
						<?php } ?>
						<tr>
							<td colspan="3" class="text-right">TOTAL:</td>
							<td><?php echo $total; ?></td>
						</tr>
					</tbody>
				</table>


			<?php } ?>


			<?php
			
			$mensaje   = '';
			$resultado_detalle = $objProducto->getDetalleVenta($idventa);

			while ($detalle = $resultado_detalle->fetchObject()) {
				$mensaje = $mensaje . ' ' . $detalle->cantidad . ' x ' . $detalle->producto . ' %0A';
			}
			/* 
				echo $mensaje;  */
			?>

			<?php
			echo "<a href='https://api.whatsapp.com/send?phone=5491158687947&text=
			*_Hola! Rotiseria Miriam_*%0A%0A
			*Mi Pedido*%0A%0A
		
			${mensaje}%0A
			
			*Total* $ ${total} ' class='btn btn-success btn-block'>Enviar a WhatsApp</a>";

			?>

		</div>
	</div>
	<center><h4>🚀 Costo de envío desde: $ 40</h4></center>
	
	<footer class="page-footer font-small blue">
		 <div class="footer-copyright text-center py-3">Desarrollado por:
			<a href="https://cv-danidoreis.000webhostapp.com/"> Daniel Do Reis</a> 
		</div>
	</footer>
</body>
