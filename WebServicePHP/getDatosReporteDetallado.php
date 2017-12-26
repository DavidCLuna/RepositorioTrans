<?php
/**
* funcion que realiza la consulta de  los costos de la clase ControladoresBD para mostrarlos al principal activity
*/

require 'ControladoresBD.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	//obtener numero del lote
	$body = json_decode(file_get_contents("php://input"),true);
	
	//Asignar a la variable retorno el resultado de la consulta"
	$retorno = Controlador::getDatosReporteDetallado($body['num_lote']);
	
	if($retorno){
		$Datos["Resultado"] = '1';
		$Datos["Datos"] = $retorno;
		print json_encode($Datos);
	}else{
		print json_encode(
			array(
			    'Resultado' => '2',
			    'Datos' => 'No se ha podido realizar la consulta de los lotes'
			)
		);
	}
	
}


