<?php

require 'ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	//Decodificando formato JSON	
	$body = json_decode(file_get_contents("php://input"), true);
	
	$cedula = $body["cedula"];
	$contrasena = $body["contrasena"];
	$nuevaContrasena = $body["nuevaContrasena"];

	//Registrar usuario
	$retorno = Controlador::getDatoNewContrasena(
		$cedula,
		$contrasena);

	if($retorno <> null){
		//código de éxito
		$retorno2 = Controlador::setDatosChangeContrasena(
			$cedula,
			$nuevaContrasena
		);

		if($retorno2 <> null){	
			print json_encode(array(
                	        "Resultado" => 1,
        	                "Datos" => "Se ha realizado el cambio de contraseña correctamente"
	                ));

		}else{
			print json_encode(array(
                        	"Resultado" => 3,
                 	        "Datos" => "Error al realizar el cambio de contraseña"
	                ));

		}

	}else{
		print json_encode(array(
			"Resultado" => 2,
			"Datos" => "La contraseña ingresada no es correcta"
		));

	}
	
}

