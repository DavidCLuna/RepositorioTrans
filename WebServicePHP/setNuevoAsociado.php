<?php

require 'ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	//Decodificando formato JSON	
	$body = json_decode(file_get_contents("php://input"), true);
	
	$cedula = $_POST["cedulaAsociado"];
	
	error_log('valor de la variable cedula = '.$cedula);
	//Registrar usuario
	$retorno = Controlador::setNuevoUsuario(
		$cedula);

	if($retorno <> null){
		//codigo de exito
		session_start();
	        $_SESSION['result'] = "Se ha realizado el registro del asociado exitosamente";
		header('Location: ../Noticias/Register.php');
		
	}else{
		//codigo de error
		session_start();
                $_SESSION['result'] = "Error al realizar el registro, verifique el asociado no esté registrado";
                header('Location: ../Noticias/Register.php');
	}
	
}

