<?php

require 'ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	//Decodificando formato JSON	
	$body = json_decode(file_get_contents("php://input"), true);
	
	$cedula = $_POST["cedula"];
	$lote = $_POST["num_lote"];
	$hectareas = $_POST["hectareas"];
	
	error_log('valor de la variable cedula = '.$cedula);
	//Registrar usuario
	$retorno = Controlador::setNuevoLote(
		$cedula, $lote, $hectareas);

	if($retorno <> null){
		//codigo de exito
		session_start();
	        $_SESSION['result'] = "Se ha realizado el registro del nuevo lote exitosamente";
		header('Location: ../Noticias/Register.php');
		
	}else{
		//codigo de error
		session_start();
                $_SESSION['result'] = "Error al realizar el registro, verifique el lote no esté registrado o la cedula esté registrada";
                header('Location: ../Noticias/Register.php');
	}
	
}

