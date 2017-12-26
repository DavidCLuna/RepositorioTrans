<?php

require 'ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	$body = json_decode(file_get_contents("php://input"),true);
	
	$retorno = Controlador::getDatosGraficas($body['num_lote']);
	if($retorno){
		$Datos["Resultado"] = '1';
		$Datos["Datos"] = $retorno;
		print json_encode($Datos);
	}else{
		print json_encode(
			array(
			    'Resultado' => '2',
    			    'Datos' => 'Lotes Obtenidos'
			)
		);
	}
}
?>
