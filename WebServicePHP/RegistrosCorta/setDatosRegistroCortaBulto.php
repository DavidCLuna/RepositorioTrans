<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroCortaBulto(
		$body["fecha_crb"],
		$body["num_lote"],
		$body["cantidad_mq_llanta_crb"],
		$body["valor_mq_llanta_crb"],
		$body["valor_total_mq_llanta_crb"],
		$body["cantidad_mq_oruga_crb"],
		$body["valor_mq_oruga_crb"],
		$body["valor_total_mq_oruga_crb"],
		$body["cantidad_llenador_crb"],
		$body["valor_llenador_crb"],
		$body["valor_total_llenador_crb"],
		$body["cantidad_tractor_crb"],
		$body["valor_tractor_crb"],
		$body["valor_total_tractor_crb"],
		$body["cantidad_bulteador_crb"],
		$body["valor_bulteador_crb"],
		$body["valor_total_bulteador_crb"],
		$body["cantidad_flete_crb"],
		$body["valor_flete_crb"],
		$body["valor_total_flete_crb"],
		$body["valor_cabuya_nylon_crb"],
		$body["valor_celaduria_maquina_crb"],
		$body["valor_alimentacion_crb"],
		$body["valor_administracion_crb"],
		$body["valor_maquina_oruga_crb"],
		$body["valor_total_crb"]);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado la corta bulto exitosamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar la corta bulto, verifique los datos que ingresastes')
                    );
        }

}

?>
