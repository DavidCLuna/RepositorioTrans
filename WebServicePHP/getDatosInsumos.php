<?php
/**
 * Obtenerlos insumos que se encuentran registrados
 */

require 'ControladoresBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	
	if(isset($_GET['clasificacion'])){
		//obtener parametro clasificacion
		$parametro = $_GET['clasificacion'];
		
		$retorno = Controlador::getDatosInsumos($parametro);
		
		if($retorno){
			
			$Datos["Resultado"] = '1';
			$Datos["Datos"] = $retorno;
			print json_encode($Datos);
		}else{
			print json_encode(
				array(
					'Resultado' => '',
					'Datos' => ''
				)
			);
		}
	}else{
		print json_encode(
			array(
				'Resultado' => '3',	
				'Datos' => 'No se ha encontrado el tipo de insumo a consultar'
			)
		);
	}

}

