<?php 
session_start();
$_SESSION['detalle'] = array();

require_once 'Config/conexion.php';
require_once 'Model/Producto.php';

$objProducto = new Producto();
$resultado_producto = $objProducto->get();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" type="image/x-icon" href="img/miriam.jpg" />
    <title>Pedidos Rotiseria Miriam</title>

    <!-- Bootstrap -->
	<link href="libs/css/bootstrap.css" rel="stylesheet"  >

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
 

			<nav class = "navbar navbar-dark bg-dark">
    
<a href="#" class="navbar-brand"><img height="45" src="img/miriam.jpg"> Pedidos Rotiseria Miriam </a> 

</nav>
	
 		<div class="row">
			<div class="col-md-4">	
				<div><center><strong>Productos:</strong></center>
				<center><select name="cbo_producto" id="cbo_producto" required class="col-md-2 form-control" style="width:100%">
					</center><option value="0">Seleccione un producto</option>
					<?php foreach($resultado_producto as $producto):?>
						<option value="<?php echo $producto['id']?>"><?php echo $producto['descripcion']?></option></center>
					<?php endforeach;?>
				</select></center>
				</div>
			</div>
			<div class="col-md-2">
				<div><center><strong>Cantidad:</strong></center>
				  <center><input id="txt_cantidad" name="txt_cantidad" type="number" class="col-md-2 form-control" placeholder="Ingrese cantidad" require autocomplete="off" /></center>
				  
				</div>
			</div>
			<div class="col-md-2">
				<div style="margin-top: 19px;">
				<button type="button" class="btn btn-primary btn-block btn-agregar-producto">Agregar</button>
				</div>
			</div>
		</div>
		
		<br>
		<div class="panel panel-info">
			 <div class="panel-heading">
		        <center><h3 class="panel-title">🍽️ Mi Pedido</h3></center>
		      </div>
			<div class="panel-body detalle-producto">
				<?php if(count($_SESSION['detalle'])>0){?>
					<table class="table">
					    <thead>
					        <tr>
					            <th>Descripci&oacute;n</th>
					            <th>Cantidad</th>
					            <th>Precio</th>
					            <th>Subtotal</th>
					            <th>Eliminar</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php 
					    	foreach($_SESSION['detalle'] as $k => $detalle){ 
					    	?>
					        <tr>
					        	<td><?php echo $detalle['producto'];?></td>
					            <td><?php echo $detalle['cantidad'];?></td>
					            <td><?php echo $detalle['precio'];?></td>
					            <td><?php echo $detalle['subtotal'];?></td>
					            <td><button type="button" class="btn btn-sm btn-danger eliminar-producto" id="<?php echo $detalle['id'];?>">X</button></td>
					
							
							</tr>
					        <?php }?>
					    </tbody>
					</table>
				
				<?php }else{?>
				<div class="panel-body"> No hay productos agregados</div>
				<?php }?>
			</div>
		</div>
				<button type="button" class="btn  btn-success btn-block guardar-carrito">Guardar Pedido</button>
		
	
		
	<footer class="footer text-center" style="margin-top:10px;padding-top:2rem; padding-bottom: 0px;background-color:#0000!important;">
		
			<div class="row">
			<!-- Footer About Text -->
				<div class="col-lg-12">
					<p class="lead mb-0">
					
					🕐<br>Lunes a Viernes de 18 a 23 hs<br>Sabados y Domingos de 11 a 15 hs y de 18 a 24 hs
<br><span> <i class="fab fa-instagram"></i></span><a href="https://www.instagram.com/rotiseria_miriam/" target=_blank>Rotiseria Miriam</a>
<div class="footer-copyright  py-3">Desarrollado por:
	<a href="https://cv-danidoreis.000webhostapp.com/"> Daniel Do Reis</a>

	

						<div class="helper_footer_padding" style="height: 70px; display: none;"></div>
					</p>
				</div>

			</div>
		
	</footer>

  </body>
</html>
