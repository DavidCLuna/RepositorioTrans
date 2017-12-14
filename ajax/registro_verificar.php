<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
   /* 
 

		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
    
    if(isset($_GET['cedula'])){

        $url_img = "http://transporte.com.co/uploads/";
        $cedula_verificar = $_GET['cedula'];
        if (isset($_FILES['file_runt']['name']) && isset($_FILES['file_runt']['tmp_name'])){

            $nombre_archivo = $_FILES['file_runt']['name'];
            $tmp_archivo = $_FILES['file_runt']['tmp_name'];
            if(registrarArchivoServidor($nombre_archivo,$tmp_archivo,$cedula_verificar,"runt")){
              $messages[] = "Se ha registrado el RUNT, ";
              $file_runt_insert = $url_img.$cedula_verificar."runt".".pdf";
            } 
            else {
                $errors[] = "Error al registrar el RUNT";
            }
        }else{
            $messages_warning[] = "No se cargó el archivo RUNT por lo tanto no se registró, ";
            $file_runt_insert = "";
        }   

        if (isset($_FILES['file_simit']['name']) && isset($_FILES['file_simit']['tmp_name'])){
            $nombre_archivo = $_FILES['file_simit']['name'];
            $tmp_archivo = $_FILES['file_simit']['tmp_name'];
            if(registrarArchivoServidor($nombre_archivo,$tmp_archivo, $cedula_verificar, "simit")) {
                $messages[] = "Se ha registrado el SIMIT, ";
                $file_simit_insert = $url_img.$cedula_verificar."simit".".pdf";
            }
            else {
                $errors[] = "Error al registrar el SIMIT";
            }
        }else{
            $messages_warning[] = "No se cargó el archivo SIMIT por lo tanto no se registró, ";
            $file_simit_insert = "";
        }

        if (isset($_FILES['file_procuraduria']['name']) && isset($_FILES['file_procuraduria']['tmp_name'])){
            $nombre_archivo = $_FILES['file_procuraduria']['name'];
            $tmp_archivo = $_FILES['file_procuraduria']['tmp_name'];
            if(registrarArchivoServidor($nombre_archivo,$tmp_archivo,$cedula_verificar,"procuraduria")) {
                $messages[] = "Se ha registrado Procuraduría, ";
                $file_procuraduria_insert = $url_img.$cedula_verificar."procuraduria".".pdf";
            }
            else {
                $errors[] = "Error al registrar Procuraduría";
            }
        }else{
            $messages_warning[] = "No se cargó el archivo Procuraduría por lo tanto no se registró, ";
            $file_procuraduria_insert = "";
        }

        if (isset($_FILES['file_contraloria']['name']) && isset($_FILES['file_contraloria']['tmp_name'])){
            $nombre_archivo = $_FILES['file_contraloria']['name'];
            $tmp_archivo = $_FILES['file_contraloria']['tmp_name'];
            if(registrarArchivoServidor($nombre_archivo,$tmp_archivo,$cedula_verificar,"contraloria")) {
                $messages[] = "Se ha registrado Contraloría. ";
                $file_contraloria_insert = $url_img.$cedula_verificar."contraloria".".pdf";
            }
            else {
                $errors[] = "Error al registrar Contraloría";
            }
        }else{
            $messages_warning[] = "No se cargó el archivo Contraloría por lo tanto no se registró, ";
            $file_contraloria_insert = "";
        }
        
		$sql="INSERT INTO documentos (cedula_conductor_documento, runt_documento, procuraduria_documento, contraloria_documento, simit_documento, fecha_hora_documento) VALUES ('$cedula_verificar','$file_runt_insert','$file_simit_insert','$file_procuraduria_insert','$file_contraloria_insert',now());";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Conductor ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
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
        
            if (isset($messages_warning)){
				
				?>
				<div class="alert alert-warning" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Advertencia!</strong>
						<?php
							foreach ($messages_warning as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
        
        
}else{
        ?>
				<div class="alert alert-warning" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Error! </strong>
				        No se ha podido obtener la cédula <?php echo $_GET['cedula'] ?>
				</div>
				<?php
    }

function registrarArchivoServidor($nombre_archivo, $tmp_archivo, $cedula, $tipo_registro){
    $upload_folder ='../uploads';
    $archivador = $upload_folder . '/' . $cedula . $tipo_registro . ".pdf";

    if (!move_uploaded_file($tmp_archivo, $archivador)) {
        return false;
    }
    return true;
}
?>