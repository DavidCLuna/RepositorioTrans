<?php

require 'ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	//Decodificando formato JSON	
	$body = json_decode(file_get_contents("php://input"), true);
	
	$nombreInsumo = $body["nombre_insumo"];

	$clasificacion = $body["clasificacion"];
	//Registrar usuario
	$retorno = Controlador::setInsumos(
		$clasificacion,
		$nombreInsumo);

	if($retorno <> null){
		//codigo de exito
		
		$Datos["Resultado"] = '1';
        	$Datos["Datos"] = $retorno;
	        print json_encode($Datos);
		
	}else{
		print json_encode(
                        array(
                            'Resultado' => '2',
                            'Datos' => 'Error al realizar el registro del nuevo ciclo, verifica que no hayas iniciado un nuevo ciclo en este mes'
                        )
                );
	}
	
}

