<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroCosechaRiegoBombeo(
		$body["fecha_riego"],
		$body["num_lote"],
                $body["cantidad_mano_obra_riego"],
                $body["valor_mano_obra_riego"],
                $body["total_mano_obra"],
                $body["cantidad_aceite"],
                $body["valor_aceite"],
		$body["total_aceite"],	
		$body["cantidad_combustible"],	
		$body["valor_combustible"],
		$body["total_combustible_riego"],
		$body["cantidad_alquiler_riego"],
		$body["valor_alquiler_riego"],
		$body["total_alquiler_riego"],
		$body["valor_tarifa_districto_riego"],
		$body["valor_tarifa_corponor_riego"],
		$body["total_tarifa_riego"],
		$body["valor_total_riego"]
		);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado el riego tipo bombeo exitosamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar el riego tipo bombeo, verifique los datos que ingresastes')
                    );
        }

}

?>
