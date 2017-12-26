<?php

require 'ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	//Decodificando formato JSON	
	$body = json_decode(file_get_contents("php://input"), true);
	
	//Registrar usuario
	$retorno = Controlador::registroUsuario(
		$body["cedula"],
		$body["nombre"],
		$body["apellido"],
		$body["contrasena"],
		$body["sexo"],
		$body["telefono"],
		$body["correo"],
		$body["direccion"],
		$body["token"]);

	if($retorno <> null){
		//código de éxito
		$Datos["Resultado"] = '1';
		$Datos["Datos"] = $retorno;
		print json_encode($Datos);
	}else{
		$Datos["Resultado"] = '2';
                $Datos["Datos"] = $retorno;
                print json_encode($Datos);

	}
	
}

