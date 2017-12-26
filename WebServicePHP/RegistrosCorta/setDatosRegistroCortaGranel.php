<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroCortaGranel(

	$body["fecha_crg"],
	$body["num_lote"],
	$body["cantidad_mq_llanta_crg"],
	$body["valor_mq_llanta_crg"],
	$body["valor_total_mq_llanta_crg"],	
	$body["cantidad_mq_oruga_crg"],	
	$body["valor_mq_oruga_crg"],	
	$body["valor_total_mq_oruga_crg"],
	$body["cantidad_flete_crg"],	
	$body["valor_flete_crg"],	
	$body["valor_total_flete_crg"],
	$body["valor_celaduria_maquina_crg"],
	$body["valor_alimentacion_crg"],
	$body["valor_administracion_crg"],
	$body["valor_maquina_oruga_crg"],
	$body["valor_total_crg"]);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado la corta granel exitosamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar la corta granel, verifique los datos que ingresastes')
                    );
        }

}

?>
