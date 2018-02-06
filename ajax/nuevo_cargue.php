<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
$dataIdFactura = json_decode($_POST['idFactura']);
echo ($dataIdFactura[0]);

$dataAdjunto = json_decode($_POST['adjunto']);
echo ($dataAdjunto[0]);

$dataCheck_factura = json_decode($_POST['check_factura']);
echo ($dataCheck_factura[0]);

	if (empty($_POST['cedula'])) {
           $errors[] = "La cédula se encuentra vacía";
      //  } else if(empty($_POST['num_factura'])){
      //      $errors[] = "No has digitado el número de la factura";
        }else if (empty($_POST['placa'])){
            $errors[] = "No has seleccionado una placa";
        }else{
            /* Connect To Database*/
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
            require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
            // escaping, additionally removing everything that could be (html/javascript-) code
            $cedula=mysqli_real_escape_string($con,(strip_tags($_POST["cedula"],ENT_QUOTES)));
            $placa=mysqli_real_escape_string($con,(strip_tags($_POST["placa"],ENT_QUOTES)));
            $num_factura=mysqli_real_escape_string($con,(strip_tags($_POST["num_factura"],ENT_QUOTES)));

            $query=mysqli_query($con, "select id_factura_cargue from cargues where id_factura_cargue ='".$num_factura."'");
            $rw_user=mysqli_fetch_array($query);
            $count=$count=mysqli_num_rows($query);
            if ($count==0){
                
                $query=mysqli_query($con, "select id_conductor_vehiculo from conductores_vehiculos where cedula_conductor ='".$cedula."' and placa_vehiculo = '".$placa."'");
                $rw_user=mysqli_fetch_array($query);
                $count=$count=mysqli_num_rows($query);
                if ($count>=1){
                    
                    
                    //$errors[] = echo var_dump($dataIdFactura);
                    /*$id_conductor_vehiculo = $rw_user['id_conductor_vehiculo'];

                    $sql="INSERT INTO cargues(id_factura_cargue, id_conductor_vehiculo, id_usuario_usuarios, fecha_hora_cargue) values ('$num_factura','$id_conductor_vehiculo','".$_SESSION['user_id_usuario']."',now())";
                    
                    $query_new_insert = mysqli_query($con,$sql);
                    if ($query_new_insert){
                        $sql="INSERT INTO estados_cargues(id_factura_cargue, estado_cargue, fecha_hora_cargue) values ('$num_factura',0,now())";
                    
                        $query_new_insert = mysqli_query($con,$sql);
                        if ($query_new_insert){
                            $messages[] = "Se ha registrado el cargue exitosamente.";
                        }else{
                            $sql="delete from estado_cargues where id_factura_cargue = '".$num_factura."'";
                    
                            $query_new_insert = mysqli_query($con,$sql);
                            if ($query_new_insert){
                                
                            }else{
                                $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
                            }
                        } 
                    } else {
                        $errors []= "Error desconocido.";
                    }*/
            }else{
                $errors []= "Ya se encuentra registrado un cargue con este número de factura";
            }
        }
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