<?php
/**
 * Obtener datos para realizar el login
 */

require 'ControladoresBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$body = json_decode(file_get_contents("php://input"),true);
	
        // Obtener parámetro idMeta

        // Tratar retorno
        $retorno = Controlador::getDatosPaddy();


        if ($retorno) {
		$Datos["Resultado"] = '1';
                $Datos["Datos"] = $retorno;
                print json_encode($Datos);
        } else {
		print json_encode(
                        array(
                            'Resultado' => '2',
                            'Datos' => 'No se pudo consultar la informacion de paddy'
                            )
                );
        }

}
