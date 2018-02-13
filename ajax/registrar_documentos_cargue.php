<?php
/* Connect To Database*/
require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

$con_global = $con;
    $query=mysqli_query($con, "SELECT MAX(consecutivo_cargue) as consecutivo from cargues");
    $row = mysqli_fetch_array($query);
    $id_consecutivo = $row['consecutivo']; 

    error_log("ID Consecutivo: ".$id_consecutivo);
    consultarIdConductor($_POST['']);





    $target_dir = "../uploads/";
    $carpeta=$target_dir;

    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
    }

    $cantidad = $_GET['cantidad'];

    for($u = 0; $u<=$cantidad; $u++){
        error_log("Resultado: ".$_POST['id_factura'.$u]);
    }

    for($i = 0; $i<=$cantidad; $i++){
        
        $name_file = $_FILES["adjunto".$i]["name"];
        $url = "http://transporte.com.co/uploads/".$name_file;
        error_log("-----: ".$url);
        $sql="insert into factura_despacho(consecutivo_cargue, id_factura_despacho, url_documento, tipo_documento) values ('".$id_consecutivo."','".$_POST['id_factura'.$i]."','".$url."','Despacho')";
    
        $query_new_insert = mysqli_query($con,$sql);
        if ($query_new_insert){
            echo "registrada factura: ".id_factura_despacho;
        }
        
        
        $target_file = $carpeta . basename($_FILES["adjunto".$i]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image

        // Check if file already exists
        if (file_exists($target_file)) {
            $errors[]="Lo sentimos, archivo ya existe.";
            $uploadOk = 0;
        }
        if (move_uploaded_file($_FILES["adjunto".$i]["tmp_name"], $target_file)) {
           
            $sql="insert into estados_cargues(consecutivo_cargue, fecha_hora_cargue, estado_cargue) values ('".$id_consecutivo."',now(),'0')";
    
            $query_new_insert = mysqli_query($con,$sql);
            if ($query_new_insert){
                echo "Registrado cargue exitosamente";
            }
            
           // $messages[]= "El Archivo ha sido subido correctamente.";
            
        } else {
           $errors[]= "Lo sentimos, hubo un error subiendo el archivo.";
        }
    }


// funcion que consulta el id del consecutivo
function consultarIdConductor($cedula, $placa){
    $query=mysqli_query($con_global, "SELECT id_conductor_vehiculo from conductores_vehiculos where cedula_conductor = '".$cedula."' and placa_vehiculo = '".$placa."' ");
    $row = mysqli_fetch_array($query);
    return $row['id_conductor_vehiculo'];   
}
    
?>