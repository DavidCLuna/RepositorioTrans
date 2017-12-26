<?php

require 'ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	//Decodificando formato JSON	
	$body = json_decode(file_get_contents("php://input"), true);
	
	$numeroLote = $body["lote"];
	$numeroLoteLike = $numeroLote."%";
	//Registrar usuario
	$retorno1 = Controlador::registroNewCicle(
		$numeroLote);

	if($retorno1 <> null){
		//codigo de exito

		$retorno2 = Controlador::getLoteNewCycle($numeroLoteLike);
		if($retorno2 <> null){	
			$Datos["Resultado"] = '1';
        	        $Datos["Datos"] = $retorno2;
	                print json_encode($Datos);
		}else{
			print json_encode(
                	        array(
        	                    'Resultado' => '2',
	                            'Datos' => 'Error al realizar la consulta del nuevo ciclo'
                        	)
                	);
		}
	}else{
		print json_encode(
                        array(
                            'Resultado' => '2',
                            'Datos' => 'Error al realizar el registro del nuevo ciclo, verifica que no hayas iniciado un nuevo ciclo en este mes'
                        )
                );
	}
	
}

