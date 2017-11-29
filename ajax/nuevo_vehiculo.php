<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['placa_vehiculo'])) {
           $errors[] = "Placa vacía";
        } else if (empty($_POST['marca_vehiculo'])) {
           $errors[] = "Marca vacía";
        }else if (empty($_POST['modelo_vehiculo'])) {
           $errors[] = "Modelo vacío";
        }else if (empty($_POST['tipo_vehiculo'])) {
           $errors[] = "Tipo vacío";
        }else if (empty($_POST['soat_vehiculo'])) {
           $errors[] = "SOAT vacío";
        }else if (empty($_POST['tecnicomecanico_vehiculo'])) {
           $errors[] = "Tecnicomecánico vacío";
        }else if (empty($_POST['observaciones_vehiculo'])) {
           $errors[] = "Observaciones vacío";
        }else if (!isset($_POST['placa_vehiculo'])) {
           $errors[] = "No modifiques el nombre de los campos";
        } else if (!isset($_POST['marca_vehiculo'])) {
           $errors[] = "No modifiques el nombre de los campos";
        }else if (!isset($_POST['modelo_vehiculo'])) {
           $errors[] = "No modifiques el nombre de los campos";
        }else if (!isset($_POST['tipo_vehiculo'])) {
           $errors[] = "No modifiques el nombre de los campos";
        }else if (!isset($_POST['soat_vehiculo'])) {
           $errors[] = "No modifiques el nombre de los campos";
        }else if (!isset($_POST['tecnicomecanico_vehiculo'])) {
           $errors[] = "No modifiques el nombre de los campos";
        }else if (!isset($_POST['observaciones_vehiculo'])) {
           $errors[] = "No modifiques el nombre de los campos";
        } else if (
			!empty($_POST['placa_vehiculo']) &&
			!empty($_POST['marca_vehiculo']) &&
			!empty($_POST['modelo_vehiculo']) &&
			!empty($_POST['tipo_vehiculo']) &&
            !empty($_POST['soat_vehiculo']) &&
			!empty($_POST['tecnicomecanico_vehiculo']) &&
			!empty($_POST['observaciones_vehiculo'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$placa=mysqli_real_escape_string($con,(strip_tags($_POST["placa_vehiculo"],ENT_QUOTES)));
        $marca=mysqli_real_escape_string($con,(strip_tags($_POST["marca_vehiculo"],ENT_QUOTES)));
        $modelo=mysqli_real_escape_string($con,(strip_tags($_POST["modelo_vehiculo"],ENT_QUOTES)));
        $tipo=mysqli_real_escape_string($con,(strip_tags($_POST["tipo_vehiculo"],ENT_QUOTES)));
        $soat=mysqli_real_escape_string($con,(strip_tags($_POST["soat_vehiculo"],ENT_QUOTES)));
        $tecnicomecanico=mysqli_real_escape_string($con,(strip_tags($_POST["tecnicomecanico_vehiculo"],ENT_QUOTES)));
        $observaciones=mysqli_real_escape_string($con,(strip_tags($_POST["observaciones_vehiculo"],ENT_QUOTES)));
		$sql="INSERT INTO vehiculos (placa_vehiculo, marca_vehiculo, modelo_vehiculo, tipo_vehiculo, soat_vehiculo,tecnicomecanico_vehiculo,observaciones_vehiculo,fecha_creacion_vehiculo) VALUES ('$placa','$marca','$modelo','$tipo','$soat','$tecnicomecanico','$observaciones',now())";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Vehiculo ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>