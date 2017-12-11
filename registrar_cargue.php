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
	$active_facturas="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";
        
	$title="Registrar Cargue | Coagrotransporte";
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	

		$campos="nombre_conductor, apellido_conductor, licencia_conductor";
		$sql_conductor=mysqli_query($con,"select $campos from conductores where cedula_conductor = '".$_GET['cedula']."'");
		$count=mysqli_num_rows($sql_conductor);
		if ($count==1)
		{
				$rw_conductor=mysqli_fetch_array($sql_conductor);
                $cedula_conductor=$_GET['cedula'];
				$nombre_conductor=$rw_conductor['nombre_conductor'];
				$apellido_conductor=$rw_conductor['apellido_conductor'];
                $nombre_completo_conductor=$nombre_conductor." ".$apellido_conductor;
				$licencia_conductor=$rw_conductor['licencia_conductor'];
				
		}	
		else
		{
			header("location: conductores.php");
			exit;	
		}
	 
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
      <input type="hidden" id="valor_cedula_conductores_vehiculos" value="<?php echo $_GET['cedula']?>"/>
    <div class="container">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4><img class="img-navbar" src="img/icons8_Bill_100px.png"/> Información Factura</h4>
		</div>
		<div class="panel-body">
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
			<form class="form-horizontal" role="form" id="datos_factura">
				<div class="form-group row">
                    <div class="table-responsive">
                      <table class="table">
                          <tr  class="">
                            <th class="text-center"># Cedula</th>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center"># Licencia</th>
                          </tr>
                          <input type="hidden" id="cedula_cliente" name="cedula_cliente" value="<?php echo $cedula_conductor;?>">
                          <tr>
                              <td class="text-center"><?php echo $cedula_conductor ?></td>
                              <td class="text-center"><?php echo $nombre_completo_conductor ?></td>
                              <td class="text-center"><?php echo $licencia_conductor ?></td>
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
			<form class="form-horizontal" role="form" id="datos_factura" name="datos_factura" method="post">
				<div class="form-group row">
                    
                    <p class="padding-10">Si no encuentra el vehículo en la tabla, digite el número de placa y de clic en vincular. Esta acción vinculará este vehículo con el conductor seleccionado para la asignación del cargue.</p>
                    
                    <div class="form-group row">
                        <form id="formulario_vinculacion_cargue">
                        
							<label for="q" class="col-md-1 control-label">Placa</label>
							<div class="col-md-5">
								<input type="text" class="form-control" onclick="seleccionarFilaVehiculos();" id="q" placeholder="Placa del vehículo" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="submit" class="btn btn-default"id="guardar_cargue" onclick=''>
									<span class="glyphicon glyphicon-resize-small" ></span> Vincular</button>
								<span id="loader"></span>
							</div> 
                            
                        </form>
				    </div>
                    
                    <div id="resultados"></div><!-- Carga los datos ajax -->
				    <div class='outer_div'></div><!-- Carga los datos ajax -->
				 </div>
			</form>	
	   </div>	
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
    <script type="text/javascript" src="js/carguesvehiculosconductores.js"></script>    
    <script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  </body>
</html>