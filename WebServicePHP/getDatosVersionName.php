<?php
/**
* funcion que realiza la consulta de  los costos de la clase ControladoresBD para mostrarlos al principal activity
*/

require 'ControladoresBDCostos.php';

//Asignar a la variable retorno el resultado de la consulta"
$retorno = Controlador::getDatosVersionName();

if($retorno){
	$Datos["Resultado"] = '1';
	$Datos["Datos"] = $retorno;
	print json_encode($Datos);
}else{
	print json_encode(
		array(
		    'Resultado' => '2',
		    'Datos' => ''
		)
	);
}




