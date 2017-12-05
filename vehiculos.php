<?php
	/*-------------------------
	Autor: Obed Alvarado
	Web: obedalvarado.pw
	Mail: info@obedalvarado.pw
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
    }
/*else if(isset($_SESSION['user_tipoUsuario']) && $_SESSION['user_tipoUsuario'] != "Administrador"){
        header("location: verificar");
		exit;
    }
*/
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_verificar="";
	$active_cargues="";
	$active_conductores="";
    $active_vehiculos="active";
	$active_usuarios="";
	$title="Vehículos | Coagrotransporte";
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
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-warning" data-toggle="modal" data-target="#nuevoProducto"><span class="glyphicon glyphicon-plus" ></span> Nuevo Vehículo</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Vehículos:</h4>
		</div>
		<div class="panel-body">
		
			<?php
			include("modal/registro_vehiculos.php");
			include("modal/editar_productos.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Placa</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Placa del vehículo" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div> 
						</div>
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/vehiculos.js"></script>
  </body>
</html>
<script>
$( "#guardar_producto" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/nuevo_vehiculo.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax_productos").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax_productos").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_producto" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "ajax/editar_producto.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

	function obtener_datos(id){
        
			var placa_vehiculo = $("#placa_vehiculo"+id).val();
			var marca_vehiculo = $("#marca_vehiculo"+id).val();  
            var modelo_vehiculo = $("#modelo_vehiculo"+id).val();
			var tipo_vehiculo = $("#tipo_vehiculo"+id).val();
            var soat_vehiculo = $("#soat_vehiculo"+id).val();
			var tecnicomecanico_vehiculo = $("#tecnicomecanico_vehiculo"+id).val();
            var observaciones_vehiculo = $("#observaciones_vehiculo"+id).val();
        
			$("#mod_id").val(id);
			$("#mod_placa").val(placa_vehiculo);
			$("#mod_marca").val(marca_vehiculo);
			$("#mod_modelo").val(modelo_vehiculo);
			$("#mod_tipo").val(tipo_vehiculo);
			$("#mod_soat").val(soat_vehiculo);
			$("#mod_tecnicomecanico").val(tecnicomecanico_vehiculo);
            $("#mod_observaciones").val(observaciones_vehiculo);
		}
</script>