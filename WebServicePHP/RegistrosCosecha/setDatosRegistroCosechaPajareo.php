<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroCosechaPajareo(
		$body["fecha_pcp"],
		$body["num_lote"],
                $body["cantidad_mano_obra_pcp"],
                $body["valor_mano_obra_pcp"],
                $body["valor_total_mano_obra_pcp"],
                $body["cantidad_polvora_pcp"],
                $body["valor_polvora_pcp"],	
		$body["valor_total_polvora_pcp"],	
		$body["valor_total_pcp"]);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado pajareo exitosamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar pajareo, verifique los datos que ingresastes')
                    );
        }

}

?>
