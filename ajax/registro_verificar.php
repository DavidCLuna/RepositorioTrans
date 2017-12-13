<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
   /* 
    if(isset($_POST['file_runt'])){
        $errors[] = "No has subido el PDF del RUNT";
    }else if(isset($_POST['file_simit'])){
        $errors[] = "No has subido el PDF del SIMIT";
    }else if(isset($_POST['file_procuraduria'])){
        $errors[] = "No has subido el PDF de la Procuraduría";
    }else if(isset($_POST['file_contraloria'])){
        $erros[] = "No has subido el PDF de la Contraloría";
    }*/

		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
        $return = Array('ok'=>TRUE);

        $upload_folder ='../uploads';

        $nombre_archivo = $_FILES['file_runt']['name'];

        $tmp_archivo = $_FILES['file_runt']['tmp_name'];

        $archivador = $upload_folder . '/' . $nombre_archivo;

        if (!move_uploaded_file($tmp_archivo, $archivador)) {

        $return = Array('ok' => FALSE, 'msg' => "Ocurrio un error al subir el archivo. No pudo guardarse.", 'status' => 'error');

        }

        echo json_encode($return);
        
        
        /*
        
        
        
		$sql="INSERT INTO conductores (cedula_conductor, nombre_conductor, apellido_conductor,
        licencia_conductor, fecha_ingreso_conductor) VALUES ('$cedula','$nombre','$apellido','$licencia','$fecha_ingreso')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Conductor ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		*/
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