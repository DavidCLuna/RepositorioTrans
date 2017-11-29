<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	
        if(!isset($_POST['mod_id'])){
           $errors[] = "No modifiques los nombres de los campos"; 
        }else if(!isset($_POST['mod_nombre'])){
           $errors[] = "No modifiques los nombres de los campos"; 
        }else if(!isset($_POST['mod_apellido'])){
           $errors[] = "No modifiques los nombres de los campos"; 
        }else if(!isset($_POST['mod_licencia'])){
           $errors[] = "No modifiques los nombres de los campos"; 
        }else if(!isset($_POST['mod_fecha_ingreso'])){
           $errors[] = "No modifiques los nombres de los campos"; 
        }else if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }else if (empty($_POST['mod_apellido'])) {
           $errors[] = "Apellido vacío";
        }else if (empty($_POST['mod_licencia'])) {
           $errors[] = "Licencia vacía";
        }else if (empty($_POST['mod_fecha_ingreso'])) {
           $errors[] = "Fecha ingreso vacía";
        } else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_nombre']) &&
            !empty($_POST['mod_apellido']) &&
            !empty($_POST['mod_licencia']) &&
            !empty($_POST['mod_fecha_ingreso'])
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
        $apellido=mysqli_real_escape_string($con,(strip_tags($_POST["mod_apellido"],ENT_QUOTES)));
        $licencia=mysqli_real_escape_string($con,(strip_tags($_POST["mod_licencia"],ENT_QUOTES)));
        $fecha_ingreso=mysqli_real_escape_string($con,(strip_tags($_POST["mod_fecha_ingreso"],ENT_QUOTES)));
            
		$id_conductor =$_POST['mod_id'];
            
		$sql="UPDATE conductores SET 
        nombre_conductor ='".$nombre."', 
        apellido_conductor ='".$apellido."', 
        licencia_conductor ='".$licencia."', fecha_ingreso_conductor ='".$fecha_ingreso."' 
        WHERE cedula_conductor ='".$id_conductor."'";
            
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Conductor ha sido actualizado satisfactoriamente.";
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