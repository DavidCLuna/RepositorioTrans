<?php
	/*-------------------------
	Autor: David Casadiegos
	Web: transporte.com.co
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	$active_facturas="active";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Editar Factura | Simple Invoice";
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	/*if (isset($_GET['id_factura']))
	{
		$id_factura=intval($_GET['id_factura']);
		$campos="clientes.id_cliente, clientes.nombre_cliente, clientes.telefono_cliente, clientes.email_cliente, facturas.id_vendedor, facturas.fecha_factura, facturas.condiciones, facturas.estado_factura, facturas.numero_factura";
		$sql_factura=mysqli_query($con,"select $campos from facturas, clientes where facturas.id_cliente=clientes.id_cliente and id_factura='".$id_factura."'");
		$count=mysqli_num_rows($sql_factura);
		if ($count==1)
		{
				$rw_factura=mysqli_fetch_array($sql_factura);
				$id_cliente=$rw_factura['id_cliente'];
				$nombre_cliente=$rw_factura['nombre_cliente'];
				$telefono_cliente=$rw_factura['telefono_cliente'];
				$email_cliente=$rw_factura['email_cliente'];
				$id_vendedor_db=$rw_factura['id_vendedor'];
				$fecha_factura=date("d/m/Y", strtotime($rw_factura['fecha_factura']));
				$condiciones=$rw_factura['condiciones'];
				$estado_factura=$rw_factura['estado_factura'];
				$numero_factura=$rw_factura['numero_factura'];
				$_SESSION['id_factura']=$id_factura;
				$_SESSION['numero_factura']=$numero_factura;
		}	
		else
		{
			header("location: conductores.php");
			exit;	
		}
	} 
	else 
	{
		header("location: conductores.php");
		exit;
	}*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
    <div class="container">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4><img class="img-navbar" src="img/icons8_Bill_100px.png"/> Información Factura</h4>
		</div>
		<div class="panel-body">
		<?php 
			/*include("modal/buscar_productos.php");
			include("modal/registro_clientes.php");
			include("modal/registro_productos.php");*/
		?>
			<form class="form-horizontal" role="form" id="datos_factura">
				<div class="form-group row">
				  <label for="nombre_cliente" class="col-md-2 control-label">Número de Factura</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nombre_cliente" placeholder="Digite el número de la factura">
				  </div>
                </div>
			</form>	
	   </div>		
        
    <div class="panel-heading">
			<h4><img class="img-navbar" src="img/icons8_Driver_96px_2.png"/> Información Conductor</h4>
		</div>
		<div class="panel-body">
		<?php 
			/*include("modal/buscar_productos.php");
			include("modal/registro_clientes.php");
			include("modal/registro_productos.php");*/
		?>
			<form class="form-horizontal" role="form" id="datos_factura">
				<div class="form-group row">
                    <div class="table-responsive">
                      <table class="table">
                          <tr  class="">
                            <th class="text-center"># Cedula</th>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">Licencia</th>
                          </tr>
                          <input type="hidden" id="cedula_cliente" name="cedula_cliente" value="<?php echo $cedula_conductor;?>">
                          <tr>
                              <td class="text-center">asa<?php $cedula_conductor ?></td>
                              <td class="text-center">sas<?php $nombre_conductor ?></td>
                              <td class="text-center">asa<?php $licencia_conductor ?></td>
                          </tr>
                        </table>
				    </div>
				 </div>
			</form>	
		</div>
		 <div class="panel-heading">
			<h4><img class="img-navbar" src="img/icons8_Semi_Truck_100px.png"/> Información Vehículo</h4>
		</div>
		<div class="panel-body">
		<?php 
			/*include("modal/buscar_productos.php");
			include("modal/registro_clientes.php");
			include("modal/registro_productos.php");*/
		?>
			<form class="form-horizontal" role="form" id="datos_factura">
				<div class="form-group row">
                    
                    <p class="padding-10">Si no encuentra el vehículo en la tabla, digite el número de placa y de clic en vincular. Esta acción vinculará este vehículo con el conductor seleccionado para la asignación del cargue.</p>
                    
                    <div class="form-group row">
							<label for="q" class="col-md-1 control-label">Placa</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Placa del vehículo" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick=''>
									<span class="glyphicon glyphicon-resize-small" ></span> Vincular</button>
								<span id="loader"></span>
							</div> 
				    </div>
                    
                    <div class="table-responsive">
                      <table class="table table-hover">
                            <thead>
                                <tr  class="">
                                    <th class="text-center">Placa</th>
                                    <th class="text-center">Marca</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">SOAT</th>
                                    <th class="text-center">Tecnicomecánico</th>
                                    <th class="text-center">Observaciones</th>
                                    <th class="text-center">Seleccionar</th>
                                </tr>
                            </thead>
                            <input type="hidden" id="cedula_cliente" name="cedula_cliente" value="<?php echo $cedula_conductor;?>">
                            <tbody>
                                <?php
										$sql_vendedor=mysqli_query($con,"select * from vehiculos order by placa_vehiculo");
										while ($rw=mysqli_fetch_array($sql_vendedor)){
											
                                            $placa_vehiculo = $rw['placa_vehiculo'];
											$marca_vehiculo = $rw['marca_vehiculo'];
                                            $modelo_vehiculo = $rw['modelo_vehiculo'];
                                            $tipo_vehiculo = $rw['tipo_vehiculo'];
                                            $soat_vehiculo = $rw['soat_vehiculo'];
                                            $tecnicomecanico_vehiculo = $rw['tecnicomecanico_vehiculo'];
                                            $observaciones_vehiculo = $rw['observaciones_vehiculo'];
                                                
											?>
                                            <tr>
                                                <td class="text-center"><?php echo $placa_vehiculo ?></td>
                                                <td class="text-center"><?php echo $marca_vehiculo ?></td>
                                                <td class="text-center"><?php echo $modelo_vehiculo ?></td>
                                                <td class="text-center"><?php echo $tipo_vehiculo ?></td>
                                                <td class="text-center"><?php echo $soat_vehiculo ?></td>
                                                <td class="text-center"><?php echo $tecnicomecanico_vehiculo ?></td>
                                                <td class="text-center"><?php echo $observaciones_vehiculo ?></td>
                                                <td class="text-center"><input type="checkbox"></td>
                                            </tr>
											
											<?php
										}
									?>
                                
                            </tbody>
                        </table>
				  </div>
				 </div>
			</form>	
	   </div>	
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/editar_factura.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
						$("#nombre_cliente").autocomplete({
							source: "./ajax/autocomplete/clientes.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_cliente').val(ui.item.id_cliente);
								$('#nombre_cliente').val(ui.item.nombre_cliente);
								$('#tel1').val(ui.item.telefono_cliente);
								$('#mail').val(ui.item.email_cliente);
																
								
							 }
						});
						 
						
					});
					
	$("#nombre_cliente" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_cliente" ).val("");
							$("#id_cliente" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
						}
			});	
	</script>

  </body>
</html>